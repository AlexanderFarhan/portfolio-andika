@extends('admin.layouts.admin')

@section('title', 'Edit Sertifikat')
@section('page-title', 'Edit Sertifikat: ' . $certificate->title)

@section('content')
<div class="glass-card p-4" style="max-width: 750px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Edit Sertifikat: {{ $certificate->title }}</h2>
        <a href="{{ route('admin.certificates.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label small fw-semibold">Judul Sertifikat / Prestasi</label>
            <input type="text" name="title" class="form-control form-control-custom" value="{{ old('title', $certificate->title) }}" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-7">
                <label class="form-label small fw-semibold">Lembaga Penerbit / Penyelenggara</label>
                <input type="text" name="issuer" class="form-control form-control-custom" value="{{ old('issuer', $certificate->issuer) }}" required>
            </div>
            <div class="col-md-5">
                <label class="form-label small fw-semibold">Tahun Terbit</label>
                <input type="text" name="issue_date" class="form-control form-control-custom" value="{{ old('issue_date', $certificate->issue_date) }}" required>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Nomor Kredensial / ID Sertifikat</label>
                <input type="text" name="credential_id" class="form-control form-control-custom" value="{{ old('credential_id', $certificate->credential_id) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">URL Verifikasi Kredensial</label>
                <input type="url" name="credential_url" class="form-control form-control-custom" value="{{ old('credential_url', $certificate->credential_url) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Deskripsi / Kompetensi yang Dicapai</label>
            <textarea name="description" rows="3" class="form-control form-control-custom">{{ old('description', $certificate->description) }}</textarea>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-8">
                <label class="form-label small fw-semibold">Ganti Gambar Sertifikat</label>
                <input type="file" name="image_file" class="form-control form-control-custom" accept="image/*">
                @if($certificate->image)
                    <div class="mt-2">
                        <small class="text-subtle d-block mb-1">Gambar saat ini:</small>
                        <img src="{{ $certificate->image }}" alt="{{ $certificate->title }}" class="rounded shadow-sm" style="height: 50px;">
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Urutan Urut</label>
                <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', $certificate->order) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-save me-1"></i> Perbarui Data Sertifikat
        </button>
    </form>
</div>
@endsection
