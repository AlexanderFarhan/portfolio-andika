@extends('layouts.app')

@section('title', 'Andika Amansyah | Software Engineer & System Analyst — Portfolio & Resume')

@section('content')

<!-- ==========================================================================
     SECTION 1: HERO / RECRUITER SPOTLIGHT
     ========================================================================== -->
<section id="hero" class="hero-section">
    <div class="hero-glow-bg" aria-hidden="true"></div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="reveal">
                    <!-- Recruiter Availability Pill -->
                    <div class="hero-availability-pill mb-3" role="status">
                        <span class="status-indicator"></span>
                        <span><strong>Terbuka untuk Peluang Kerja</strong> • Full-Time / Magang / Junior Developer &amp; Analyst</span>
                    </div>

                    <h1 class="display-4 fw-extrabold mb-2 font-heading tracking-tight">
                        Halo, Saya <span class="text-gradient">{{ $profile->name ?? 'Andika Amansyah' }}</span>
                    </h1>

                    <h2 class="h4 fw-bold text-primary mb-3 font-heading">
                        Junior Software Engineer &amp; System Analyst
                    </h2>

                    <p class="lead mb-4 text-subtle" style="max-width: 640px; line-height: 1.75;">
                        Mahasiswa S1 Teknologi Informasi UBSI (<strong style="color: var(--text-primary);">IPK 3.85 / 4.00</strong>). Mengintegrasikan kemampuan rekayasa web modern (<strong style="color: var(--text-primary);">Laravel 12, REST API, MySQL</strong>) dengan analisis kebutuhan sistem bisnis terstruktur (<strong style="color: var(--text-primary);">SRS, UML, ERD</strong>), serta administrasi server Linux &amp; infrastruktur jaringan <strong style="color: var(--text-primary);">MikroTik RouterOS</strong>.
                    </p>

                    <!-- Hero Call to Action Buttons (Recruiter-First) -->
                    <div class="d-flex flex-wrap gap-3 align-items-center mb-4">
                        <a href="#projects" class="btn btn-primary-custom" id="heroProjectsBtn">
                            <i class="bi bi-kanban-fill me-1"></i> Lihat Proyek Unggulan
                        </a>
                        <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-outline-custom" id="heroCvBtn" title="Unduh Curriculum Vitae Resmi">
                            <i class="bi bi-file-earmark-pdf-fill text-danger me-1"></i> Unduh CV Resmi (PDF)
                        </a>
                        <a href="#contact" class="btn btn-outline-custom" id="heroContactBtn">
                            <i class="bi bi-chat-quote-fill me-1"></i> Hubungi / Rekrut
                        </a>
                    </div>

                    <!-- Social / Professional Channels Strip -->
                    <div class="d-flex align-items-center gap-2 mb-4 pt-1">
                        <span class="small text-muted me-2 font-mono">Jejaring:</span>
                        @if(isset($socialLinks))
                            @foreach($socialLinks as $soc)
                                @php
                                    $profPhone = isset($profile->phone) ? preg_replace('/[^0-9]/', '', $profile->phone) : '';
                                    if (str_starts_with($profPhone, '0')) $profPhone = '62' . substr($profPhone, 1);
                                    elseif (str_starts_with($profPhone, '8')) $profPhone = '62' . $profPhone;

                                    $socUrl = $soc->url;
                                    if (strtolower($soc->platform) === 'whatsapp' && !empty($profPhone)) {
                                        $socUrl = 'https://api.whatsapp.com/send?phone=' . $profPhone . '&text=' . urlencode('Halo Andika, saya melihat portofolio Anda dan ingin mendiskusikan peluang kerja/proyek.');
                                    } elseif (strtolower($soc->platform) === 'email' && !empty($profile->email)) {
                                        $socUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($profile->email) . '&su=' . urlencode('Peluang Karir / Diskusi Tawaran Proyek');
                                    }
                                @endphp
                                <a href="{{ $socUrl }}" target="_blank" rel="noopener noreferrer" class="btn-icon-round" aria-label="{{ $soc->platform }}" title="{{ $soc->platform }}" style="width: 38px; height: 38px;">
                                    <i class="bi {{ $soc->icon }}"></i>
                                </a>
                            @endforeach
                        @endif
                    </div>

                    <!-- Recruiter Metric Stat Boxes -->
                    <div class="row g-3 pt-3 border-top border-subtle">
                        <div class="col-6 col-sm-3">
                            <div class="metric-card p-2 rounded-3 text-start">
                                <div class="fs-4 fw-bold font-heading text-primary">{{ $profile->gpa ?? '3.85 / 4.00' }}</div>
                                <div class="small text-muted" style="font-size: 0.78rem;">IPK S1 UBSI (Cum Laude)</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="metric-card p-2 rounded-3 text-start">
                                <div class="fs-4 fw-bold font-heading text-primary">{{ $profile->years_of_experience ?? '2+ Tahun' }}</div>
                                <div class="small text-muted" style="font-size: 0.78rem;">Pengalaman Proyek &amp; Lab</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="metric-card p-2 rounded-3 text-start">
                                <div class="fs-4 fw-bold font-heading text-primary">5+ Solusi</div>
                                <div class="small text-muted" style="font-size: 0.78rem;">Proyek Teruji &amp; Siap Pakai</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="metric-card p-2 rounded-3 text-start">
                                <div class="fs-4 fw-bold font-heading text-primary">2 Lisensi</div>
                                <div class="small text-muted" style="font-size: 0.78rem;">BNSP JWD &amp; MikroTik MTCNA</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Profile Card / Recruiter Glance -->
            <div class="col-lg-5">
                <div class="reveal">
                    <div class="developer-card glass-card p-4 mx-auto" style="max-width: 420px;">
                        <!-- Terminal-like Header Bar -->
                        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom border-subtle">
                            <div class="d-flex align-items-center gap-1">
                                <span class="window-dot dot-red"></span>
                                <span class="window-dot dot-yellow"></span>
                                <span class="window-dot dot-green"></span>
                            </div>
                            <span class="small font-mono text-muted" style="font-size: 0.75rem;">candidate-summary.json</span>
                            <span class="badge badge-subtle-success font-mono" style="font-size: 0.7rem;">READY_TO_HIRE</span>
                        </div>

                        <!-- Portrait & Core Identity -->
                        <div class="text-center mb-3">
                            <div class="profile-portrait-frame mx-auto mb-3">
                                <img src="{{ $profile->avatar ?? '/images/avatar-andika.svg' }}" alt="{{ $profile->name ?? 'Andika Amansyah' }}" class="img-fluid" width="160" height="160">
                            </div>
                            <h3 class="h5 fw-bold mb-1 font-heading" style="color: var(--text-primary);">{{ $profile->name ?? 'Andika Amansyah' }}</h3>
                            <p class="small text-subtle mb-2">Mahasiswa S1 Teknologi Informasi • UBSI</p>
                            <div class="d-flex justify-content-center gap-2">
                                <span class="badge badge-subtle-primary font-mono" style="font-size: 0.72rem;"><i class="bi bi-geo-alt-fill me-1"></i> Jakarta / Bekasi</span>
                                <span class="badge badge-subtle-info font-mono" style="font-size: 0.72rem;"><i class="bi bi-laptop me-1"></i> On-site / Remote</span>
                            </div>
                        </div>

                        <!-- Core Technology Stack Badges -->
                        <div class="p-3 rounded-3 bg-secondary bg-opacity-25 border border-subtle mb-3">
                            <div class="small text-muted font-mono mb-2" style="font-size: 0.72rem;">CORE_TECHNICAL_STACK:</div>
                            <div class="d-flex flex-wrap gap-1">
                                <span class="tech-tag">Laravel 12</span>
                                <span class="tech-tag">PHP 8.2+</span>
                                <span class="tech-tag">MySQL</span>
                                <span class="tech-tag">RESTful API</span>
                                <span class="tech-tag">MikroTik RouterOS</span>
                                <span class="tech-tag">Ubuntu Linux CLI</span>
                                <span class="tech-tag">System Analysis (SRS/UML)</span>
                                <span class="tech-tag">ESP32 IoT</span>
                            </div>
                        </div>

                        <!-- Quick Recruiter Action inside Card -->
                        <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-sm btn-outline-custom w-100 justify-content-center">
                            <i class="bi bi-eye-fill me-1"></i> Buka CV Lengkap di Tab Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 2: ABOUT ME & ENGINEERING VALUE
     ========================================================================== -->
