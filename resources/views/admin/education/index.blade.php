@extends('admin.layouts.admin')

@section('title', 'Kelola Pendidikan')
@section('page-title', 'Riwayat Pendidikan (Education)')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="h5 fw-bold mb-1 font-heading">Data Riwayat Pendidikan</h2>
            <p class="text-subtle small mb-0">Institusi dan jenjang pendidikan formal Andika Amansyah</p>
        </div>
        <a href="{{ route('admin.educations.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pendidikan
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">Urutan</th>
                    <th>Institusi Kampus / Sekolah</th>
                    <th>Gelar / Jenjang</th>
                    <th>Periode</th>
                    <th>IPK / Nilai</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($educations as $edu)
                    <tr>
                        <td class="fw-bold text-subtle">{{ $edu->order }}</td>
                        <td>
                            <div class="fw-bold">{{ $edu->institution }}</div>
                            <small class="text-muted">{{ $edu->field_of_study }}</small>
                        </td>
                        <td>{{ $edu->degree }}</td>
                        <td>
                            <span class="badge bg-secondary bg-opacity-25 text-info">
                                {{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}
                            </span>
                        </td>
                        <td><span class="badge bg-success bg-opacity-15 text-success">{{ $edu->gpa ?? '-' }}</span></td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.educations.edit', $edu->id) }}" class="btn btn-outline-info" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.educations.destroy', $edu->id) }}" method="POST" class="d-inline delete-form" data-item-name="{{ $edu->degree }} di {{ $edu->institution }}" data-confirm-message="Apakah Anda yakin ingin menghapus data riwayat pendidikan ini?">
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
                        <td colspan="6" class="text-center py-4 text-subtle">Belum ada data pendidikan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
