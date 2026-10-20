@extends('layouts.app')

@section('title', 'Andika Amansyah | Web Developer & System Analyst')

@section('content')

<!-- ==========================================================================
     SECTION 1: HERO / INTRO
     ========================================================================== -->
<section id="hero" class="hero-section">
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="reveal">
                    <!-- Status Pill -->
                    <div class="hero-availability-pill mb-3" role="status">
                        <span class="status-indicator" aria-hidden="true"></span>
                        <span>Terbuka untuk peluang kerja (Full-Time &amp; Magang)</span>
                    </div>

                    <h1 class="display-4 fw-extrabold mb-2 font-heading tracking-tight" style="color: var(--text-primary);">
                        Andika Amansyah
                    </h1>

                    <h2 class="h5 text-primary fw-semibold mb-3 font-heading">
                        Mahasiswa Teknologi Informasi (UBSI) • Web Developer &amp; System Analyst
                    </h2>

                    <p class="lead mb-4 text-subtle" style="max-width: 600px; font-size: 1.05rem; line-height: 1.75;">
                        Saya fokus mengembangkan aplikasi web backend dengan <strong style="color: var(--text-primary);">Laravel &amp; MySQL</strong>, memodelkan kebutuhan sistem (<strong style="color: var(--text-primary);">SRS, UML, ERD</strong>), serta mengonfigurasi jaringan <strong style="color: var(--text-primary);">MikroTik RouterOS</strong> dan administrasi server Linux.
                    </p>

                    <!-- Hero Call to Action Buttons -->
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
                        <a href="#projects" class="btn btn-primary-custom" id="heroProjectsBtn">
                            <i class="bi bi-arrow-down-circle me-1"></i> Lihat Proyek
                        </a>
                        <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-outline-custom" id="heroCvBtn">
                            <i class="bi bi-file-earmark-pdf me-1 text-danger"></i> Unduh CV (PDF)
                        </a>
                        <a href="#contact" class="btn btn-outline-custom" id="heroContactBtn">
                            <i class="bi bi-chat-text me-1"></i> Hubungi Saya
                        </a>
                    </div>

                    <!-- Direct Social / Professional Channels -->
                    <div class="d-flex align-items-center gap-2 mb-4 pt-1">
                        <span class="small text-muted me-2 font-mono">Tautan:</span>
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
                                        $socUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($profile->email) . '&su=' . urlencode('Diskusi Tawaran Proyek / Peluang Kerja');
                                    }
                                @endphp
                                <a href="{{ $socUrl }}" target="_blank" rel="noopener noreferrer" class="btn-icon-round" aria-label="{{ $soc->platform }}" title="{{ $soc->platform }}">
                                    <i class="bi {{ $soc->icon }}"></i>
                                </a>
                            @endforeach
                        @endif
                    </div>

                    <!-- Quick Facts Grid -->
                    <div class="row g-2 pt-3 border-top border-subtle">
                        <div class="col-6 col-sm-3">
                            <div class="metric-card p-2 text-start">
                                <div class="fs-5 fw-bold font-heading text-primary">{{ $profile->gpa ?? '3.85 / 4.00' }}</div>
                                <div class="small text-muted" style="font-size: 0.76rem;">IPK S1 UBSI</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="metric-card p-2 text-start">
                                <div class="fs-5 fw-bold font-heading text-primary">{{ $profile->years_of_experience ?? '2+ Tahun' }}</div>
                                <div class="small text-muted" style="font-size: 0.76rem;">Eksplorasi Proyek</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="metric-card p-2 text-start">
                                <div class="fs-5 fw-bold font-heading text-primary">5 Proyek</div>
                                <div class="small text-muted" style="font-size: 0.76rem;">Web, IoT &amp; Jaringan</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="metric-card p-2 text-start">
                                <div class="fs-5 fw-bold font-heading text-primary">BNSP &amp; MikroTik</div>
                                <div class="small text-muted" style="font-size: 0.76rem;">Sertifikasi Resmi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Profile Card (Authentic Human Presentation) -->
            <div class="col-lg-5">
                <div class="reveal">
                    <div class="developer-card p-4 mx-auto" style="max-width: 380px;">
                        <!-- Portrait Image -->
                        <div class="profile-portrait-frame mx-auto mb-3">
                            <img src="{{ $profile->avatar ?? '/images/avatar-andika.svg' }}" alt="{{ $profile->name ?? 'Andika Amansyah' }}" class="img-fluid" width="130" height="130">
                        </div>

                        <div class="text-center mb-3">
                            <h3 class="h6 fw-bold mb-1 font-heading" style="color: var(--text-primary);">{{ $profile->name ?? 'Andika Amansyah' }}</h3>
                            <p class="small text-subtle mb-2">Universitas Bina Sarana Informatika (UBSI)</p>
                            <div class="d-flex justify-content-center gap-2">
                                <span class="badge border border-subtle text-subtle" style="font-size: 0.72rem; font-weight: 500;">
                                    <i class="bi bi-geo-alt me-1 text-primary"></i> Jakarta / Bekasi
                                </span>
                                <span class="badge border border-subtle text-subtle" style="font-size: 0.72rem; font-weight: 500;">
                                    <i class="bi bi-briefcase me-1 text-success"></i> Siap Kerja
                                </span>
                            </div>
                        </div>

                        <!-- Focus Activity Note -->
                        <div class="p-3 rounded-3 mb-3 border border-subtle" style="background: var(--bg-primary); font-size: 0.82rem; line-height: 1.6;">
                            <div class="text-muted small fw-semibold mb-1">
                                <i class="bi bi-activity text-primary me-1"></i> Aktivitas Saat Ini:
                            </div>
                            <div class="text-subtle">
                                Menyelesaikan kuliah S1 semester akhir, mengerjakan proyek aplikasi web Laravel, dan menguji integrasi mikrokontroler ESP32 dengan REST API.
                            </div>
                        </div>

                        <!-- Core Stack Badges -->
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            <span class="tech-tag">Laravel 12</span>
                            <span class="tech-tag">PHP 8</span>
                            <span class="tech-tag">MySQL</span>
                            <span class="tech-tag">REST API</span>
                            <span class="tech-tag">MikroTik</span>
                            <span class="tech-tag">Ubuntu Server</span>
                            <span class="tech-tag">ESP32</span>
                        </div>

                        <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-sm btn-outline-custom w-100 justify-content-center">
                            <i class="bi bi-file-earmark-text me-1"></i> Buka CV Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 2: ABOUT & APPROACH
     ========================================================================== -->