<section id="about" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-person-workspace"></i> Profil &amp; Filosofi Rekayasa</span>
            <h2 class="section-title">
                Tentang <span class="text-gradient">{{ $profile->name ?? 'Andika Amansyah' }}</span>
            </h2>
            <p class="section-desc">
                Kombinasi analisis kebutuhan bisnis terstruktur (SRS &amp; UML), implementasi kode bersih (Clean Architecture), serta keahlian mendalam dalam infrastruktur jaringan komputer dan administrasi server.
            </p>
        </div>

        <div class="row g-4 align-items-stretch mb-5">
            <!-- Left: Personal Statement & Candidate Snapshot -->
            <div class="col-lg-6">
                <div class="glass-card p-4 p-md-5 reveal h-100 d-flex flex-column">
                    <h3 class="h4 fw-bold mb-3 font-heading" style="color: var(--text-primary);">
                        {{ $profile->headline ?? 'Software Engineer & System Analyst Berorientasi Solusi' }}
                    </h3>
                    <div class="text-subtle mb-4 flex-grow-1" style="line-height: 1.8; white-space: pre-line;">
                        {{ $profile->about_me ?? "Halo! Saya Andika Amansyah, mahasiswa aktif jurusan Teknologi Informasi di Universitas Bina Sarana Informatika (UBSI) dengan IPK 3.85/4.00. Saya memiliki minat mendalam pada sinergi antara rekayasa perangkat lunak (Software Engineering) dan infrastruktur jaringan (Computer Networking).\n\nSaya percaya bahwa aplikasi bisnis yang berhasil dibangun di atas fondasi analisis kebutuhan yang tajam, arsitektur database relasional yang dinormalisasi dengan baik, kode yang terstruktur (MVC), serta deployment server yang aman dan terpantau." }}
                    </div>

                    <!-- Candidate Quick Facts for HR / Recruiters -->
                    <div class="p-3 rounded-3 bg-secondary bg-opacity-10 border border-subtle">
                        <h4 class="small fw-bold text-uppercase text-primary mb-3 font-mono" style="letter-spacing: 0.05em;">
                            <i class="bi bi-card-checklist me-1"></i> Ringkasan Kualifikasi Kandidat:
                        </h4>
                        <div class="row g-2 small">
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.78rem;">Pendidikan:</span>
                                <strong style="color: var(--text-primary);">S1 Teknologi Informasi (UBSI)</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.78rem;">Indeks Prestasi Kumulatif:</span>
                                <strong class="text-primary font-mono">3.85 / 4.00 (Cum Laude Candidate)</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.78rem;">Ketersediaan Mulai:</span>
                                <strong class="text-success">Segera / Immediate Availability</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.78rem;">Target Peran:</span>
                                <strong style="color: var(--text-primary);">Junior Web Developer / System Analyst / IT Support</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.78rem;">Preferensi Kerja:</span>
                                <strong style="color: var(--text-primary);">On-site (Jabodetabek) / Hybrid / Remote</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.78rem;">Sertifikasi Utama:</span>
                                <strong style="color: var(--text-primary);">BNSP JWD &amp; MikroTik MTCNA</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: 4 Engineering Pillars (Why Hire Me) -->
            <div class="col-lg-6">
                <div class="row g-3 h-100">
                    @php
                        $pillars = $profile ? $profile->getActivePillars() : [];
                        if (empty($pillars)) {
                            $pillars = [
                                [
                                    'title' => 'Analisis Sistem & Rekayasa Kebutuhan',
                                    'description' => 'Mampu membedah alur proses bisnis klien, menyusun Software Requirement Specification (SRS), merancang diagram UML (Use Case, Activity, Sequence), serta normalisasi database (ERD 3NF).',
                                    'icon' => 'bi-diagram-3-fill'
                                ],
                                [
                                    'title' => 'Pengembangan Web Full-Stack Modern',
                                    'description' => 'Membangun aplikasi web handal menggunakan framework Laravel 12 & PHP 8.2+, RESTful API terstandar, MySQL relasional, antarmuka responsif Bootstrap 5, dan proteksi OWASP (CSRF/XSS).',
                                    'icon' => 'bi-boxes'
                                ],
                                [
                                    'title' => 'Infrastruktur Jaringan & Server Linux',
                                    'description' => 'Berpengalaman mengonfigurasi router MikroTik RouterOS (VLAN, bandwidth management QoS, firewall NAT) dan administrasi server Linux Ubuntu CLI (LEMP stack & otomatisasi script).',
                                    'icon' => 'bi-hdd-network-fill'
                                ],
                                [
                                    'title' => 'Hardware & IoT Real-Time Telemetry',
                                    'description' => 'Mendesain prototipe Internet of Things berbasis ESP32 dan RFID RC522 dengan verifikasi latensi di bawah 300ms yang terintegrasi langsung ke cloud database via REST API.',
                                    'icon' => 'bi-cpu-fill'
                                ],
                            ];
                        }
                    @endphp
                    @foreach($pillars as $p)
                        <div class="col-sm-6 reveal">
                            <div class="glass-card p-4 h-100 d-flex flex-column">
                                <div class="skill-icon-box">
                                    <i class="bi {{ $p['icon'] ?? 'bi-check-circle-fill' }}"></i>
                                </div>
                                <h4 class="h6 fw-bold mb-2 font-heading" style="color: var(--text-primary);">{{ $p['title'] ?? '' }}</h4>
                                <p class="small text-subtle mb-0 flex-grow-1" style="line-height: 1.65;">
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
     SECTION 3: TECHNICAL COMPETENCIES (SKILLS MATRIX)
     ========================================================================== -->
