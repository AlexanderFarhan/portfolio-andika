@extends('admin.layouts.admin')

@section('title', 'Edit Pengalaman')
@section('page-title', 'Edit Pengalaman: ' . $experience->role)

@section('content')
<div class="glass-card p-4" style="max-width: 750px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Edit Pengalaman: {{ $experience->role }}</h2>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-md-7">
                <label class="form-label small fw-semibold">Posisi / Role</label>
                <input type="text" name="role" class="form-control form-control-custom" value="{{ old('role', $experience->role) }}" required>
            </div>
            <div class="col-md-5">
                <label class="form-label small fw-semibold">Tipe Pengalaman</label>
                <select name="type" class="form-select form-control-custom" required>
                    <option value="Freelance / Projects" {{ old('type', $experience->type) == 'Freelance / Projects' ? 'selected' : '' }}>Freelance / Projects</option>
                    <option value="Internship" {{ old('type', $experience->type) == 'Internship' ? 'selected' : '' }}>Internship / Magang</option>
                    <option value="Academic / Research" {{ old('type', $experience->type) == 'Academic / Research' ? 'selected' : '' }}>Academic / Research</option>
                    <option value="Full-time" {{ old('type', $experience->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('type', $experience->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Perusahaan / Organisasi</label>
            <input type="text" name="company" class="form-control form-control-custom" value="{{ old('company', $experience->company) }}" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Tanggal / Periode Mulai</label>
                <input type="text" name="start_date" class="form-control form-control-custom" value="{{ old('start_date', $experience->start_date) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Tanggal / Periode Selesai</label>
                <input type="text" name="end_date" class="form-control form-control-custom" value="{{ old('end_date', $experience->end_date) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Deskripsi Tanggung Jawab &amp; Kontribusi</label>
            <textarea name="description" rows="4" class="form-control form-control-custom">{{ old('description', $experience->description) }}</textarea>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-8">
                <label class="form-label small fw-semibold">Teknologi / Skill Terpakai</label>
                <input type="text" name="skills_used" class="form-control form-control-custom" value="{{ old('skills_used', $experience->skills_used) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Urutan Urut</label>
                <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', $experience->order) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-save me-1"></i> Perbarui Data Pengalaman
        </button>
    </form>
</div>
@endsection
