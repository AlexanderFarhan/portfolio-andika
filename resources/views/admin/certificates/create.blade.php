@extends('admin.layouts.admin')

@section('title', 'Tambah Sertifikat')
@section('page-title', 'Tambah Sertifikat Baru')

@section('content')
<div class="glass-card p-4" style="max-width: 750px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Input Sertifikat Baru</h2>
        <a href="{{ route('admin.certificates.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label small fw-semibold">Judul Sertifikat / Prestasi</label>
            <input type="text" name="title" class="form-control form-control-custom" value="{{ old('title') }}" placeholder="Contoh: Junior Web Developer - BNSP" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-7">
                <label class="form-label small fw-semibold">Lembaga Penerbit / Penyelenggara</label>
                <input type="text" name="issuer" class="form-control form-control-custom" value="{{ old('issuer') }}" placeholder="Contoh: BNSP / Dicoding / Cisco" required>
            </div>
            <div class="col-md-5">
                <label class="form-label small fw-semibold">Tahun Terbit</label>
                <input type="text" name="issue_date" class="form-control form-control-custom" value="{{ old('issue_date', '2024') }}" required>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Nomor Kredensial / ID Sertifikat</label>
                <input type="text" name="credential_id" class="form-control form-control-custom" value="{{ old('credential_id') }}" placeholder="BNSP-JWD-771892">
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">URL Verifikasi Kredensial</label>
                <input type="url" name="credential_url" class="form-control form-control-custom" value="{{ old('credential_url') }}" placeholder="https://bnsp.go.id/verify/...">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Deskripsi / Kompetensi yang Dicapai</label>
            <textarea name="description" rows="3" class="form-control form-control-custom">{{ old('description') }}</textarea>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-8">
                <label class="form-label small fw-semibold">Upload Berkas / Gambar Sertifikat</label>
                <input type="file" name="image_file" class="form-control form-control-custom" accept="image/*">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Urutan Urut</label>
                <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', 1) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-check2-circle me-1"></i> Simpan Sertifikat
        </button>
    </form>
</div>
@endsection
