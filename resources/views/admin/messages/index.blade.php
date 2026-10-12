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
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <h2 class="h5 fw-bold mb-0 font-heading">Pesan Kontak dari Pengunjung</h2>
                <span class="badge bg-success bg-opacity-15 text-success small border border-success border-opacity-25 px-2 py-1 d-inline-flex align-items-center gap-1">
                    <span class="live-pulse-dot" style="width: 7px; height: 7px; background: #10b981; border-radius: 50%; display: inline-block;"></span>
                    Live Sync
                </span>
            </div>
            <p class="text-subtle small mb-0" id="messagesCountSubtitle">Total {{ $messages->total() }} pesan masuk melalui form kontak website</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">Status</th>
                    <th>Pengirim</th>
                    <th>Email</th>
                    <th>Subjek Pesan</th>
                    <th>Waktu Diterima</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody id="messagesTableBody">
                @forelse($messages as $msg)
                    <tr class="{{ !$msg->is_read ? 'table-active' : '' }}">
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
                            <a href="mailto:{{ $msg->email }}" class="small text-subtle">{{ $msg->email }}</a>
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
                        <td colspan="6" class="text-center py-4 text-subtle">Kotak masuk masih kosong. Belum ada pesan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection
