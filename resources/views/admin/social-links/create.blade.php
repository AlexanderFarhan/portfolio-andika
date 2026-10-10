@extends('admin.layouts.admin')

@section('title', 'Tambah Social Link')
@section('page-title', 'Tambah Tautan Media Sosial')

@section('content')
<div class="glass-card p-4" style="max-width: 650px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Input Social Media Baru</h2>
        <a href="{{ route('admin.social-links.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.social-links.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label small fw-semibold">Nama Platform</label>
            <input type="text" name="platform" class="form-control form-control-custom" value="{{ old('platform') }}" placeholder="GitHub / LinkedIn / Instagram" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">URL Tautan</label>
            <input type="url" name="url" class="form-control form-control-custom" value="{{ old('url') }}" placeholder="https://..." required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Icon Bootstrap (Class)</label>
            <input type="text" name="icon" class="form-control form-control-custom" value="{{ old('icon', 'bi bi-link-45deg') }}" placeholder="bi bi-github" required>
            <small class="text-muted" style="font-size: 0.75rem;">Contoh: bi bi-github, bi bi-linkedin, bi bi-instagram, bi bi-whatsapp</small>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Urutan Urut</label>
                <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', 1) }}">
            </div>
            <div class="col-md-6 d-flex align-items-center pt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                    <label class="form-check-label small fw-semibold" for="is_active">
                        Status Aktif
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-check2-circle me-1"></i> Simpan Tautan
        </button>
    </form>
</div>
@endsection
