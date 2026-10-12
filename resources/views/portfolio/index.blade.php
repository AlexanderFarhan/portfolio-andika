@extends('layouts.app')

@section('title', 'Andika Amansyah | Web Resume & Portfolio — Mahasiswa TI UBSI')

@section('content')

<!-- ==========================================================================
     SECTION 1: HERO / INTRODUCTION
     ========================================================================== -->
<section id="hero" class="hero-section">
    <div class="hero-glow-bg"></div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="reveal">
                    <div class="hero-badge mb-3">
                        <span class="pulse-dot"></span>
                        <span>Tersedia untuk Kolaborasi &amp; Proyek IT</span>
                    </div>

                    <h1 class="display-4 fw-extrabold mb-2 font-heading">
                        Halo, Saya <span class="text-gradient">{{ $profile->name ?? 'Andika Amansyah' }}</span>
                    </h1>

                    <h2 class="h4 fw-bold text-primary mb-3 font-heading">
                        {{ $profile->headline ?? 'System Analyst & Full-Stack Web Developer Enthusiast' }}
                    </h2>

                    <p class="lead mb-4 text-subtle" style="max-width: 620px;">
                        {{ $profile->tagline ?? 'Mahasiswa Teknologi Informasi — Universitas Bina Sarana Informatika (UBSI)' }}. Berfokus mendalam pada <strong style="color: var(--text-primary);">System Analysis, Problem Solving, Web Development, dan Networking</strong>.
                    </p>

                    <!-- Hero Call to Action Buttons -->
                    <div class="d-flex flex-wrap gap-3 align-items-center mb-5">
                        <a href="#projects" class="btn btn-primary-custom" id="heroProjectsBtn">
                            <i class="bi bi-rocket-takeoff-fill"></i> Lihat Portofolio
                        </a>
                        <a href="#contact" class="btn btn-outline-custom" id="heroContactBtn">
                            <i class="bi bi-chat-quote-fill"></i> Hubungi Saya
                        </a>
                        <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-outline-custom" id="heroCvBtn">
                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i> Download CV PDF
                        </a>
                    </div>

                    <!-- Micro Metrics Strip -->
                    <div class="d-flex flex-wrap gap-4 pt-3 border-top border-subtle">
                        <div>
                            <div class="fs-4 fw-bold font-heading" style="color: var(--text-primary);">{{ $profile->years_of_experience ?? '2+ Tahun' }}</div>
                            <div class="small text-muted">Pengalaman Proyek</div>
                        </div>
                        <div class="border-start border-subtle ps-4">
                            <div class="fs-4 fw-bold font-heading" style="color: var(--text-primary);">{{ $profile->completed_projects ?? '15+' }} Proyek</div>
                            <div class="small text-muted">Solusi Selesai</div>
                        </div>
                        <div class="border-start border-subtle ps-4">
                            <div class="fs-4 fw-bold font-heading" style="color: var(--text-primary);">{{ $profile->gpa ?? '3.85 / 4.00' }}</div>
                            <div class="small text-muted">IPK Mahasiswa UBSI</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Avatar & Graphic Visual -->
            <div class="col-lg-5 text-center">
                <div class="reveal">
                    <div class="hero-avatar-wrapper">
                        <!-- Floating Badge 1 -->
                        <div class="hero-floating-badge badge-1">
                            <i class="bi bi-mortarboard-fill text-primary fs-5"></i>
                            <div>
                                <div class="small fw-bold">UBSI Student</div>
                                <div class="text-muted" style="font-size: 0.72rem;">Teknologi Informasi</div>
                            </div>
                        </div>

                        <!-- Main Avatar with Glowing Ring -->
                        <div class="hero-avatar-border">
                            <img src="{{ $profile->avatar ?? '/images/avatar-andika.svg' }}" alt="{{ $profile->name ?? 'Andika Amansyah' }}" class="img-fluid" width="380" height="380">
                        </div>

                        <!-- Floating Badge 2 -->
                        <div class="hero-floating-badge badge-2">
                            <i class="bi bi-cpu-fill text-success fs-5"></i>
                            <div>
                                <div class="small fw-bold">Laravel &amp; IoT Ready</div>
                                <div class="text-muted" style="font-size: 0.72rem;">Microcontroller + REST API</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 2: ABOUT ME
     ========================================================================== -->
