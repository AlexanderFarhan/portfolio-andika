@extends('admin.layouts.admin')

@section('title', 'Inbox Pesan Kontak')
@section('page-title', 'Kotak Masuk Pesan (Inbox)')

@section('content')
@if(isset($profile))
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="p-3 rounded-3 glass-card d-flex align-items-center gap-3">
                <div class="stat-icon-badge badge-primary">
                    <i class="bi bi-envelope-at-fill fs-5"></i>
                </div>
                <div class="overflow-hidden">
                    <small class="text-subtle d-block fw-semibold mb-1" style="font-size: 0.75rem;">Email Publik Portofolio</small>
                    <div class="fw-bold small text-truncate" style="color: var(--text-primary);">{{ $profile->email }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-3 glass-card d-flex align-items-center gap-3">
                <div class="stat-icon-badge badge-success">
                    <i class="bi bi-whatsapp fs-5"></i>
                </div>
                <div class="overflow-hidden">
                    <small class="text-subtle d-block fw-semibold mb-1" style="font-size: 0.75rem;">Nomor WhatsApp / Kontak</small>
                    <div class="fw-bold small text-truncate" style="color: var(--text-primary);">{{ $profile->phone }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-3 glass-card d-flex align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3 overflow-hidden">
                    <div class="stat-icon-badge badge-info">
                        <i class="bi bi-geo-alt-fill fs-5"></i>
                    </div>
                    <div class="overflow-hidden">
                        <small class="text-subtle d-block fw-semibold mb-1" style="font-size: 0.75rem;">Lokasi Domisili</small>
                        <div class="fw-bold small text-truncate" style="color: var(--text-primary);">{{ $profile->location }}</div>
                    </div>
                </div>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-sm btn-outline-custom text-nowrap" title="Edit Kontak">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
            </div>
        </div>
    </div>
@endif

<div class="glass-card p-4">
    <!-- Header with Left Title and Right Action Tools -->
    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                <h2 class="h5 fw-bold mb-0 font-heading">Pesan Kontak dari Pengunjung</h2>
                <span class="badge bg-success bg-opacity-15 text-success small border border-success border-opacity-25 px-2 py-1 d-inline-flex align-items-center gap-1">
                    <span class="live-pulse-dot" style="width: 7px; height: 7px; background: #10b981; border-radius: 50%; display: inline-block;"></span>
                    Live Sync
                </span>
            </div>
            <p class="text-subtle small mb-0" id="messagesCountSubtitle">Total {{ $messages->total() }} pesan masuk melalui form kontak website</p>
        </div>

        <!-- Right Side Action Toolbar -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <!-- Dynamic Batch Delete Selected Button -->
            <button type="button" class="btn btn-sm btn-danger d-inline-flex align-items-center gap-1 shadow-sm" id="btnDeleteSelected" style="display: none;" title="Hapus semua pesan yang dicentang">
                <i class="bi bi-trash3-fill"></i>
                <span>Hapus (<span id="selectedCountNumber">0</span>) Terpilih</span>
            </button>

            <!-- Toggle Selection Button -->
            <button type="button" class="btn btn-sm btn-outline-custom d-inline-flex align-items-center gap-1" id="btnToggleSelection" title="Pilih pesan untuk dihapus sekaligus">
                <i class="bi bi-check2-square text-info"></i>
                <span id="btnToggleSelectionText">Pilih Hapus Pesan</span>
            </button>

            <!-- Delete All Read Messages Button -->
            <form action="{{ route('admin.messages.destroy-read') }}" method="POST" class="d-inline delete-form" 
                  data-item-name="{{ $readCount }} Pesan yang Berstatus Sudah Dibaca" 
                  data-confirm-message="Apakah Anda yakin ingin menghapus SEMUA pesan yang sudah dibaca ({{ $readCount }} pesan)? Pesan baru yang belum dibaca akan tetap tersimpan aman.">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1" id="btnDeleteRead" {{ $readCount === 0 ? 'disabled' : '' }} title="Hapus hanya pesan yang sudah dibaca">
                    <i class="bi bi-trash3"></i>
                    <span>Hapus Pesan Terbaca ({{ $readCount }})</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Hidden Form for Batch Deletion -->
    <form id="batchDeleteForm" action="{{ route('admin.messages.destroy-batch') }}" method="POST" class="d-none delete-form"
          data-item-name="0 Pesan Terpilih"
          data-confirm-message="Apakah Anda yakin ingin menghapus pesan-pesan terpilih ini secara permanen?">
        @csrf
        @method('DELETE')
        <div id="batchDeleteInputsContainer"></div>
    </form>

    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 44px;" class="text-center">
                        <div class="form-check d-flex justify-content-center m-0">
                            <input class="form-check-input" type="checkbox" id="selectAllMessagesCheckbox" title="Pilih Semua di Halaman Ini">
                        </div>
                    </th>
                    <th style="width: 60px;">Status</th>
                    <th>Pengirim</th>
                    <th>Email</th>
                    <th>Subjek Pesan</th>
                    <th>Waktu Diterima</th>
                    <th class="text-end" style="width: 110px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="messagesTableBody">
                @forelse($messages as $msg)
                    <tr class="{{ !$msg->is_read ? 'table-active' : '' }}" id="message-row-{{ $msg->id }}">
                        <td class="text-center">
                            <div class="form-check d-flex justify-content-center m-0">
                                <input class="form-check-input message-checkbox" type="checkbox" value="{{ $msg->id }}" data-sender="{{ $msg->name }}" id="msgCheck-{{ $msg->id }}">
                            </div>
                        </td>
                        <td>
                            @if(!$msg->is_read)
                                <span class="badge bg-danger rounded-pill" title="Belum Dibaca">Baru</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-25 text-muted" title="Sudah Dibaca">Dibaca</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold {{ !$msg->is_read ? 'text-primary' : '' }}">{{ $msg->name }}</div>
                        </td>
                        <td>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($msg->email) }}&su={{ urlencode('Re: ' . $msg->subject) }}" target="_blank" rel="noopener noreferrer" class="small text-subtle hover-primary" title="Balas via Gmail browser">{{ $msg->email }}</a>
                        </td>
                        <td>
                            <div class="fw-semibold small">{{ $msg->subject }}</div>
                            <small class="text-muted text-truncate d-block" style="max-width: 250px;">{{ $msg->message }}</small>
                        </td>
                        <td>
                            <span class="small text-muted">{{ $msg->created_at ? $msg->created_at->format('d M Y, H:i') : '-' }}</span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-outline-primary" title="Buka Pesan">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline delete-form" data-item-name="Pesan dari {{ $msg->name }} ({{ $msg->subject }})" data-confirm-message="Apakah Anda yakin ingin menghapus pesan kontak ini dari kotak masuk?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyMessagesRow">
                        <td colspan="7" class="text-center py-4 text-subtle">Kotak masuk masih kosong. Belum ada pesan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectAllCheckbox = document.getElementById('selectAllMessagesCheckbox');
        const btnDeleteSelected = document.getElementById('btnDeleteSelected');
        const selectedCountNumber = document.getElementById('selectedCountNumber');
        const btnToggleSelection = document.getElementById('btnToggleSelection');
        const btnToggleSelectionText = document.getElementById('btnToggleSelectionText');
        const batchDeleteForm = document.getElementById('batchDeleteForm');
        const batchDeleteInputsContainer = document.getElementById('batchDeleteInputsContainer');

        function updateSelectionState() {
            const checkboxes = document.querySelectorAll('.message-checkbox');
            const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');
            const count = checkedBoxes.length;

            if (selectedCountNumber) {
                selectedCountNumber.textContent = count;
            }

            if (count > 0) {
                btnDeleteSelected.style.display = 'inline-flex';
                if (btnToggleSelectionText) {
                    btnToggleSelectionText.textContent = 'Batal Pilih';
                }
            } else {
                btnDeleteSelected.style.display = 'none';
                if (btnToggleSelectionText) {
                    btnToggleSelectionText.textContent = 'Pilih Hapus Pesan';
                }
            }

            // Sync selectAll checkbox
            if (selectAllCheckbox && checkboxes.length > 0) {
                selectAllCheckbox.checked = (count === checkboxes.length);
                selectAllCheckbox.indeterminate = (count > 0 && count < checkboxes.length);
            }

            // Highlight selected rows
            checkboxes.forEach(cb => {
                const tr = cb.closest('tr');
                if (tr) {
                    if (cb.checked) {
                        tr.classList.add('table-row-selected');
                    } else {
                        tr.classList.remove('table-row-selected');
                    }
                }
            });
        }

        // Global delegate for checkbox changes
        document.addEventListener('change', (e) => {
            if (e.target && e.target.classList.contains('message-checkbox')) {
                updateSelectionState();
            }
        });

        // Select All Checkbox Handler
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', () => {
                const checkboxes = document.querySelectorAll('.message-checkbox');
                checkboxes.forEach(cb => {
                    cb.checked = selectAllCheckbox.checked;
                });
                updateSelectionState();
            });
        }

        // Toggle Selection Mode Button Handler
        if (btnToggleSelection) {
            btnToggleSelection.addEventListener('click', () => {
                const checkboxes = document.querySelectorAll('.message-checkbox');
                const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');

                if (checkedBoxes.length > 0) {
                    checkboxes.forEach(cb => cb.checked = false);
                } else {
                    checkboxes.forEach(cb => cb.checked = true);
                }
                updateSelectionState();
            });
        }

        // Batch Delete Submit Trigger
        if (btnDeleteSelected && batchDeleteForm && batchDeleteInputsContainer) {
            btnDeleteSelected.addEventListener('click', () => {
                const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');
                if (checkedBoxes.length === 0) return;

                batchDeleteInputsContainer.innerHTML = '';
                checkedBoxes.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = cb.value;
                    batchDeleteInputsContainer.appendChild(input);
                });

                const count = checkedBoxes.length;
                batchDeleteForm.dataset.itemName = `${count} Pesan Terpilih`;
                batchDeleteForm.dataset.confirmMessage = `Apakah Anda yakin ingin menghapus ${count} pesan terpilih ini secara permanen dari kontak masuk?`;

                // Dispatch submit to trigger our universal elegant delete modal
                batchDeleteForm.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
            });
        }

        // Initial check
        updateSelectionState();
    });
</script>
@endsection
