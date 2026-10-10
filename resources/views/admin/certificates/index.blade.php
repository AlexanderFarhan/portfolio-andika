@extends('admin.layouts.admin')

@section('title', 'Kelola Sertifikat')
@section('page-title', 'Sertifikat &amp; Pencapaian (Certificates)')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="h5 fw-bold mb-1 font-heading">Daftar Sertifikasi &amp; Prestasi</h2>
            <p class="text-subtle small mb-0">Total {{ $certificates->count() }} sertifikat tersimpan</p>
        </div>
        <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle me-1"></i> Tambah Sertifikat
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">Urutan</th>
                    <th style="width: 70px;">Media</th>
                    <th>Judul Sertifikat</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>No. Kredensial</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $c)
                    <tr>
                        <td class="fw-bold text-subtle">{{ $c->order }}</td>
                        <td>
                            @if($c->image)
                                <img src="{{ $c->image }}" alt="{{ $c->title }}" class="rounded shadow-sm" style="width: 55px; height: 38px; object-fit: cover;">
                            @else
                                <span class="badge bg-secondary">No Pic</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold">{{ $c->title }}</div>
                            <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{ $c->description }}</small>
                        </td>
                        <td><span class="badge bg-secondary bg-opacity-25 text-info">{{ $c->issuer }}</span></td>
                        <td>{{ $c->issue_date }}</td>
                        <td><code>{{ $c->credential_id ?? '-' }}</code></td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.certificates.edit', $c->id) }}" class="btn btn-outline-info" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.certificates.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Hapus sertifikat ini?')" class="d-inline">
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
                        <td colspan="7" class="text-center py-4 text-subtle">Belum ada data sertifikat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
