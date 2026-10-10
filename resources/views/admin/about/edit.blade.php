@extends('admin.layouts.admin')

@section('title', 'Kelola Section About (Tentang Saya)')
@section('page-title', 'Kelola Konten About & Pilar Keahlian')

@section('content')
<div class="row g-4">
    <div class="col-xl-8">
        <div class="glass-card p-4">
            <h2 class="h5 fw-bold mb-3 pb-2 border-bottom border-subtle font-heading">
                <i class="bi bi-person-lines-fill text-primary me-2"></i> Pengaturan Konten "Tentang Saya"
            </h2>

            <form action="{{ route('admin.about.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Section Titles -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Judul Section Utama</label>
                        <input type="text" name="about_title" class="form-control form-control-custom" value="{{ old('about_title', $profile->about_title ?? 'Tentang Andika Amansyah') }}" required>
                        <small class="text-muted" style="font-size: 0.72rem;">Judul heading yang tampil di section About.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Headline Profil</label>
                        <input type="text" name="headline" class="form-control form-control-custom" value="{{ old('headline', $profile->headline) }}" required>
                        <small class="text-muted" style="font-size: 0.72rem;">Headline keahlian / peran utama Anda.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Subjudul / Deskripsi Singkat Section</label>
                    <textarea name="about_subtitle" rows="2" class="form-control form-control-custom" placeholder="Kombinasi analisis kebutuhan bisnis yang terstruktur, algoritma problem-solving terukur...">{{ old('about_subtitle', $profile->about_subtitle ?? 'Kombinasi analisis kebutuhan bisnis yang terstruktur, algoritma problem-solving terukur, serta keahlian teknis pengembangan aplikasi dan jaringan komputer.') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Fokus Bidang Utama (Bio Focus)</label>
                    <input type="text" name="bio_focus" class="form-control form-control-custom" value="{{ old('bio_focus', $profile->bio_focus) }}" required>
                    <small class="text-muted" style="font-size: 0.72rem;">Contoh: System Analysis, Problem Solving, Web Development, dan Networking</small>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-semibold">Cerita / Narasi Lengkap Tentang Saya (About Me)</label>
                    <textarea name="about_me" rows="6" class="form-control form-control-custom" required>{{ old('about_me', $profile->about_me) }}</textarea>
                    <small class="text-muted" style="font-size: 0.72rem;">Mendukung pemisahan paragraf secara rapi pada halaman publik.</small>
                </div>

                <!-- 4 Pillars Section -->
                <div class="pt-3 border-top border-subtle mb-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="h6 fw-bold mb-0 text-white font-heading">
                            <i class="bi bi-grid-1x2-fill text-primary me-2"></i> Pilar Keahlian &amp; Fokus Kompetensi
                        </h3>
                        <span class="badge bg-primary bg-opacity-15 text-primary small">4 Pilar Utama</span>
                    </div>
                    <p class="small text-subtle mb-4">
                        Kartu sorotan pilar yang tampil di samping narasi diri Anda pada halaman publik.
                    </p>

                    <div class="row g-3" id="pillarsContainer">
                        @foreach($pillars as $index => $pillar)
                            <div class="col-md-6 pillar-card-item">
                                <div class="p-3 rounded-3 border border-secondary border-opacity-25" style="background: rgba(15, 23, 42, 0.4);">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="badge bg-secondary bg-opacity-25 text-light small">Pilar #{{ $index + 1 }}</span>
                                        <span class="text-muted small"><i class="bi {{ $pillar['icon'] ?? 'bi-check2' }} text-primary"></i></span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label text-muted mb-1" style="font-size: 0.75rem;">Judul Pilar</label>
                                        <input type="text" name="pillars[{{ $index }}][title]" class="form-control form-control-sm form-control-custom" value="{{ old('pillars.' . $index . '.title', $pillar['title'] ?? '') }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label text-muted mb-1" style="font-size: 0.75rem;">Ikon Bootstrap (class)</label>
                                        <input type="text" name="pillars[{{ $index }}][icon]" class="form-control form-control-sm form-control-custom" value="{{ old('pillars.' . $index . '.icon', $pillar['icon'] ?? 'bi-star') }}" placeholder="bi-code-square" required>
                                    </div>
                                    <div>
                                        <label class="form-label text-muted mb-1" style="font-size: 0.75rem;">Deskripsi Singkat Pilar</label>
                                        <textarea name="pillars[{{ $index }}][description]" rows="2" class="form-control form-control-sm form-control-custom" required>{{ old('pillars.' . $index . '.description', $pillar['description'] ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top border-subtle">
                    <button type="submit" class="btn btn-primary-custom px-4 py-2">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan About
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Guidance & Preview Card -->
    <div class="col-xl-4">
        <div class="glass-card p-4 mb-4">
            <h3 class="h6 fw-bold mb-3 pb-2 border-bottom border-subtle font-heading text-white">
                <i class="bi bi-info-circle text-primary me-2"></i> Panduan Section About
            </h3>
            <ul class="list-unstyled small text-subtle mb-0 d-flex flex-column gap-2">
                <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-check-circle-fill text-success mt-1"></i>
                    <span>Setiap perubahan yang Anda simpan di sini akan langsung terlihat di section <code>#about</code> halaman publik.</span>
                </li>
                <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-check-circle-fill text-success mt-1"></i>
                    <span>Gunakan nama class resmi Bootstrap Icons (misal: <code>bi-diagram-3-fill</code>, <code>bi-router-fill</code>, <code>bi-code-square</code>, <code>bi-lightbulb-fill</code>).</span>
                </li>
                <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-check-circle-fill text-success mt-1"></i>
                    <span>Teks narasi profil mendukung format multi-baris sehingga keterbacaan tetap terjaga di desktop maupun mobile.</span>
                </li>
            </ul>
        </div>

        <div class="glass-card p-4">
            <h3 class="h6 fw-bold mb-3 pb-2 border-bottom border-subtle font-heading text-white">
                <i class="bi bi-eye text-primary me-2"></i> Tautan Cepat
            </h3>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-sm btn-outline-custom text-start">
                    <i class="bi bi-person-badge me-2"></i> Kelola Foto &amp; Kontak Profil
                </a>
                <a href="{{ route('portfolio.index') }}#about" target="_blank" class="btn btn-sm btn-outline-custom text-start">
                    <i class="bi bi-box-arrow-up-right me-2"></i> Lihat Tampilan Publik (#about)
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
