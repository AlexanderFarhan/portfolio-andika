@extends('admin.layouts.admin')

@section('title', 'Kelola Pengalaman')
@section('page-title', 'Pengalaman Kerja &amp; Proyek (Experience)')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="h5 fw-bold mb-1 font-heading">Daftar Pengalaman</h2>
            <p class="text-subtle small mb-0">Total {{ $experiences->count() }} pengalaman tersimpan</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pengalaman
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">Urutan</th>
                    <th>Peran / Posisi</th>
                    <th>Perusahaan / Organisasi</th>
                    <th>Tipe</th>
                    <th>Periode</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($experiences as $exp)
                    <tr>
                        <td class="fw-bold text-subtle">{{ $exp->order }}</td>
                        <td>
                            <div class="fw-bold">{{ $exp->role }}</div>
                            <small class="text-muted d-block text-truncate" style="max-width: 280px;">{{ $exp->skills_used }}</small>
                        </td>
                        <td>{{ $exp->company }}</td>
                        <td><span class="badge bg-secondary bg-opacity-25 text-info">{{ $exp->type }}</span></td>
                        <td><span class="small fw-semibold">{{ $exp->start_date }} — {{ $exp->end_date ?? 'Sekarang' }}</span></td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.experiences.edit', $exp->id) }}" class="btn btn-outline-info" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.experiences.destroy', $exp->id) }}" method="POST" class="d-inline delete-form" data-item-name="{{ $exp->role }} di {{ $exp->company }}" data-confirm-message="Apakah Anda yakin ingin menghapus data pengalaman kerja ini?">
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
                    <tr>
                        <td colspan="6" class="text-center py-4 text-subtle">Belum ada data pengalaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
