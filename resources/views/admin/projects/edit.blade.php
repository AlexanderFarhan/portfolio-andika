@extends('admin.layouts.admin')

@section('title', 'Edit Project')
@section('page-title', 'Edit Data Project: ' . $project->title)

@section('content')
<div class="glass-card p-4" style="max-width: 900px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Edit Project: {{ $project->title }}</h2>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label class="form-label small fw-semibold">Judul Project</label>
                <input type="text" name="title" class="form-control form-control-custom" value="{{ old('title', $project->title) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Slug</label>
                <input type="text" name="slug" class="form-control form-control-custom" value="{{ old('slug', $project->slug) }}">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Kategori</label>
                <select name="category" class="form-select form-control-custom" required>
                    <option value="Web Development" {{ old('category', $project->category) == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                    <option value="IoT & Embedded System" {{ old('category', $project->category) == 'IoT & Embedded System' ? 'selected' : '' }}>IoT &amp; Embedded System</option>
                    <option value="Computer Networking" {{ old('category', $project->category) == 'Computer Networking' ? 'selected' : '' }}>Computer Networking</option>
                    <option value="System Administration" {{ old('category', $project->category) == 'System Administration' ? 'selected' : '' }}>System Administration</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Teknologi Digunakan (Pisahkan Koma)</label>
                @php
                    $techString = is_array($project->technologies) ? implode(', ', $project->technologies) : $project->technologies;
                @endphp
                <input type="text" name="technologies" class="form-control form-control-custom" value="{{ old('technologies', $techString) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Ringkasan Singkat (Summary)</label>
            <input type="text" name="summary" class="form-control form-control-custom" value="{{ old('summary', $project->summary) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Deskripsi Lengkap &amp; Fitur</label>
            <textarea name="description" rows="5" class="form-control form-control-custom" required>{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Link Demo / Preview URL</label>
                <input type="url" name="demo_url" class="form-control form-control-custom" value="{{ old('demo_url', $project->demo_url) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Link Repositori GitHub</label>
                <input type="url" name="github_url" class="form-control form-control-custom" value="{{ old('github_url', $project->github_url) }}">
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Ganti Gambar Mockup</label>
                <input type="file" name="image_file" class="form-control form-control-custom" accept="image/*">
                @if($project->image)
                    <div class="mt-2">
                        <small class="text-subtle d-block mb-1">Gambar saat ini:</small>
                        <img src="{{ $project->image }}" alt="{{ $project->title }}" class="rounded shadow-sm" style="height: 60px;">
                    </div>
                @endif
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Urutan Tampil</label>
                <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', $project->order) }}">
            </div>
            <div class="col-md-3 d-flex align-items-center pt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label small fw-semibold" for="is_featured">
                        Featured Project
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-save me-1"></i> Perbarui Data Project
        </button>
    </form>
</div>
@endsection