<section id="about" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-person-badge"></i> Profil Diri</span>
            <h2 class="section-title">
                @if(isset($profile->about_title) && $profile->about_title)
                    {{ $profile->about_title }}
                @else
                    Tentang <span class="text-gradient">{{ $profile->name ?? 'Andika Amansyah' }}</span>
                @endif
            </h2>
            <p class="section-desc">
                {{ $profile->about_subtitle ?? 'Kombinasi analisis kebutuhan bisnis yang terstruktur, algoritma problem-solving terukur, serta keahlian teknis pengembangan aplikasi dan jaringan komputer.' }}
            </p>
        </div>

        <div class="row g-4 align-items-center mb-5">
            <div class="col-lg-6">
                <div class="glass-card p-4 p-md-5 reveal h-100">
                    <h3 class="h4 fw-bold mb-3 font-heading" style="color: var(--text-primary);">
                        {{ $profile->headline ?? 'Mahasiswa Teknologi Informasi yang Berorientasi Solusi' }}
                    </h3>
                    <div class="text-subtle" style="line-height: 1.8; white-space: pre-line;">
                        {{ $profile->about_me ?? '' }}
                    </div>

                    <div class="row g-3 mt-4 pt-3 border-top border-subtle">
                        <div class="col-sm-6">
                            <div class="small text-muted">Nama Lengkap:</div>
                            <div class="fw-bold" style="color: var(--text-primary);">{{ $profile->name ?? 'Andika Amansyah' }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="small text-muted">Kampus:</div>
                            <div class="fw-bold" style="color: var(--text-primary);">Universitas Bina Sarana Informatika</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="small text-muted">Email:</div>
                            <div class="fw-bold" style="color: var(--text-primary);">{{ $profile->email ?? 'andika.amansyah@gmail.com' }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="small text-muted">Domisili:</div>
                            <div class="fw-bold" style="color: var(--text-primary);">{{ $profile->location ?? 'Bekasi / Jakarta' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Core Pillars Grid -->
            <div class="col-lg-6">
                <div class="row g-3">
                    @php
                        $pillars = $profile ? $profile->getActivePillars() : [];
                    @endphp
                    @foreach($pillars as $p)
                        <div class="col-sm-6 reveal">
                            <div class="glass-card p-4 h-100">
                                <div class="skill-icon-box">
                                    <i class="bi {{ $p['icon'] ?? 'bi-star-fill' }}"></i>
                                </div>
                                <h4 class="h6 fw-bold mb-2" style="color: var(--text-primary);">{{ $p['title'] ?? '' }}</h4>
                                <p class="small text-subtle mb-0">
                                    {{ $p['description'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 3: SKILLS
     ========================================================================== -->
<section id="skills" class="py-5 my-md-4 section-subtle-bg">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-tools"></i> Technical Competencies</span>
            <h2 class="section-title">Keahlian &amp; <span class="text-gradient">Teknologi</span></h2>
            <p class="section-desc">
                Daftar keterampilan teknis yang dikuasai untuk merancang, mengimplementasikan, dan mengelola solusi teknologi modern.
            </p>
        </div>

        <!-- Skills Filter Tabs -->
        <ul class="nav nav-pills justify-content-center gap-2 mb-4 reveal" id="skillsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4 rounded-pill" id="all-skills-tab" data-bs-toggle="pill" data-bs-target="#all-skills" type="button" role="tab">
                    Semua Keahlian
                </button>
            </li>
            @foreach($skillsByCategory as $category => $items)
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 rounded-pill" id="cat-{{ Str::slug($category) }}-tab" data-bs-toggle="pill" data-bs-target="#cat-{{ Str::slug($category) }}" type="button" role="tab">
                        {{ $category }}
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- Skills Content -->
        <div class="tab-content" id="skillsTabsContent">
            <!-- Tab: All Skills -->
            <div class="tab-pane fade show active" id="all-skills" role="tabpanel">
                <div class="row g-3">
                    @foreach($skills as $skill)
                        <div class="col-md-6 col-lg-4 reveal">
                            <div class="skill-card">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                                            <i class="bi {{ $skill->icon ?? 'bi-check2-circle' }} fs-5"></i>
                                        </div>
                                        <div>
                                            <h3 class="h6 mb-0 fw-bold" style="color: var(--text-primary);">{{ $skill->name }}</h3>
                                            <span class="skill-category-badge">{{ $skill->category }}</span>
                                        </div>
                                    </div>
                                    <span class="fw-bold text-primary font-mono">{{ $skill->proficiency }}%</span>
                                </div>
                                <div class="skill-progress-bar">
                                    <div class="skill-progress-fill" style="width: {{ $skill->proficiency }}%;"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab per Category -->
            @foreach($skillsByCategory as $category => $items)
                <div class="tab-pane fade" id="cat-{{ Str::slug($category) }}" role="tabpanel">
                    <div class="row g-3">
                        @foreach($items as $skill)
                            <div class="col-md-6 col-lg-4 reveal">
                                <div class="skill-card">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                                                <i class="bi {{ $skill->icon ?? 'bi-check2-circle' }} fs-5"></i>
                                            </div>
                                            <div>
                                                <h3 class="h6 mb-0 fw-bold" style="color: var(--text-primary);">{{ $skill->name }}</h3>
                                                <span class="skill-category-badge">{{ $skill->category }}</span>
                                            </div>
                                        </div>
                                        <span class="fw-bold text-primary font-mono">{{ $skill->proficiency }}%</span>
                                    </div>
                                    <div class="skill-progress-bar">
                                        <div class="skill-progress-fill" style="width: {{ $skill->proficiency }}%;"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 4: EDUCATION
     ========================================================================== -->
<section id="education" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-mortarboard"></i> Academic Background</span>
            <h2 class="section-title">Riwayat <span class="text-gradient">Pendidikan</span></h2>
            <p class="section-desc">
                Perjalanan akademis dan pendidikan formal dalam bidang Teknologi Informasi dan Komputer.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="timeline">
                    @forelse($educations as $edu)
                        <div class="timeline-item reveal">
                            <div class="timeline-dot"></div>
                            <div class="timeline-card">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                                    <h3 class="h5 fw-bold mb-0 font-heading" style="color: var(--text-primary);">{{ $edu->institution }}</h3>
                                    <span class="timeline-badge">
                                        <i class="bi bi-calendar3 me-1"></i> {{ $edu->start_year }} — {{ $edu->end_year ?? 'Sekarang' }}
                                    </span>
                                </div>

                                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                    <span class="fw-semibold text-primary">{{ $edu->degree }}</span>
                                    @if($edu->field_of_study)
                                        <span class="text-muted">• {{ $edu->field_of_study }}</span>
                                    @endif
                                    @if($edu->gpa)
                                        <span class="badge badge-subtle-success ms-auto">
                                            <i class="bi bi-star-fill me-1"></i> IPK: {{ $edu->gpa }}
                                        </span>
                                    @endif
                                </div>

                                @if($edu->description)
                                    <p class="small text-subtle mb-0" style="line-height: 1.7;">
                                        {{ $edu->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-subtle">Data pendidikan belum tersedia.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 5: EXPERIENCE
     ========================================================================== -->
<section id="experience" class="py-5 my-md-4 section-subtle-bg">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-briefcase"></i> Career &amp; Milestones</span>
            <h2 class="section-title">Pengalaman <span class="text-gradient">Proyek &amp; Kerja</span></h2>
            <p class="section-desc">
                Pengalaman nyata dalam pengembangan perangkat lunak, administrasi jaringan kampus, dan riset perangkat cerdas.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="timeline">
                    @forelse($experiences as $exp)
                        <div class="timeline-item reveal">
                            <div class="timeline-dot"></div>
                            <div class="timeline-card">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                                    <h3 class="h5 fw-bold mb-0 font-heading" style="color: var(--text-primary);">{{ $exp->role }}</h3>
                                    <span class="timeline-badge">
                                        <i class="bi bi-clock-history me-1"></i> {{ $exp->start_date }} — {{ $exp->end_date ?? 'Sekarang' }}
                                    </span>
                                </div>

                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="fw-semibold text-primary">{{ $exp->company }}</span>
                                    <span class="badge badge-subtle-info" style="font-size: 0.72rem;">{{ $exp->type }}</span>
                                </div>

                                @if($exp->description)
                                    <p class="small text-subtle mb-3" style="line-height: 1.7;">
                                        {{ $exp->description }}
                                    </p>
                                @endif

                                @if($exp->skills_used)
                                    <div class="pt-2 border-top border-subtle">
                                        <small class="text-muted d-block mb-2" style="font-size: 0.75rem;">Teknologi &amp; Kompetensi Terkait:</small>
                                        @foreach(explode(',', $exp->skills_used) as $item)
                                            <span class="tech-tag">{{ trim($item) }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-subtle">Data pengalaman belum tersedia.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 6: PROJECTS / PORTFOLIO
     ========================================================================== -->
<section id="projects" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-kanban"></i> Featured Works</span>
            <h2 class="section-title">Portofolio <span class="text-gradient">Project Unggulan</span></h2>
            <p class="section-desc">
                Eksplorasi proyek-proyek yang telah saya rancang dan bangun, mulai dari sistem informasi berbasis web, integrasi mikrokontroler IoT, hingga konfigurasi jaringan &amp; server.
            </p>
        </div>

        <div class="row g-4">
            @forelse($projects as $p)
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="project-card">
                        <div class="project-thumb">
                            <span class="project-badge-top">{{ $p->category }}</span>
                            <img src="{{ $p->image ?? '/images/project-payroll.svg' }}" alt="{{ $p->title }}" loading="lazy">
                        </div>

                        <div class="project-body">
                            <h3 class="h5 fw-bold mb-2 font-heading" style="color: var(--text-primary);">{{ $p->title }}</h3>
                            <p class="small text-subtle mb-3 flex-grow-1" style="line-height: 1.6;">
                                {{ $p->summary }}
                            </p>

                            <!-- Tech tags -->
                            <div class="mb-3">
                                @if(is_array($p->technologies))
                                    @foreach(array_slice($p->technologies, 0, 4) as $tech)
                                        <span class="tech-tag">{{ $tech }}</span>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Project Card Actions -->
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top border-subtle mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-custom" data-bs-toggle="modal" data-bs-target="#projectModal{{ $p->id }}">
                                    <i class="bi bi-info-circle me-1"></i> Detail Fitur
                                </button>

                                <div class="d-flex gap-2">
                                    @if($p->github_url)
                                        <a href="{{ $p->github_url }}" target="_blank" class="btn-icon-round" title="GitHub Source Code" style="width: 36px; height: 36px;">
                                            <i class="bi bi-github"></i>
                                        </a>
                                    @endif
                                    @if($p->demo_url)
                                        <a href="{{ $p->demo_url }}" target="_blank" class="btn-icon-round" title="Live Preview / Demo" style="width: 36px; height: 36px;">
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Detail Modal -->
                <div class="modal fade" id="projectModal{{ $p->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $p->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content glass-card border-subtle p-2">
                            <div class="modal-header border-subtle">
                                <div>
                                    <span class="badge badge-subtle-primary mb-1">{{ $p->category }}</span>
                                    <h4 class="modal-title fw-bold font-heading" style="color: var(--text-primary);" id="modalLabel{{ $p->id }}">{{ $p->title }}</h4>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if($p->image)
                                    <div class="rounded-3 overflow-hidden mb-4 border border-subtle">
                                        <img src="{{ $p->image }}" alt="{{ $p->title }}" class="img-fluid w-100" style="max-height: 340px; object-fit: cover;">
                                    </div>
                                @endif

                                <h5 class="h6 fw-bold mb-2" style="color: var(--text-primary);">Ikhtisar &amp; Solusi:</h5>
                                <div class="text-subtle mb-4" style="line-height: 1.8; white-space: pre-line;">
                                    {{ $p->description }}
                                </div>

                                <h5 class="h6 fw-bold mb-2" style="color: var(--text-primary);">Teknologi yang Digunakan:</h5>
                                <div class="mb-4">
                                    @if(is_array($p->technologies))
                                        @foreach($p->technologies as $tech)
                                            <span class="tech-tag">{{ $tech }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer border-subtle justify-content-between">
                                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Tutup</button>
                                <div class="d-flex gap-2">
                                    @if($p->github_url)
                                        <a href="{{ $p->github_url }}" target="_blank" class="btn btn-outline-custom">
                                            <i class="bi bi-github me-1"></i> Repositori GitHub
                                        </a>
                                    @endif
                                    @if($p->demo_url)
                                        <a href="{{ $p->demo_url }}" target="_blank" class="btn btn-primary-custom">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Kunjungi Proyek
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-subtle">Belum ada portofolio project yang ditampilkan.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 7: CERTIFICATES / ACHIEVEMENTS
     ========================================================================== -->
<section id="certificates" class="py-5 my-md-4 section-subtle-bg">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-award"></i> Verification &amp; Credentials</span>
            <h2 class="section-title">Sertifikat &amp; <span class="text-gradient">Prestasi</span></h2>
            <p class="section-desc">
                Bukti kompetensi resmi dan penghargaan yang diakui secara nasional maupun institusional.
            </p>
        </div>

        <div class="row g-4">
            @forelse($certificates as $cert)
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="cert-card">
                        @if($cert->image)
                            <div class="rounded-3 overflow-hidden mb-3 border border-subtle">
                                <img src="{{ $cert->image }}" alt="{{ $cert->title }}" class="img-fluid w-100" style="height: 160px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge badge-subtle-primary" style="font-size: 0.75rem;">
                                {{ $cert->issuer }}
                            </span>
                            <span class="small text-muted font-mono">{{ $cert->issue_date }}</span>
                        </div>

                        <h3 class="h6 fw-bold mb-2" style="color: var(--text-primary);">{{ $cert->title }}</h3>

                        @if($cert->description)
                            <p class="small text-subtle mb-3" style="line-height: 1.6;">
                                {{ $cert->description }}
                            </p>
                        @endif

                        <div class="d-flex align-items-center justify-content-between pt-2 border-top border-subtle mt-auto">
                            @if($cert->credential_id)
                                <small class="text-muted font-mono" style="font-size: 0.72rem;">ID: {{ $cert->credential_id }}</small>
                            @else
                                <span></span>
                            @endif

                            @if($cert->credential_url)
                                <a href="{{ $cert->credential_url }}" target="_blank" class="small text-primary fw-semibold text-decoration-none">
                                    Verifikasi <i class="bi bi-box-arrow-up-right ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-subtle">Data sertifikat belum tersedia.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 8: CONTACT
     ========================================================================== -->
<section id="contact" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-envelope-check"></i> Get In Touch</span>
            <h2 class="section-title">Mari Terhubung &amp; <span class="text-gradient">Bekerja Sama</span></h2>
            <p class="section-desc">
                Tertarik mendiskusikan peluang proyek, analisis sistem, konfigurasi jaringan, atau sekadar bertukar ide? Kirimkan pesan Anda melalui formulir di bawah ini.
            </p>
        </div>

        <div class="row g-4 align-items-stretch">
            <!-- Contact Info Cards Left -->
            <div class="col-lg-5 reveal">
                <div class="d-flex flex-column gap-3 h-100">
                    <div class="contact-info-card">
                        <div class="p-3 rounded-circle bg-primary bg-opacity-10 text-primary fs-4">
                            <i class="bi bi-envelope-at-fill"></i>
                        </div>
                        <div>
                            <span class="small text-muted d-block">Kirim Email Langsung:</span>
                            <a href="mailto:{{ $profile->email ?? 'andika.amansyah@gmail.com' }}" class="fw-bold text-decoration-none" style="color: var(--text-primary);">
                                {{ $profile->email ?? 'andika.amansyah@gmail.com' }}
                            </a>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="p-3 rounded-circle bg-success bg-opacity-10 text-success fs-4">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div>
                            <span class="small text-muted d-block">WhatsApp / Telepon:</span>
                            <a href="https://wa.me/6281234567890?text=Halo%20Andika,%20saya%20melihat%20portofolio%20Anda" target="_blank" class="fw-bold text-decoration-none" style="color: var(--text-primary);">
                                {{ $profile->phone ?? '+62 812-3456-7890' }}
                            </a>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="p-3 rounded-circle bg-info bg-opacity-10 text-info fs-4">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <span class="small text-muted d-block">Lokasi Kampus &amp; Domisili:</span>
                            <span class="fw-bold" style="color: var(--text-primary);">UBSI — Bekasi / Jakarta, Indonesia</span>
                        </div>
                    </div>

                    <!-- Social Network Strip -->
                    <div class="glass-card p-4 mt-auto">
                        <h4 class="h6 fw-bold mb-3" style="color: var(--text-primary);">Ikuti Jejaring Profesional Saya:</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($socialLinks as $soc)
                                <a href="{{ $soc->url }}" target="_blank" class="btn btn-sm btn-outline-custom">
                                    <i class="bi {{ $soc->icon }} me-1"></i> {{ $soc->platform }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form Right -->
            <div class="col-lg-7 reveal">
                <div class="glass-card p-4 p-md-5 h-100">
                    <h3 class="h4 fw-bold mb-2 font-heading" style="color: var(--text-primary);">Kirimkan Pesan</h3>
                    <p class="small text-subtle mb-4">Saya akan membalas pesan Anda sesegera mungkin.</p>

                    <div id="contactAlertContainer">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('portfolio.contact') }}" method="POST" id="contactForm">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label small fw-semibold">Nama Lengkap Anda *</label>
                                <input type="text" name="name" id="name" class="form-control form-control-custom @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label small fw-semibold">Alamat Email *</label>
                                <input type="email" name="email" id="email" class="form-control form-control-custom @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="budi@example.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label small fw-semibold">Nomor Telepon / WhatsApp <span class="text-subtle fw-normal">(Opsional)</span></label>
                                <input type="tel" name="phone" id="phone" class="form-control form-control-custom @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Contoh: 081234567890">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label small fw-semibold">Subjek Pesan *</label>
                                <input type="text" name="subject" id="subject" class="form-control form-control-custom @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Contoh: Diskusi Tawaran Proyek Web System" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label small fw-semibold">Isi Pesan / Keterangan Kebutuhan *</label>
                            <textarea name="message" id="message" rows="5" class="form-control form-control-custom @error('message') is-invalid @enderror" placeholder="Tuliskan detail pertanyaan atau deskripsi proyek yang ingin didiskusikan..." required>{{ old('message') }}</textarea>
                            @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 py-3" id="contactSubmitBtn">
                            <i class="bi bi-send-fill me-2"></i> Kirim Pesan Sekarang
                        </button>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.getElementById('contactForm');
                            const submitBtn = document.getElementById('contactSubmitBtn');
                            const alertBox = document.getElementById('contactAlertContainer');

                            if (form && submitBtn && alertBox) {
                                form.addEventListener('submit', async function(e) {
                                    e.preventDefault();
                                    const originalBtnText = submitBtn.innerHTML;
                                    submitBtn.disabled = true;
                                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengirim pesan...';
                                    alertBox.innerHTML = '';

                                    try {
                                        const formData = new FormData(form);
                                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                                        const actionUrl = form.getAttribute('action') || '/contact';
                                        const response = await fetch(actionUrl, {
                                            method: 'POST',
                                            headers: {
                                                'Accept': 'application/json',
                                                'X-Requested-With': 'XMLHttpRequest',
                                                'X-CSRF-TOKEN': csrfToken
                                            },
                                            body: formData
                                        });

                                        const result = await response.json().catch(() => null);

                                        if (response.ok && result && result.success) {
                                            // Play soft success chime
                                            try {
                                                const AudioContext = window.AudioContext || window.webkitAudioContext;
                                                if (AudioContext) {
                                                    const ctx = new AudioContext();
                                                    const osc = ctx.createOscillator();
                                                    const gain = ctx.createGain();
                                                    osc.type = 'sine';
                                                    osc.frequency.setValueAtTime(659.25, ctx.currentTime);
                                                    osc.frequency.setValueAtTime(880, ctx.currentTime + 0.12);
                                                    gain.gain.setValueAtTime(0.2, ctx.currentTime);
                                                    gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.4);
                                                    osc.connect(gain);
                                                    gain.connect(ctx.destination);
                                                    osc.start(ctx.currentTime);
                                                    osc.stop(ctx.currentTime + 0.4);
                                                }
                                            } catch(e) {}

                                            const nameVal = formData.get('name') || '';
                                            const subjectVal = formData.get('subject') || '';
                                            const msgVal = formData.get('message') || '';
                                            const phoneVal = '{{ preg_replace("/[^0-9]/", "", $profile->phone ?? "6281234567890") }}';
                                            const waText = encodeURIComponent(`Halo Mas Andika, saya ${nameVal}.\n\nSubjek: ${subjectVal}\n\nPesan:\n${msgVal}`);
                                            const waUrl = `https://wa.me/${phoneVal}?text=${waText}`;

                                            alertBox.innerHTML = `
                                                <div class="alert alert-success alert-dismissible fade show p-3 p-md-4 mb-4 border border-success shadow-lg" role="alert" style="background: rgba(16, 185, 129, 0.12); backdrop-filter: blur(8px);">
                                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                                                            <strong class="fs-6" style="color: var(--text-primary);">${result.message || 'Pesan Anda berhasil dikirim secara realtime!'}</strong>
                                                        </div>
                                                        <span class="badge badge-subtle-success py-1 px-2 d-inline-flex align-items-center gap-1">
                                                            <span class="live-pulse-dot" style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; display: inline-block;"></span>
                                                            Terkoneksi Real-Time
                                                        </span>
                                                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                    <p class="small text-subtle mb-3">Pesan Anda telah langsung masuk ke inbox admin Andika Amansyah. Anda juga dapat meneruskan salinannya ke WhatsApp untuk komunikasi lebih cepat:</p>
                                                    <a href="${waUrl}" target="_blank" class="btn btn-sm btn-success text-white d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2 shadow-sm">
                                                        <i class="bi bi-whatsapp fs-6"></i> Kirim Salinan ke WhatsApp
                                                    </a>
                                                </div>
                                            `;
                                            form.reset();
                                            alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                                        } else {
                                            let errorMsg = 'Gagal mengirim pesan. Silakan coba kembali.';
                                            if (result && result.errors) {
                                                errorMsg = Object.values(result.errors).flat().join('<br>');
                                            } else if (result && result.message) {
                                                errorMsg = result.message;
                                            }
                                            alertBox.innerHTML = `
                                                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                                                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                                                    <div>${errorMsg}</div>
                                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            `;
                                        }
                                    } catch (err) {
                                        form.submit();
                                        return;
                                    } finally {
                                        submitBtn.disabled = false;
                                        submitBtn.innerHTML = originalBtnText;
                                    }
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 9: DOWNLOAD CV PDF BANNER
     ========================================================================== -->
<section class="py-5 position-relative overflow-hidden cv-banner-section">
    <div class="container text-center reveal">
        <div class="glass-card p-4 p-md-5 d-inline-block shadow-lg border-subtle" style="max-width: 800px; width: 100%;">
            <div class="d-inline-flex p-3 rounded-circle bg-primary bg-opacity-10 text-primary mb-3">
                <i class="bi bi-file-earmark-person-fill fs-2"></i>
            </div>
            <h2 class="h3 fw-bold font-heading mb-2" style="color: var(--text-primary);">Ingin Mengunduh Curriculum Vitae (CV)?</h2>
            <p class="text-subtle small mb-4" style="max-width: 580px; margin: 0 auto;">
                Dapatkan salinan ringkas rekam jejak akademis, kemampuan teknis, pengalaman proyek, dan sertifikasi Andika Amansyah yang siap dicetak atau disimpan berformat PDF.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-primary-custom px-4 py-2" id="downloadCvBannerBtn">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Buka &amp; Simpan CV PDF
                </a>
                <a href="#contact" class="btn btn-outline-custom px-4 py-2">
                    <i class="bi bi-chat-text-fill"></i> Hubungi untuk Wawancara
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
