@extends('admin.layouts.admin')

@section('title', 'Kelola Projects')
@section('page-title', 'Daftar Portofolio Project')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="h5 fw-bold mb-1 font-heading">Semua Project Portofolio</h2>
            <p class="text-subtle small mb-0">Total {{ $projects->count() }} project tersimpan dalam database</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle me-1"></i> Tambah Project Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">Urutan</th>
                    <th style="width: 80px;">Media</th>
                    <th>Judul Project</th>
                    <th>Kategori</th>
                    <th>Teknologi</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $p)
                    <tr>
                        <td class="fw-bold text-subtle">{{ $p->order }}</td>
                        <td>
                            @if($p->image)
                                <img src="{{ $p->image }}" alt="{{ $p->title }}" class="rounded shadow-sm" style="width: 60px; height: 42px; object-fit: cover;">
                            @else
                                <span class="badge bg-secondary">No Pic</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold">{{ $p->title }}</div>
                            <small class="text-subtle text-truncate d-block" style="max-width: 250px;">{{ $p->summary }}</small>
                        </td>
                        <td>
                            <span class="badge bg-primary bg-opacity-15 text-primary">{{ $p->category }}</span>
                        </td>
                        <td>
                            @if(is_array($p->technologies))
                                @foreach(array_slice($p->technologies, 0, 3) as $tech)
                                    <span class="badge bg-secondary bg-opacity-25 text-light" style="font-size: 0.72rem;">{{ $tech }}</span>
                                @endforeach
                                @if(count($p->technologies) > 3)
                                    <span class="text-muted small">+{{ count($p->technologies) - 3 }}</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($p->is_featured)
                                <span class="badge bg-success bg-opacity-20 text-success">Featured</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-25 text-muted">Standard</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.projects.edit', $p->id) }}" class="btn btn-outline-info" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini?')" class="d-inline">
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
                        <td colspan="7" class="text-center py-4 text-subtle">Belum ada data project.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