<section id="about" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-person"></i> Tentang Saya</span>
            <h2 class="section-title">Latar Belakang &amp; Cara Kerja</h2>
            <p class="section-desc">
                Bagaimana saya memandang rekayasa perangkat lunak dan arsitektur sistem dari sudut pandang pemecahan masalah nyata.
            </p>
        </div>

        <div class="row g-4 align-items-stretch mb-4">
            <!-- Left: Personal Story & Coding Philosophy -->
            <div class="col-lg-6">
                <div class="glass-card p-4 p-md-5 reveal h-100 d-flex flex-column">
                    <h3 class="h5 fw-bold mb-3 font-heading" style="color: var(--text-primary);">
                        Menghubungkan Logika Bisnis dengan Arsitektur Teknis
                    </h3>
                    <div class="text-subtle mb-4 flex-grow-1" style="line-height: 1.8; font-size: 0.95rem;">
                        <p class="mb-3">
                            Saya adalah mahasiswa jurusan Teknologi Informasi di Universitas Bina Sarana Informatika (UBSI) dengan riwayat pendidikan kejuruan di bidang Teknik Komputer &amp; Jaringan (TKJ). Latar belakang ini membentuk cara berpikir saya: sebuah aplikasi tidak hanya harus memiliki tampilan yang bersih, tetapi juga arsitektur database yang kokoh dan dapat di-deploy dengan aman di infrastruktur server.
                        </p>
                        <p class="mb-3">
                            Dalam setiap proyek, saya terbiasa memulai dengan analisis kebutuhan (Software Requirement Specification), menyusun alur Use Case dan Activity Diagram, serta menormalisasi tabel database (3NF). Pendekatan ini membuat proses penulisan kode di Laravel menjadi lebih terstruktur, minim bug logika, dan mudah dikembangkan lebih lanjut.
                        </p>
                        <p class="mb-0">
                            Di luar pengembangan web, saya menyukai eksperimen jaringan di MikroTik RouterOS (seperti segmentasi VLAN dan manajemen bandwidth) serta mengintegrasikan mikrokontroler ESP32 dengan endpoint REST API backend.
                        </p>
                    </div>

                    <!-- Quick Candidate Facts -->
                    <div class="p-3 rounded-3 border border-subtle" style="background: var(--bg-primary);">
                        <div class="row g-2 small">
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.75rem;">Status Akademis:</span>
                                <strong style="color: var(--text-primary);">S1 Teknologi Informasi (UBSI)</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.75rem;">Indeks Prestasi Kumulatif:</span>
                                <strong class="text-primary font-mono">3.85 / 4.00</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.75rem;">Lokasi Domisili:</span>
                                <strong style="color: var(--text-primary);">Tanjung Priok, Jakarta Utara</strong>
                            </div>
                            <div class="col-sm-6">
                                <span class="text-muted d-block" style="font-size: 0.75rem;">Ketersediaan:</span>
                                <strong class="text-success">Siap Mulai Segera</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: 4 Practical Focus Areas -->
            <div class="col-lg-6">
                <div class="d-flex flex-column gap-3 h-100">
                    <div class="glass-card p-4 reveal flex-grow-1">
                        <div class="d-flex align-items-start gap-3">
                            <div class="skill-icon-box flex-shrink-0 mb-0">
                                <i class="bi bi-diagram-3"></i>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold mb-1" style="color: var(--text-primary);">1. Analisis Kebutuhan &amp; Desain Sistem</h4>
                                <p class="small text-subtle mb-0" style="line-height: 1.6;">
                                    Menyusun dokumen Software Requirement Specification (SRS), memodelkan Use Case &amp; Activity Diagram, serta merancang skema Entity Relationship Diagram (ERD) yang teruji secara relasional.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-4 reveal flex-grow-1">
                        <div class="d-flex align-items-start gap-3">
                            <div class="skill-icon-box flex-shrink-0 mb-0">
                                <i class="bi bi-code-slash"></i>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold mb-1" style="color: var(--text-primary);">2. Backend Web &amp; RESTful API (Laravel)</h4>
                                <p class="small text-subtle mb-0" style="line-height: 1.6;">
                                    Membangun arsitektur MVC bersih dengan Laravel 12 &amp; PHP 8, validasi request berlapis, Eloquent ORM, migrasi database, autentikasi aman, serta pembuatan laporan slip PDF.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-4 reveal flex-grow-1">
                        <div class="d-flex align-items-start gap-3">
                            <div class="skill-icon-box flex-shrink-0 mb-0">
                                <i class="bi bi-router"></i>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold mb-1" style="color: var(--text-primary);">3. Jaringan MikroTik &amp; Server Linux</h4>
                                <p class="small text-subtle mb-0" style="line-height: 1.6;">
                                    Mengonfigurasi router MikroTik RouterOS (routing, VLAN trunking, Simple Queue bandwidth QoS, firewall NAT) dan administrasi server Ubuntu Server 22.04 LTS berbasis CLI.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-4 reveal flex-grow-1">
                        <div class="d-flex align-items-start gap-3">
                            <div class="skill-icon-box flex-shrink-0 mb-0">
                                <i class="bi bi-cpu"></i>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold mb-1" style="color: var(--text-primary);">4. Integrasi Mikrokontroler &amp; IoT</h4>
                                <p class="small text-subtle mb-0" style="line-height: 1.6;">
                                    Memprogram mikrokontroler ESP32 dengan C++ untuk membaca modul RFID RC522 dan sensor, kemudian mengirim data secara nirkabel ke endpoint REST API cloud server secara real-time.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================================================
     SECTION 3: SKILLS
     ========================================================================== -->
