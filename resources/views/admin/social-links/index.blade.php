@extends('admin.layouts.admin')

@section('title', 'Kelola Social Media')
@section('page-title', 'Tautan Media Sosial')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="h5 fw-bold mb-1 font-heading">Media Sosial &amp; Kontak Eksternal</h2>
            <p class="text-subtle small mb-0">Total {{ $socialLinks->count() }} tautan tersimpan</p>
        </div>
        <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle me-1"></i> Tambah Social Link
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">Urutan</th>
                    <th>Platform</th>
                    <th>Icon</th>
                    <th>URL Tautan</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($socialLinks as $s)
                    <tr>
                        <td class="fw-bold text-subtle">{{ $s->order }}</td>
                        <td>
                            <span class="fw-bold"><i class="bi {{ $s->icon }} me-2 text-primary"></i>{{ $s->platform }}</span>
                        </td>
                        <td><code>{{ $s->icon }}</code></td>
                        <td><a href="{{ $s->url }}" target="_blank" class="small text-truncate d-inline-block" style="max-width: 250px;">{{ $s->url }}</a></td>
                        <td>
                            @if($s->is_active)
                                <span class="badge bg-success bg-opacity-20 text-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-25 text-muted">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.social-links.edit', $s->id) }}" class="btn btn-outline-info" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.social-links.destroy', $s->id) }}" method="POST" class="d-inline delete-form" data-item-name="Tautan {{ $s->platform }} ({{ $s->username }})" data-confirm-message="Apakah Anda yakin ingin menghapus tautan media sosial ini?">
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
                        <td colspan="6" class="text-center py-4 text-subtle">Belum ada data media sosial.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
