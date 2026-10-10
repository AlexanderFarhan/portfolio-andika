@extends('admin.layouts.admin')

@section('title', 'Tambah Project Baru')
@section('page-title', 'Tambah Project Portofolio')

@section('content')
<div class="glass-card p-4" style="max-width: 900px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Form Input Project Baru</h2>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label class="form-label small fw-semibold">Judul Project</label>
                <input type="text" name="title" class="form-control form-control-custom" value="{{ old('title') }}" placeholder="Contoh: Web Penggajian Karyawan — Laravel" required>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Slug (Opsional)</label>
                <input type="text" name="slug" class="form-control form-control-custom" value="{{ old('slug') }}" placeholder="web-penggajian-karyawan">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Kategori</label>
                <select name="category" class="form-select form-control-custom" required>
                    <option value="">Pilih Kategori...</option>
                    <option value="Web Development" {{ old('category') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                    <option value="IoT & Embedded System" {{ old('category') == 'IoT & Embedded System' ? 'selected' : '' }}>IoT &amp; Embedded System</option>
                    <option value="Computer Networking" {{ old('category') == 'Computer Networking' ? 'selected' : '' }}>Computer Networking</option>
                    <option value="System Administration" {{ old('category') == 'System Administration' ? 'selected' : '' }}>System Administration</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Teknologi Digunakan (Pisahkan Koma)</label>
                <input type="text" name="technologies" class="form-control form-control-custom" value="{{ old('technologies') }}" placeholder="Laravel 12, MySQL, Bootstrap 5, DomPDF" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Ringkasan Singkat (Summary)</label>
            <input type="text" name="summary" class="form-control form-control-custom" value="{{ old('summary') }}" placeholder="Penjelasan 1-2 kalimat tentang fungsi utama project..." required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Deskripsi Lengkap &amp; Fitur</label>
            <textarea name="description" rows="5" class="form-control form-control-custom" placeholder="Tuliskan latar belakang masalah, solusi, dan poin-poin fitur utama..." required>{{ old('description') }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Link Demo / Preview URL</label>
                <input type="url" name="demo_url" class="form-control form-control-custom" value="{{ old('demo_url') }}" placeholder="https://demo.andika.dev">
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Link Repositori GitHub</label>
                <input type="url" name="github_url" class="form-control form-control-custom" value="{{ old('github_url') }}" placeholder="https://github.com/andika-amansyah/repo">
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Upload Gambar Mockup / Screenshot</label>
                <input type="file" name="image_file" class="form-control form-control-custom" accept="image/*">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Urutan Tampil</label>
                <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', 1) }}">
            </div>
            <div class="col-md-3 d-flex align-items-center pt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                    <label class="form-check-label small fw-semibold" for="is_featured">
                        Featured Project
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-check2-circle me-1"></i> Simpan Project Baru
        </button>
    </form>
</div>
@endsection
