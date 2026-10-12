@extends('admin.layouts.admin')

@section('title', 'Kelola Skills')
@section('page-title', 'Daftar Keahlian &amp; Skills')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="h5 fw-bold mb-1 font-heading">Keahlian Teknis</h2>
            <p class="text-subtle small mb-0">Total {{ $skills->count() }} skill tersimpan</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle me-1"></i> Tambah Skill Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">Urutan</th>
                    <th>Nama Skill</th>
                    <th>Kategori</th>
                    <th>Tingkat Keahlian</th>
                    <th>Icon</th>
                    <th>Featured</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $s)
                    <tr>
                        <td class="fw-bold text-subtle">{{ $s->order }}</td>
                        <td>
                            <div class="fw-bold"><i class="bi {{ $s->icon ?? 'bi-check2' }} text-primary me-2"></i>{{ $s->name }}</div>
                        </td>
                        <td>
                            <span class="badge bg-secondary bg-opacity-25 text-light">{{ $s->category }}</span>
                        </td>
                        <td style="min-width: 180px;">
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $s->proficiency }}%;"></div>
                                </div>
                                <span class="small fw-semibold">{{ $s->proficiency }}%</span>
                            </div>
                        </td>
                        <td><code>{{ $s->icon }}</code></td>
                        <td>
                            @if($s->is_featured)
                                <span class="badge bg-success bg-opacity-20 text-success">Ya</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-25 text-muted">Tidak</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.skills.edit', $s->id) }}" class="btn btn-outline-info" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.skills.destroy', $s->id) }}" method="POST" class="d-inline delete-form" data-item-name="Keahlian: {{ $s->name }} ({{ $s->category }})" data-confirm-message="Apakah Anda yakin ingin menghapus keahlian teknis ini?">
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
                        <td colspan="7" class="text-center py-4 text-subtle">Belum ada data skill.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
