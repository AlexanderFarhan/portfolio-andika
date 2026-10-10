@extends('admin.layouts.admin')

@section('title', 'Edit Skill')
@section('page-title', 'Edit Keahlian: ' . $skill->name)

@section('content')
<div class="glass-card p-4" style="max-width: 700px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Edit Data Skill: {{ $skill->name }}</h2>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label small fw-semibold">Nama Skill / Teknologi</label>
            <input type="text" name="name" class="form-control form-control-custom" value="{{ old('name', $skill->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Kategori Skill</label>
            <select name="category" class="form-select form-control-custom" required>
                <option value="Web Development" {{ old('category', $skill->category) == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                <option value="System Analysis & Problem Solving" {{ old('category', $skill->category) == 'System Analysis & Problem Solving' ? 'selected' : '' }}>System Analysis &amp; Problem Solving</option>
                <option value="Computer Networking" {{ old('category', $skill->category) == 'Computer Networking' ? 'selected' : '' }}>Computer Networking</option>
                <option value="Embedded & IoT" {{ old('category', $skill->category) == 'Embedded & IoT' ? 'selected' : '' }}>Embedded &amp; IoT</option>
                <option value="Tools & Workflows" {{ old('category', $skill->category) == 'Tools & Workflows' ? 'selected' : '' }}>Tools &amp; Workflows</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Tingkat Penguasaan (1 - 100%)</label>
            <input type="number" name="proficiency" class="form-control form-control-custom" min="1" max="100" value="{{ old('proficiency', $skill->proficiency) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Icon Bootstrap (Class)</label>
            <input type="text" name="icon" class="form-control form-control-custom" value="{{ old('icon', $skill->icon) }}">
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Urutan Urut</label>
                <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', $skill->order) }}">
            </div>
            <div class="col-md-6 d-flex align-items-center pt-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $skill->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label small fw-semibold" for="is_featured">
                        Tampilkan di Featured
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-save me-1"></i> Perbarui Data Skill
        </button>
    </form>
</div>
@endsection
