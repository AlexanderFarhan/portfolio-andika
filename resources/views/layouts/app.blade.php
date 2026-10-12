<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portofolio resmi Andika Amansyah — Mahasiswa Teknologi Informasi Universitas Bina Sarana Informatika (UBSI). Fokus pada System Analysis, Problem Solving, Web Development, dan Networking.">
    <meta name="keywords" content="Andika Amansyah, Portfolio, UBSI, Laravel 12, System Analyst, Web Developer, MikroTik, ESP32 IoT, Network Engineer">
    <meta name="author" content="Andika Amansyah">
    <meta property="og:title" content="Andika Amansyah | Web Resume &amp; Portfolio">
    <meta property="og:description" content="Mahasiswa Teknologi Informasi UBSI — System Analysis, Problem Solving, Web Development &amp; Networking.">
    <meta property="og:type" content="website">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Andika Amansyah | Web Resume & Portfolio')</title>

    <!-- Google Fonts & Stylesheets compiled via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Main Public Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('portfolio.index') }}">
                    <span class="p-1 px-2 rounded-3 bg-primary text-white font-mono fs-6 fw-bold">&lt;AA/&gt;</span>
                    <span class="fw-bold tracking-tight">Andika<span class="text-gradient">.dev</span></span>
                </a>

                <div class="d-flex align-items-center gap-2 order-lg-last">
                    <!-- Dark/Light Mode Switcher -->
                    <button type="button" class="theme-toggle-btn" id="themeToggleBtn" aria-label="Toggle Theme" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ganti Tema">
                        <i class="bi bi-sun-fill text-warning"></i>
                    </button>

                    <!-- CV Download Button in Nav -->
                    <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-sm btn-outline-custom d-none d-sm-inline-flex" id="navCvBtn">
                        <i class="bi bi-file-earmark-arrow-down"></i> CV PDF
                    </a>

                    <!-- Mobile Hamburger -->
                    <button class="navbar-toggler border-0 text-primary p-1" type="button" data-bs-toggle="collapse" data-bs-target="#portfolioNavbar" aria-controls="portfolioNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list fs-2 text-primary"></i>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="portfolioNavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-lg-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#hero">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#skills">Keahlian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#education">Pendidikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#experience">Pengalaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#projects">Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#certificates">Sertifikat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Body Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-5 border-top border-subtle position-relative overflow-hidden" style="background: var(--bg-secondary);">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <a class="d-inline-flex align-items-center gap-2 mb-3 text-decoration-none" href="#">
                        <span class="p-1 px-2 rounded-3 bg-primary text-white font-mono fs-6 fw-bold">&lt;AA/&gt;</span>
                        <span class="fw-bold fs-5 font-heading" style="color: var(--text-primary);">Andika Amansyah</span>
                    </a>
                    <p class="text-subtle small mb-3" style="max-width: 400px;">
                        Mahasiswa Teknologi Informasi Universitas Bina Sarana Informatika (UBSI). Berkomitmen menciptakan solusi digital handal melalui integrasi rekayasa perangkat lunak dan infrastruktur jaringan.
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        @if(isset($socialLinks))
                            @foreach($socialLinks as $soc)
                                <a href="{{ $soc->url }}" target="_blank" class="btn-icon-round" aria-label="{{ $soc->platform }}" title="{{ $soc->platform }}">
                                    <i class="bi {{ $soc->icon }}"></i>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <h5 class="fw-bold small text-uppercase mb-3" style="color: var(--text-primary);">Tautan Cepat</h5>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="#about" class="text-subtle text-decoration-none hover-primary">Tentang Andika</a></li>
                        <li><a href="#skills" class="text-subtle text-decoration-none hover-primary">Daftar Keahlian</a></li>
                        <li><a href="#projects" class="text-subtle text-decoration-none hover-primary">Featured Projects</a></li>
                        <li><a href="#certificates" class="text-subtle text-decoration-none hover-primary">Sertifikasi &amp; Prestasi</a></li>
                        <li><a href="{{ route('portfolio.cv') }}" target="_blank" class="text-subtle text-decoration-none hover-primary">Download Resume CV</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4 text-lg-end">
                    <div class="p-3 rounded-4 glass-card d-inline-block text-start">
                        <div class="small fw-semibold text-primary mb-1"><i class="bi bi-geo-alt-fill me-1"></i> Lokasi Domisili</div>
                        <div class="small mb-2" style="color: var(--text-primary);">Bekasi / Jakarta, Indonesia</div>
                        <a href="#contact" class="btn btn-sm btn-primary-custom w-100">
                            <i class="bi bi-chat-dots-fill me-1"></i> Hubungi Saya
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-subtle my-4 opacity-25">

            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between small text-muted">
                <div>&copy; {{ date('Y') }} <strong>Andika Amansyah</strong>. All rights reserved.</div>
                <div class="mt-2 mt-sm-0">
                    <a href="{{ route('admin.login') }}" class="text-muted text-decoration-none" title="Admin Access">
                        <i class="bi bi-shield-lock me-1"></i> Admin Portal
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Floating Button -->
    <button type="button" class="back-to-top" id="backToTopBtn" aria-label="Back to Top" title="Kembali ke atas">
        <i class="bi bi-chevron-up fs-5"></i>
    </button>
</body>
</html>