<section id="skills" class="py-5 my-md-4" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-stack"></i> Keahlian Teknis</span>
            <h2 class="section-title">Teknologi &amp; Alat Kerja</h2>
            <p class="section-desc">
                Daftar bahasa pemrograman, framework, dan peralatan yang aktif saya gunakan dalam pengerjaan proyek.
            </p>
        </div>

        <!-- Skills Filter Tabs -->
        <ul class="nav nav-pills justify-content-center gap-2 mb-4 reveal flex-wrap" id="skillsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-3 py-2" id="all-skills-tab" data-bs-toggle="pill" data-bs-target="#all-skills" type="button" role="tab">
                    Semua ({{ $skills->count() }})
                </button>
            </li>
            @foreach($skillsByCategory as $category => $items)
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-3 py-2" id="cat-{{ Str::slug($category) }}-tab" data-bs-toggle="pill" data-bs-target="#cat-{{ Str::slug($category) }}" type="button" role="tab">
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
                        <div class="col-md-6 col-lg-4 reveal">
                            <div class="skill-card d-flex align-items-center gap-3">
                                <div class="p-2 rounded-2 bg-primary bg-opacity-10 text-primary flex-shrink-0">
                                    <i class="bi {{ $skill->icon ?? 'bi-check2' }} fs-5"></i>
                                </div>
                                <div class="flex-grow-1 min-w-0">
                                    <h3 class="h6 mb-0 fw-bold text-truncate" style="color: var(--text-primary);">{{ $skill->name }}</h3>
                                    <span class="small text-muted" style="font-size: 0.76rem;">{{ $skill->category }}</span>
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
                            <div class="col-md-6 col-lg-4 reveal">
                                <div class="skill-card d-flex align-items-center gap-3">
                                    <div class="p-2 rounded-2 bg-primary bg-opacity-10 text-primary flex-shrink-0">
                                        <i class="bi {{ $skill->icon ?? 'bi-check2' }} fs-5"></i>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <h3 class="h6 mb-0 fw-bold text-truncate" style="color: var(--text-primary);">{{ $skill->name }}</h3>
                                        <span class="small text-muted" style="font-size: 0.76rem;">{{ $skill->category }}</span>
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
     SECTION 4: FEATURED PROJECTS
     ========================================================================== -->
