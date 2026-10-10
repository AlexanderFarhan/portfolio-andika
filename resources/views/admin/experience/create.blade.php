@extends('admin.layouts.admin')

@section('title', 'Tambah Pengalaman Baru')
@section('page-title', 'Tambah Pengalaman')

@section('content')
<div class="glass-card p-4" style="max-width: 750px;">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-subtle">
        <h2 class="h5 fw-bold mb-0 font-heading">Input Pengalaman Baru</h2>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.experiences.store') }}" method="POST">
        @csrf

        <div class="row g-3 mb-3">
            <div class="col-md-7">
                <label class="form-label small fw-semibold">Posisi / Role</label>
                <input type="text" name="role" class="form-control form-control-custom" value="{{ old('role') }}" placeholder="Contoh: System Analyst & Full-Stack Developer" required>
            </div>
            <div class="col-md-5">
                <label class="form-label small fw-semibold">Tipe Pengalaman</label>
                <select name="type" class="form-select form-control-custom" required>
                    <option value="Freelance / Projects">Freelance / Projects</option>
                    <option value="Internship">Internship / Magang</option>
                    <option value="Academic / Research">Academic / Research</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Perusahaan / Organisasi / Lembaga</label>
            <input type="text" name="company" class="form-control form-control-custom" value="{{ old('company') }}" placeholder="Contoh: Campus Networking Lab / Freelance" required>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Tanggal / Periode Mulai</label>
                <input type="text" name="start_date" class="form-control form-control-custom" value="{{ old('start_date') }}" placeholder="Jan 2024" required>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-semibold">Tanggal / Periode Selesai</label>
                <input type="text" name="end_date" class="form-control form-control-custom" value="{{ old('end_date') }}" placeholder="Sekarang">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-semibold">Deskripsi Tanggung Jawab &amp; Kontribusi</label>
            <textarea name="description" rows="4" class="form-control form-control-custom" placeholder="Jelaskan peran, tanggung jawab, dan hasil kerja...">{{ old('description') }}</textarea>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-8">
                <label class="form-label small fw-semibold">Teknologi / Skill Terpakai</label>
                <input type="text" name="skills_used" class="form-control form-control-custom" value="{{ old('skills_used') }}" placeholder="Laravel, MySQL, MikroTik, REST API">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Urutan Urut</label>
                <input type="number" name="order" class="form-control form-control-custom" value="{{ old('order', 1) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary-custom px-4">
            <i class="bi bi-check2-circle me-1"></i> Simpan Pengalaman
        </button>
    </form>
</div>
@endsection
