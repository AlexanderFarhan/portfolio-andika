@extends('admin.layouts.admin')

@section('title', 'Edit Profil & Informasi Utama')
@section('page-title', 'Kelola Profil Andika Amansyah')

@section('content')
<div class="row g-4">
    <div class="col-xl-8">
        <div class="glass-card p-4">
            <h2 class="h5 fw-bold mb-3 pb-2 border-bottom border-subtle font-heading">
                <i class="bi bi-person-lines-fill text-primary me-2"></i> Informasi Pribadi &amp; Bio
            </h2>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-custom" value="{{ old('name', $profile->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Status / Tagline Kampus</label>
                        <input type="text" name="tagline" class="form-control form-control-custom" value="{{ old('tagline', $profile->tagline) }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Headline Profesional</label>
                        <input type="text" name="headline" class="form-control form-control-custom" value="{{ old('headline', $profile->headline) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Fokus Bidang Utama</label>
                        <input type="text" name="bio_focus" class="form-control form-control-custom" value="{{ old('bio_focus', $profile->bio_focus) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Tentang Saya (About Me)</label>
                    <textarea name="about_me" rows="5" class="form-control form-control-custom" required>{{ old('about_me', $profile->about_me) }}</textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control form-control-custom" value="{{ old('email', $profile->email) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Nomor WhatsApp / HP</label>
                        <input type="text" name="phone" class="form-control form-control-custom" value="{{ old('phone', $profile->phone) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Lokasi Domisili</label>
                        <input type="text" name="location" class="form-control form-control-custom" value="{{ old('location', $profile->location) }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Pengalaman Proyek</label>
                        <input type="text" name="years_of_experience" class="form-control form-control-custom" value="{{ old('years_of_experience', $profile->years_of_experience) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Total Proyek Selesai</label>
                        <input type="number" name="completed_projects" class="form-control form-control-custom" value="{{ old('completed_projects', $profile->completed_projects) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">IPK / GPA</label>
                        <input type="text" name="gpa" class="form-control form-control-custom" value="{{ old('gpa', $profile->gpa) }}">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Ganti Foto Profil / Avatar</label>
                        <input type="file" name="avatar_file" class="form-control form-control-custom" accept="image/*">
                        <small class="text-muted" style="font-size: 0.75rem;">Mendukung JPG, PNG, WEBP, SVG (Max 2MB)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Upload Berkas CV PDF</label>
                        <input type="file" name="resume_file" class="form-control form-control-custom" accept="application/pdf">
                        <small class="text-muted" style="font-size: 0.75rem;">Mendukung PDF (Max 5MB)</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-custom px-4">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan Profil
                </button>
            </form>
        </div>
    </div>

    <!-- Preview Card -->
    <div class="col-xl-4">
        <div class="glass-card p-4 text-center">
            <h3 class="h6 fw-bold mb-3 pb-2 border-bottom border-subtle font-heading text-start">
                <i class="bi bi-image text-primary me-2"></i> Preview Foto Profil
            </h3>
            <div class="mb-3 d-inline-block p-2 rounded-4" style="background: var(--gradient-primary);">
                <img src="{{ $profile->avatar ?? '/images/avatar-andika.svg' }}" alt="{{ $profile->name }}" class="rounded-3 shadow" style="width: 140px; height: 140px; object-fit: cover; background: #0f172a;">
            </div>
            <h4 class="h5 fw-bold mb-1 font-heading">{{ $profile->name }}</h4>
            <p class="text-primary small fw-semibold mb-2">{{ $profile->headline }}</p>
            <p class="text-subtle small mb-3">{{ $profile->tagline }}</p>

            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-sm btn-outline-custom">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Lihat CV
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