<section id="projects" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-kanban"></i> Karya Terpilih</span>
            <h2 class="section-title">Portofolio Proyek</h2>
            <p class="section-desc">
                Proyek yang telah saya rancang dan kembangkan, mencakup sistem web bisnis, aplikasi IoT mikrokontroler, dan perancangan jaringan komputer.
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

                        <div class="project-body d-flex flex-column flex-grow-1 p-4">
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
                                    <i class="bi bi-info-circle me-1"></i> Detail Fitur
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

                <!-- Project Detail Modal -->
                <div class="modal fade" id="projectModal{{ $p->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $p->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content glass-card border-subtle p-3">
                            <div class="modal-header border-subtle pb-3">
                                <div>
                                    <span class="badge border border-subtle text-primary mb-1 font-mono" style="font-size: 0.75rem;">{{ $p->category }}</span>
                                    <h4 class="modal-title fw-bold font-heading" style="color: var(--text-primary);" id="modalLabel{{ $p->id }}">{{ $p->title }}</h4>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body py-4">
                                @if($p->image)
                                    <div class="rounded-3 overflow-hidden mb-4 border border-subtle">
                                        <img src="{{ $p->image }}" alt="{{ $p->title }}" class="img-fluid w-100" style="max-height: 320px; object-fit: cover;">
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <h5 class="h6 fw-bold text-primary mb-2 font-heading"><i class="bi bi-card-text me-1"></i> Penjelasan Proyek &amp; Solusi:</h5>
                                    <div class="text-subtle" style="line-height: 1.8; white-space: pre-line; font-size: 0.95rem;">
                                        {{ $p->description }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h5 class="h6 fw-bold text-primary mb-2 font-heading"><i class="bi bi-tools me-1"></i> Teknologi yang Digunakan:</h5>
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
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Demo
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
     SECTION 5: EXPERIENCE
     ========================================================================== -->
<section id="experience" class="py-5 my-md-4" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-briefcase"></i> Pengalaman</span>
            <h2 class="section-title">Riwayat Proyek &amp; Kegiatan</h2>
            <p class="section-desc">
                Pengalaman nyata dalam pengembangan perangkat lunak, administrasi laboratorium jaringan komputer, dan riset mikrokontroler.
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
                                        <h3 class="h6 fw-bold mb-1 font-heading" style="color: var(--text-primary);">{{ $exp->role }}</h3>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-semibold text-primary small">{{ $exp->company }}</span>
                                            <span class="badge border border-subtle text-muted" style="font-size: 0.72rem;">{{ $exp->type }}</span>
                                        </div>
                                    </div>
                                    <span class="timeline-badge">
                                        <i class="bi bi-calendar-event me-1"></i> {{ $exp->start_date }} — {{ $exp->end_date ?? 'Sekarang' }}
                                    </span>
                                </div>

                                @if($exp->description)
                                    <p class="small text-subtle mb-3 mt-2" style="line-height: 1.7; white-space: pre-line;">
                                        {{ $exp->description }}
                                    </p>
                                @endif

                                @if($exp->skills_used)
                                    <div class="pt-2 border-top border-subtle">
                                        <small class="text-muted d-block mb-2 font-mono" style="font-size: 0.72rem;">TEKNOLOGI &amp; ALAT:</small>
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
     SECTION 6: EDUCATION
     ========================================================================== -->
<section id="education" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-mortarboard"></i> Pendidikan</span>
            <h2 class="section-title">Riwayat Akademis</h2>
            <p class="section-desc">
                Pendidikan formal di bidang Teknologi Informasi dan Teknik Komputer &amp; Jaringan yang membentuk fondasi teknis saya.
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
                                        <h3 class="h6 fw-bold mb-1 font-heading" style="color: var(--text-primary);">{{ $edu->institution }}</h3>
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <span class="fw-semibold text-primary small">{{ $edu->degree }}</span>
                                            @if($edu->field_of_study)
                                                <span class="text-muted small">• {{ $edu->field_of_study }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($edu->gpa)
                                            <span class="badge border border-subtle text-success font-mono" style="font-size: 0.75rem;">
                                                IPK: {{ $edu->gpa }}
                                            </span>
                                        @endif
                                        <span class="timeline-badge">
                                            <i class="bi bi-calendar3 me-1"></i> {{ $edu->start_year }} — {{ $edu->end_year ?? 'Sekarang' }}
                                        </span>
                                    </div>
                                </div>

                                @if($edu->description)
                                    <p class="small text-subtle mb-0 mt-2" style="line-height: 1.7;">
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
     SECTION 7: CERTIFICATES
     ========================================================================== -->
<section id="certificates" class="py-5 my-md-4" style="background: var(--bg-secondary);">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-patch-check"></i> Kredensial</span>
            <h2 class="section-title">Sertifikasi Resmi</h2>
            <p class="section-desc">
                Sertifikasi kompetensi resmi dari Badan Nasional Sertifikasi Profesi (BNSP) dan MikroTik Academy.
            </p>
        </div>

        <div class="row g-4">
            @forelse($certificates as $cert)
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="glass-card p-4 d-flex flex-column h-100">
                        @if($cert->image)
                            <div class="rounded-3 overflow-hidden mb-3 border border-subtle">
                                <img src="{{ $cert->image }}" alt="{{ $cert->title }}" class="img-fluid w-100" style="height: 150px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge border border-subtle text-primary" style="font-size: 0.72rem;">
                                {{ $cert->issuer }}
                            </span>
                            <span class="small text-muted font-mono" style="font-size: 0.75rem;">{{ $cert->issue_date }}</span>
                        </div>

                        <h3 class="h6 fw-bold mb-2 font-heading" style="color: var(--text-primary);">{{ $cert->title }}</h3>

                        @if($cert->description)
                            <p class="small text-subtle mb-3 flex-grow-1" style="line-height: 1.6;">
                                {{ $cert->description }}
                            </p>
                        @endif

                        <div class="d-flex align-items-center justify-content-between pt-2 border-top border-subtle mt-auto">
                            @if($cert->credential_id)
                                <small class="text-muted font-mono" style="font-size: 0.72rem;">No: {{ $cert->credential_id }}</small>
                            @else
                                <span class="small text-success" style="font-size: 0.75rem;"><i class="bi bi-check-circle me-1"></i> Terverifikasi</span>
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
     SECTION 8: CONTACT
     ========================================================================== -->
<section id="contact" class="py-5 my-md-4">
    <div class="container">
        <div class="text-center reveal mb-5">
            <span class="section-tag"><i class="bi bi-envelope"></i> Kontak</span>
            <h2 class="section-title">Hubungi Saya</h2>
            <p class="section-desc">
                Tertarik mendiskusikan peluang kerja, magang, proyek freelance, atau ingin bertanya seputar proyek yang saya buat? Silakan hubungi saya melalui jalur berikut.
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
    $gmailProfUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($cleanProfEmail) . '&su=' . urlencode('Diskusi Tawaran Proyek / Peluang Kerja');
    $waProfUrl = 'https://api.whatsapp.com/send?phone=' . $cleanProfPhone . '&text=' . urlencode('Halo Andika, saya melihat portofolio Anda dan ingin mendiskusikan peluang kerja/proyek.');
@endphp

        <div class="row g-4 align-items-stretch">
            <!-- Left: Direct Channels -->
            <div class="col-lg-5 reveal">
                <div class="d-flex flex-column gap-3 h-100">
                    <!-- Email Card -->
                    <div class="p-3 rounded-3 border border-subtle d-flex align-items-center gap-3" style="background: var(--bg-card);">
                        <div class="p-2 rounded-2 bg-primary bg-opacity-10 text-primary fs-4 flex-shrink-0">
                            <i class="bi bi-envelope-at"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="small text-muted d-block" style="font-size: 0.75rem;">Email:</span>
                            <a href="{{ $gmailProfUrl }}" target="_blank" rel="noopener noreferrer" class="fw-semibold text-decoration-none hover-primary text-break" style="color: var(--text-primary); font-size: 0.95rem;">
                                {{ $cleanProfEmail }}
                            </a>
                        </div>
                    </div>

                    <!-- WhatsApp Card -->
                    <div class="p-3 rounded-3 border border-subtle d-flex align-items-center gap-3" style="background: var(--bg-card);">
                        <div class="p-2 rounded-2 bg-success bg-opacity-10 text-success fs-4 flex-shrink-0">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="small text-muted d-block" style="font-size: 0.75rem;">WhatsApp / Telepon:</span>
                            <a href="{{ $waProfUrl }}" target="_blank" rel="noopener noreferrer" class="fw-semibold text-decoration-none hover-primary" style="color: var(--text-primary); font-size: 0.95rem;">
                                {{ $profile->phone ?? '+62 882-2582-5512' }}
                            </a>
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="p-3 rounded-3 border border-subtle d-flex align-items-center gap-3" style="background: var(--bg-card);">
                        <div class="p-2 rounded-2 bg-info bg-opacity-10 text-info fs-4 flex-shrink-0">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="small text-muted d-block" style="font-size: 0.75rem;">Lokasi Domisili:</span>
                            <span class="fw-semibold" style="color: var(--text-primary); font-size: 0.95rem;">{{ $profile->location ?? 'Jakarta Utara / Bekasi, Indonesia' }}</span>
                        </div>
                    </div>

                    <!-- Social / Professional Channels -->
                    <div class="p-4 rounded-3 border border-subtle mt-auto" style="background: var(--bg-card);">
                        <h4 class="h6 fw-bold mb-3 font-heading" style="color: var(--text-primary);">Tautan Profil:</h4>
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
                                <i class="bi bi-file-earmark-pdf me-1"></i> CV (PDF)
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Contact Form -->
            <div class="col-lg-7 reveal">
                <div class="glass-card p-4 p-md-5 h-100">
                    <h3 class="h5 fw-bold mb-1 font-heading" style="color: var(--text-primary);">Kirimkan Pesan</h3>
                    <p class="small text-subtle mb-4">Pesan akan langsung terkirim ke sistem dan segera saya respons.</p>

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
                                <label for="name" class="form-label small fw-semibold">Nama Lengkap *</label>
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

                        <!-- Kolom Nomor WA (Opsional) -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="phone" class="form-label small fw-semibold mb-0">
                                    <i class="bi bi-whatsapp text-success me-1"></i> Nomor WhatsApp <span class="fw-normal text-subtle">(Opsional)</span>
                                </label>
                                <span class="badge border border-subtle text-muted fw-normal" style="font-size: 0.72rem;">
                                    Boleh dikosongkan
                                </span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text border-subtle text-success" style="background: var(--bg-secondary);">
                                    <i class="bi bi-whatsapp"></i>
                                </span>
                                <input type="tel" name="phone" id="phone" class="form-control form-control-custom @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                            </div>
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label small fw-semibold">Subjek Pesan *</label>
                            <input type="text" name="subject" id="subject" class="form-control form-control-custom @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Contoh: Peluang Kerja / Diskusi Proyek Web" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label small fw-semibold">Isi Pesan *</label>
                            <textarea name="message" id="message" rows="5" class="form-control form-control-custom @error('message') is-invalid @enderror" placeholder="Tuliskan pesan atau kebutuhan yang ingin didiskusikan..." required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 py-3" id="contactSubmitBtn">
                            <i class="bi bi-send me-1"></i> Kirim Pesan
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
                                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengirim...';
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
<button type="button" class="back-to-top" id="backToTopBtn" aria-label="Kembali ke atas">
    <i class="bi bi-arrow-up"></i>
</button>

@endsection
