<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portofolio resmi Andika Amansyah — Mahasiswa S1 Teknologi Informasi Universitas Bina Sarana Informatika (UBSI) dengan IPK 3.85. Fokus pada System Analysis, Full-Stack Web Development (Laravel), Problem Solving, dan Network Engineering.">
    <meta name="keywords" content="Andika Amansyah, Portofolio, Software Engineer, System Analyst, Web Developer, UBSI, Laravel 12, PHP, MySQL, MikroTik, Linux Server, ESP32 IoT, Network Engineer, Curiculum Vitae, Resume IT">
    <meta name="author" content="Andika Amansyah">
    <meta property="og:title" content="Andika Amansyah | Software Engineer &amp; System Analyst Portfolio">
    <meta property="og:description" content="Mahasiswa S1 Teknologi Informasi UBSI (IPK 3.85) — Spesialisasi System Analysis, Full-Stack Laravel, Problem Solving, dan Network Infrastructure.">
    <meta property="og:type" content="website">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Andika Amansyah | Software Engineer & System Analyst — Portfolio')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts & Stylesheets compiled via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Main Public Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom" aria-label="Navigasi Utama">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('portfolio.index') }}">
                    <div class="brand-avatar-mini" aria-hidden="true">
                        <span class="brand-monogram">AA</span>
                    </div>
                    <div class="d-flex flex-column text-start">
                        <span class="brand-name">Andika Amansyah</span>
                        <span class="brand-role">Software Engineer &amp; Analyst</span>
                    </div>
                </a>

                <div class="d-flex align-items-center gap-2 order-lg-last">
                    <!-- Dark/Light Mode Switcher -->
                    <button type="button" class="theme-toggle-btn" id="themeToggleBtn" aria-label="Ganti Tema Tampilan (Dark/Light)" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ganti Tema">
                        <i class="bi bi-sun-fill text-warning"></i>
                    </button>

                    <!-- CV Download Button in Nav -->
                    <a href="{{ route('portfolio.cv') }}" target="_blank" class="btn btn-sm btn-linear-primary d-none d-sm-inline-flex" id="navCvBtn" title="Unduh Curriculum Vitae (PDF)">
                        <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> Download CV
                    </a>

                    <!-- Mobile Hamburger -->
                    <button class="navbar-toggler border-0 text-primary p-1" type="button" data-bs-toggle="collapse" data-bs-target="#portfolioNavbar" aria-controls="portfolioNavbar" aria-expanded="false" aria-label="Buka navigasi menu">
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
                            <a class="nav-link" href="#projects">Proyek</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#experience">Pengalaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#education">Pendidikan</a>
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
                        <div class="brand-avatar-mini" aria-hidden="true">
                            <span class="brand-monogram">AA</span>
                        </div>
                        <div class="d-flex flex-column text-start">
                            <span class="brand-name fs-6">Andika Amansyah</span>
                            <span class="brand-role" style="font-size: 0.72rem;">Software Engineer &amp; System Analyst</span>
                        </div>
                    </a>
                    <p class="text-subtle small mb-3" style="max-width: 440px; line-height: 1.7;">
                        Mahasiswa S1 Teknologi Informasi Universitas Bina Sarana Informatika (UBSI). Berfokus pada perancangan arsitektur sistem yang skalabel, pengembangan web full-stack yang aman, serta integrasi infrastruktur jaringan dan server.
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        @if(isset($socialLinks))
                            @php
                                $ftProfPhone = isset($profile->phone) ? preg_replace('/[^0-9]/', '', $profile->phone) : '';
                                if (str_starts_with($ftProfPhone, '0')) $ftProfPhone = '62' . substr($ftProfPhone, 1);
                                elseif (str_starts_with($ftProfPhone, '8')) $ftProfPhone = '62' . $ftProfPhone;

                                $ftProfEmail = $profile->email ?? 'andika.amansyah@gmail.com';
                            @endphp
                            @foreach($socialLinks as $soc)
                                @php
                                    $sUrl = $soc->url;
                                    if (strtolower($soc->platform) === 'whatsapp' && !empty($ftProfPhone)) {
                                        $sUrl = 'https://api.whatsapp.com/send?phone=' . $ftProfPhone . '&text=' . urlencode('Halo Andika, saya melihat portofolio Anda dan ingin mendiskusikan peluang kerja/proyek.');
                                    } elseif (strtolower($soc->platform) === 'email' && !empty($ftProfEmail)) {
                                        $sUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($ftProfEmail) . '&su=' . urlencode('Peluang Kerja / Diskusi Tawaran Proyek IT');
                                    }
                                @endphp
                                <a href="{{ $sUrl }}" target="_blank" rel="noopener noreferrer" class="btn-icon-round" aria-label="{{ $soc->platform }}" title="{{ $soc->platform }}">
                                    <i class="bi {{ $soc->icon }}"></i>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <h5 class="fw-bold small text-uppercase mb-3" style="color: var(--text-primary); letter-spacing: 0.05em;">Navigasi</h5>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="#about" class="text-subtle text-decoration-none hover-primary"><i class="bi bi-chevron-right me-1 small"></i> Tentang Saya</a></li>
                        <li><a href="#skills" class="text-subtle text-decoration-none hover-primary"><i class="bi bi-chevron-right me-1 small"></i> Keahlian Teknis</a></li>
                        <li><a href="#projects" class="text-subtle text-decoration-none hover-primary"><i class="bi bi-chevron-right me-1 small"></i> Portofolio Proyek</a></li>
                        <li><a href="#experience" class="text-subtle text-decoration-none hover-primary"><i class="bi bi-chevron-right me-1 small"></i> Pengalaman Kerja &amp; Lab</a></li>
                        <li><a href="#certificates" class="text-subtle text-decoration-none hover-primary"><i class="bi bi-chevron-right me-1 small"></i> Sertifikasi Resmi</a></li>
                        <li><a href="{{ route('portfolio.cv') }}" target="_blank" class="text-primary text-decoration-none fw-semibold"><i class="bi bi-file-earmark-pdf me-1"></i> Unduh CV (PDF)</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4 text-lg-end">
                    <div class="p-3 rounded-3 glass-card d-inline-block text-start w-100" style="max-width: 320px;">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="status-indicator"></span>
                            <span class="small fw-bold text-success">Ketersediaan: Siap Kerja</span>
                        </div>
                        <div class="small text-muted mb-1">Fokus Minat:</div>
                        <div class="small fw-semibold mb-2" style="color: var(--text-primary);">
                            Junior Web Developer • System Analyst • IT / Network Support
                        </div>
                        <div class="small text-muted mb-1"><i class="bi bi-geo-alt me-1 text-primary"></i> Domisili:</div>
                        <div class="small mb-3" style="color: var(--text-primary);">{{ $profile->location ?? 'Jakarta Utara / Bekasi, Indonesia' }}</div>
                        <a href="#contact" class="btn btn-sm btn-primary-custom w-100">
                            <i class="bi bi-chat-text me-1"></i> Hubungi Saya
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-subtle my-4 opacity-25">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 small text-muted">
                <div>
                    &copy; {{ date('Y') }} <strong>Andika Amansyah</strong> — Web Developer &amp; System Analyst.
                </div>
                <div>
                    Dibangun dengan Laravel 12 &amp; Bootstrap 5. Terbuka untuk peluang kerja &amp; kolaborasi proyek.
                </div>
            </div>
        </div>
    </footer>

    <!-- Clean URL & Smooth Scroll Handler for Contact Links -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#contact') {
                history.replaceState(null, null, window.location.pathname);
            }
            document.querySelectorAll('a[href="#contact"]').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    var target = document.getElementById('contact');
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                        history.replaceState(null, null, window.location.pathname);
                    }
                });
            });
        });
    </script>
</body>
</html>