<section id="skills" class="py-5 my-md-4 section-subtle-bg">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-stack"></i> Matriks Kompetensi Teknis</span>
            <h2 class="section-title">Keahlian &amp; <span class="text-gradient">Stack Teknologi</span></h2>
            <p class="section-desc">
                Keahlian praktis yang siap diaplikasikan langsung pada proyek tim, dikelompokkan berdasarkan domain teknis dan level kompetensi.
            </p>
        </div>

        <!-- Skills Filter Tabs -->
        <ul class="nav nav-pills justify-content-center gap-2 mb-4 reveal flex-wrap" id="skillsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4 rounded-pill" id="all-skills-tab" data-bs-toggle="pill" data-bs-target="#all-skills" type="button" role="tab" aria-selected="true">
                    Semua Keahlian ({{ $skills->count() }})
                </button>
            </li>
            @foreach($skillsByCategory as $category => $items)
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 rounded-pill" id="cat-{{ Str::slug($category) }}-tab" data-bs-toggle="pill" data-bs-target="#cat-{{ Str::slug($category) }}" type="button" role="tab" aria-selected="false">
                        {{ $category }} ({{ count($items) }})
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- Skills Content -->
        <div class="tab-content" id="skillsTabsContent">
            <!-- Tab: All Skills -->
            <div class="tab-pane fade show active" id="all-skills" role="tabpanel" aria-labelledby="all-skills-tab">
                <div class="row g-3">
                    @foreach($skills as $skill)
                        @php
                            $levelLabel = 'Production Ready';
                            $badgeClass = 'badge-subtle-success';
                            if ($skill->proficiency < 85) {
                                $levelLabel = 'Familiar / Proficient';
                                $badgeClass = 'badge-subtle-info';
                            } elseif ($skill->proficiency >= 90) {
                                $levelLabel = 'Advanced / Production';
                                $badgeClass = 'badge-subtle-primary';
                            }
                        @endphp
                        <div class="col-md-6 col-lg-4 reveal">
                            <div class="skill-card d-flex flex-column justify-content-between">
                                <div>
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
                                    </div>
                                </div>
                                <div class="pt-2 mt-2 border-top border-subtle d-flex align-items-center justify-content-between">
                                    <span class="badge {{ $badgeClass }}" style="font-size: 0.72rem;">{{ $levelLabel }}</span>
                                    <span class="small font-mono text-muted">{{ $skill->proficiency }}% Mastery</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab per Category -->
            @foreach($skillsByCategory as $category => $items)
                <div class="tab-pane fade" id="cat-{{ Str::slug($category) }}" role="tabpanel" aria-labelledby="cat-{{ Str::slug($category) }}-tab">
                    <div class="row g-3">
                        @foreach($items as $skill)
                            @php
                                $levelLabel = 'Production Ready';
                                $badgeClass = 'badge-subtle-success';
                                if ($skill->proficiency < 85) {
                                    $levelLabel = 'Familiar / Proficient';
                                    $badgeClass = 'badge-subtle-info';
                                } elseif ($skill->proficiency >= 90) {
                                    $levelLabel = 'Advanced / Production';
                                    $badgeClass = 'badge-subtle-primary';
                                }
                            @endphp
                            <div class="col-md-6 col-lg-4 reveal">
                                <div class="skill-card d-flex flex-column justify-content-between">
                                    <div>
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
                                        </div>
                                    </div>
                                    <div class="pt-2 mt-2 border-top border-subtle d-flex align-items-center justify-content-between">
                                        <span class="badge {{ $badgeClass }}" style="font-size: 0.72rem;">{{ $levelLabel }}</span>
                                        <span class="small font-mono text-muted">{{ $skill->proficiency }}% Mastery</span>
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
     SECTION 4: FEATURED PROJECTS / CASE STUDIES
     ========================================================================== -->
<section id="projects" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-kanban-fill"></i> Studi Kasus &amp; Portofolio Proyek</span>
            <h2 class="section-title">Portofolio <span class="text-gradient">Proyek Unggulan</span></h2>
            <p class="section-desc">
                Eksplorasi proyek-proyek riil yang telah dibangun dari nol, mencakup sistem web finansial perusahaan, integrasi IoT mikrokontroler dengan cloud REST API, dan topologi jaringan enterprise.
            </p>
        </div>

        <div class="row g-4">
            @forelse($projects as $p)
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="project-card d-flex flex-column">
                        <div class="project-thumb">
                            <span class="project-badge-top">{{ $p->category }}</span>
                            <img src="{{ $p->image ?? '/images/project-payroll.svg' }}" alt="{{ $p->title }}" loading="lazy">
                        </div>

                        <div class="project-body d-flex flex-column flex-grow-1">
                            <h3 class="h5 fw-bold mb-2 font-heading" style="color: var(--text-primary);">{{ $p->title }}</h3>
                            <p class="small text-subtle mb-3 flex-grow-1" style="line-height: 1.65;">
                                {{ $p->summary }}
                            </p>

                            <!-- Tech Stack Pills -->
                            <div class="mb-3">
                                @if(is_array($p->technologies))
                                    @foreach(array_slice($p->technologies, 0, 4) as $tech)
                                        <span class="tech-tag">{{ $tech }}</span>
                                    @endforeach
                                    @if(count($p->technologies) > 4)
                                        <span class="tech-tag text-primary">+{{ count($p->technologies) - 4 }}</span>
                                    @endif
                                @endif
                            </div>

                            <!-- Project Card Actions -->
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top border-subtle mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-custom" data-bs-toggle="modal" data-bs-target="#projectModal{{ $p->id }}">
                                    <i class="bi bi-file-earmark-code me-1"></i> Detail Arsitektur
                                </button>

                                <div class="d-flex gap-2">
                                    @if($p->github_url)
                                        <a href="{{ $p->github_url }}" target="_blank" rel="noopener noreferrer" class="btn-icon-round" title="Lihat Repositori GitHub" style="width: 36px; height: 36px;">
                                            <i class="bi bi-github"></i>
                                        </a>
                                    @endif
                                    @if($p->demo_url)
                                        <a href="{{ $p->demo_url }}" target="_blank" rel="noopener noreferrer" class="btn-icon-round" title="Kunjungi Live Demo" style="width: 36px; height: 36px;">
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Detail Modal (Rich Case Study) -->
                <div class="modal fade" id="projectModal{{ $p->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $p->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content glass-card border-subtle p-3">
                            <div class="modal-header border-subtle pb-3">
                                <div>
                                    <span class="badge badge-subtle-primary mb-1 font-mono">{{ $p->category }}</span>
                                    <h4 class="modal-title fw-bold font-heading" style="color: var(--text-primary);" id="modalLabel{{ $p->id }}">{{ $p->title }}</h4>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup dialog"></button>
                            </div>
                            <div class="modal-body py-4">
                                @if($p->image)
                                    <div class="rounded-3 overflow-hidden mb-4 border border-subtle shadow-sm">
                                        <img src="{{ $p->image }}" alt="{{ $p->title }}" class="img-fluid w-100" style="max-height: 320px; object-fit: cover;">
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <h5 class="h6 fw-bold text-primary mb-2 font-heading"><i class="bi bi-info-circle me-1"></i> Ikhtisar &amp; Solusi Masalah:</h5>
                                    <div class="text-subtle" style="line-height: 1.8; white-space: pre-line;">
                                        {{ $p->description }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h5 class="h6 fw-bold text-primary mb-2 font-heading"><i class="bi bi-layers me-1"></i> Arsitektur &amp; Teknologi yang Digunakan:</h5>
                                    <div class="d-flex flex-wrap gap-1">
                                        @if(is_array($p->technologies))
                                            @foreach($p->technologies as $tech)
                                                <span class="tech-tag py-1 px-2">{{ $tech }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-subtle justify-content-between pt-3">
                                <button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Tutup</button>
                                <div class="d-flex gap-2">
                                    @if($p->github_url)
                                        <a href="{{ $p->github_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-custom">
                                            <i class="bi bi-github me-1"></i> Repositori GitHub
                                        </a>
                                    @endif
                                    @if($p->demo_url)
                                        <a href="{{ $p->demo_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary-custom">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Live Demo
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
     SECTION 5: EXPERIENCE / CAREER MILESTONES
     ========================================================================== -->
<section id="experience" class="py-5 my-md-4 section-subtle-bg">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-briefcase-fill"></i> Riwayat Profesional</span>
            <h2 class="section-title">Pengalaman <span class="text-gradient">Kerja, Proyek &amp; Lab</span></h2>
            <p class="section-desc">
                Pengalaman nyata dalam pengembangan perangkat lunak, administrasi jaringan komputer kampus, dan riset mikrokontroler.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="timeline">
                    @forelse($experiences as $exp)
                        <div class="timeline-item reveal">
                            <div class="timeline-dot"></div>
                            <div class="timeline-card">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                                    <div>
                                        <h3 class="h5 fw-bold mb-1 font-heading" style="color: var(--text-primary);">{{ $exp->role }}</h3>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-semibold text-primary">{{ $exp->company }}</span>
                                            <span class="badge badge-subtle-info font-mono" style="font-size: 0.72rem;">{{ $exp->type }}</span>
                                        </div>
                                    </div>
                                    <span class="timeline-badge">
                                        <i class="bi bi-clock-history me-1"></i> {{ $exp->start_date }} — {{ $exp->end_date ?? 'Sekarang' }}
                                    </span>
                                </div>

                                @if($exp->description)
                                    <p class="small text-subtle mb-3 mt-2" style="line-height: 1.75; white-space: pre-line;">
                                        {{ $exp->description }}
                                    </p>
                                @endif

                                @if($exp->skills_used)
                                    <div class="pt-2 border-top border-subtle">
                                        <small class="text-muted d-block mb-2 font-mono" style="font-size: 0.75rem;">TEKNOLOGI &amp; TOOLS DIGUNAKAN:</small>
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
     SECTION 6: EDUCATION / ACADEMIC BACKGROUND
     ========================================================================== -->
<section id="education" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-mortarboard-fill"></i> Latar Belakang Akademis</span>
            <h2 class="section-title">Riwayat <span class="text-gradient">Pendidikan</span></h2>
            <p class="section-desc">
                Pendidikan formal di bidang Teknologi Informasi dan Komputer yang membangun fondasi logika algoritma, basis data, dan rekayasa perangkat lunak.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="timeline">
                    @forelse($educations as $edu)
                        <div class="timeline-item reveal">
                            <div class="timeline-dot"></div>
                            <div class="timeline-card">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                                    <div>
                                        <h3 class="h5 fw-bold mb-1 font-heading" style="color: var(--text-primary);">{{ $edu->institution }}</h3>
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <span class="fw-semibold text-primary">{{ $edu->degree }}</span>
                                            @if($edu->field_of_study)
                                                <span class="text-muted">• {{ $edu->field_of_study }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($edu->gpa)
                                            <span class="badge badge-subtle-success font-mono">
                                                <i class="bi bi-star-fill me-1"></i> IPK: {{ $edu->gpa }}
                                            </span>
                                        @endif
                                        <span class="timeline-badge">
                                            <i class="bi bi-calendar3 me-1"></i> {{ $edu->start_year }} — {{ $edu->end_year ?? 'Sekarang' }}
                                        </span>
                                    </div>
                                </div>

                                @if($edu->description)
                                    <p class="small text-subtle mb-0 mt-2" style="line-height: 1.75;">
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
     SECTION 7: CERTIFICATES & CREDENTIALS
     ========================================================================== -->
<section id="certificates" class="py-5 my-md-4 section-subtle-bg">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-patch-check-fill"></i> Kredensial &amp; Lisensi Profesi</span>
            <h2 class="section-title">Sertifikat &amp; <span class="text-gradient">Prestasi Resmi</span></h2>
            <p class="section-desc">
                Bukti kompetensi berstandar nasional dan industri dari Badan Nasional Sertifikasi Profesi (BNSP), MikroTik Academy, dan institusi terakreditasi.
            </p>
        </div>

        <div class="row g-4">
            @forelse($certificates as $cert)
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="cert-card d-flex flex-column h-100">
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

                        <h3 class="h6 fw-bold mb-2 font-heading" style="color: var(--text-primary);">{{ $cert->title }}</h3>

                        @if($cert->description)
                            <p class="small text-subtle mb-3 flex-grow-1" style="line-height: 1.65;">
                                {{ $cert->description }}
                            </p>
                        @endif

                        <div class="d-flex align-items-center justify-content-between pt-2 border-top border-subtle mt-auto">
                            @if($cert->credential_id)
                                <small class="text-muted font-mono" style="font-size: 0.72rem;">ID: {{ $cert->credential_id }}</small>
                            @else
                                <span class="small text-success"><i class="bi bi-shield-check me-1"></i> Terverifikasi</span>
                            @endif

                            @if($cert->credential_url)
                                <a href="{{ $cert->credential_url }}" target="_blank" rel="noopener noreferrer" class="small text-primary fw-semibold text-decoration-none">
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
     SECTION 8: HIRE ME & CONTACT
     ========================================================================== -->
<section id="contact" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-envelope-check-fill"></i> Rekrut / Hubungi Saya</span>
            <h2 class="section-title">Mari Terhubung &amp; <span class="text-gradient">Bekerja Sama</span></h2>
            <p class="section-desc">
                Tertarik mendiskusikan peluang karir Full-Time, program magang, proyek rekayasa sistem, atau konfigurasi jaringan? Hubungi saya langsung melalui kontak berikut.
            </p>
        </div>

@php
    $rawProfPhone = preg_replace('/[^0-9]/', '', $profile->phone ?? '');
    if (str_starts_with($rawProfPhone, '0')) {
        $cleanProfPhone = '62' . substr($rawProfPhone, 1);
    } elseif (str_starts_with($rawProfPhone, '8')) {
        $cleanProfPhone = '62' . $rawProfPhone;
    } else {
        $cleanProfPhone = $rawProfPhone ?: '6288225825512';
    }

    $cleanProfEmail = $profile->email ?? 'andikaamansyah427@gmail.com';
    $gmailProfUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($cleanProfEmail) . '&su=' . urlencode('Peluang Kerja / Diskusi Tawaran Proyek IT');
    $waProfUrl = 'https://api.whatsapp.com/send?phone=' . $cleanProfPhone . '&text=' . urlencode('Halo Andika, saya melihat portofolio Anda dan tertarik mendiskusikan peluang karir/proyek IT.');
@endphp

        <div class="row g-4 align-items-stretch">
            <!-- Left: Direct Channels & Fast Recruiter Connect -->
            <div class="col-lg-5 reveal">
                <div class="d-flex flex-column gap-3 h-100">
                    <!-- Status Banner -->
                    <div class="p-4 rounded-4 glass-card border-subtle">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="status-indicator"></span>
                            <span class="fw-bold text-success">Status: Siap Bekerja Segera</span>
                        </div>
                        <p class="small text-subtle mb-0" style="line-height: 1.6;">
                            Saya sangat antusias untuk bergabung dan berkontribusi secara nyata dalam tim rekayasa perangkat lunak maupun tim infrastruktur IT di perusahaan Anda.
                        </p>
                    </div>

                    <!-- Email Card -->
                    <div class="contact-info-card">
                        <div class="p-3 rounded-circle bg-primary bg-opacity-10 text-primary fs-4">
                            <i class="bi bi-envelope-at-fill"></i>
                        </div>
                        <div>
                            <span class="small text-muted d-block">Kirim Email Langsung:</span>
                            <a href="{{ $gmailProfUrl }}" target="_blank" rel="noopener noreferrer" class="fw-bold text-decoration-none hover-primary text-break" style="color: var(--text-primary);" title="Buka Gmail (Penerima: {{ $cleanProfEmail }})">
                                {{ $cleanProfEmail }}
                            </a>
                        </div>
                    </div>

                    <!-- WhatsApp Card -->
                    <div class="contact-info-card">
                        <div class="p-3 rounded-circle bg-success bg-opacity-10 text-success fs-4">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div>
                            <span class="small text-muted d-block">WhatsApp Langsung:</span>
                            <a href="{{ $waProfUrl }}" target="_blank" rel="noopener noreferrer" class="fw-bold text-decoration-none hover-primary" style="color: var(--text-primary);" title="Hubungi via WhatsApp">
                                {{ $profile->phone ?? '+62 882-2582-5512' }}
                            </a>
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="contact-info-card">
                        <div class="p-3 rounded-circle bg-info bg-opacity-10 text-info fs-4">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <span class="small text-muted d-block">Domisili &amp; Lokasi Kerja:</span>
                            <span class="fw-bold" style="color: var(--text-primary);">{{ $profile->location ?? 'Jakarta Utara / Bekasi, Indonesia' }} (Siap On-site / Remote)</span>
                        </div>
                    </div>

                    <!-- Social / Professional Channels -->
                    <div class="glass-card p-4 mt-auto">
                        <h4 class="h6 fw-bold mb-3 font-heading" style="color: var(--text-primary);">Jejaring Profesional:</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($socialLinks as $soc)
                                @php
                                    $linkUrl = $soc->url;
                                    if (strtolower($soc->platform) === 'whatsapp' && !empty($cleanProfPhone)) {
                                        $linkUrl = $waProfUrl;
                                    } elseif (strtolower($soc->platform) === 'email' && !empty($cleanProfEmail)) {
                                        $linkUrl = $gmailProfUrl;
                                    }
                                @endphp
                                <a href="{{ $linkUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-custom">
                                    <i class="bi {{ $soc->icon }} me-1"></i> {{ $soc->platform }}
                                </a>
                            @endforeach
                            <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-sm btn-primary-custom ms-auto">
                                <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> Download CV (PDF)
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Contact Form -->
            <div class="col-lg-7 reveal">
                <div class="glass-card p-4 p-md-5 h-100">
                    <h3 class="h4 fw-bold mb-2 font-heading" style="color: var(--text-primary);">Kirimkan Pesan / Tawaran</h3>
                    <p class="small text-subtle mb-4">Formulir terhubung langsung dan akan direspons secara cepat.</p>

                    <div id="contactAlertContainer">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('portfolio.contact') }}" method="POST" id="contactForm">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label small fw-semibold">Nama Lengkap / Instansi *</label>
                                <input type="text" name="name" id="name" class="form-control form-control-custom @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso (HR PT Solusi Teknologi)" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label small fw-semibold">Alamat Email *</label>
                                <input type="email" name="email" id="email" class="form-control form-control-custom @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="hrd@perusahaan.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Nomor WA (Opsional) -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="phone" class="form-label small fw-semibold mb-0">
                                    <i class="bi bi-whatsapp text-success me-1"></i> Nomor WhatsApp <span class="fw-normal text-subtle">(Opsional)</span>
                                </label>
                                <span class="badge bg-secondary bg-opacity-25 text-muted fw-normal" style="font-size: 0.72rem;">
                                    Boleh dikosongkan jika hanya lewat email
                                </span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary bg-opacity-10 border-subtle text-success">
                                    <i class="bi bi-whatsapp"></i>
                                </span>
                                <input type="tel" name="phone" id="phone" class="form-control form-control-custom @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Contoh: 081234567890">
                            </div>
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label small fw-semibold">Subjek / Topik Diskusi *</label>
                            <input type="text" name="subject" id="subject" class="form-control form-control-custom @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Contoh: Undangan Interview / Diskusi Posisi Junior Web Developer" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label small fw-semibold">Isi Pesan / Uraian Kebutuhan *</label>
                            <textarea name="message" id="message" rows="5" class="form-control form-control-custom @error('message') is-invalid @enderror" placeholder="Tuliskan gambaran posisi pekerjaan, detail proyek, atau jadwal wawancara..." required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 py-3" id="contactSubmitBtn">
                            <i class="bi bi-send-fill me-2"></i> Kirim Pesan / Tawaran Sekarang
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
                                            alertBox.innerHTML = `
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <i class="bi bi-check-circle-fill me-2"></i> ${result.message || 'Pesan Anda berhasil dikirim! Saya akan segera menghubungi Anda.'}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                                                </div>
                                            `;
                                            form.reset();
                                        } else {
                                            const errorMsg = (result && result.message) ? result.message : 'Terjadi kendala saat mengirim pesan. Silakan coba lagi atau hubungi via WhatsApp/Email.';
                                            alertBox.innerHTML = `
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <i class="bi bi-exclamation-triangle-fill me-2"></i> ${errorMsg}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                                                </div>
                                            `;
                                        }
                                    } catch (err) {
                                        alertBox.innerHTML = `
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Gagal terhubung ke server. Silakan hubungi langsung melalui WhatsApp atau Email.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                                            </div>
                                        `;
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

<!-- Back to Top Button -->
<button type="button" class="back-to-top" id="backToTopBtn" aria-label="Kembali ke atas halaman">
    <i class="bi bi-arrow-up"></i>
</button>

@endsection
