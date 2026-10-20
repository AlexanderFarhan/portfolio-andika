@extends('admin.layouts.admin')

@section('title', 'Dashboard Overview')
@section('page-title', 'Overview & Telemetry')

@section('content')
<!-- ==========================================================================
     COMMAND & ACTION TOOLBAR (Linear/Stripe Quick Bar)
     ========================================================================== -->
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <span class="chip-linear chip-linear-green font-mono">
                <span class="live-pulse-dot" style="width: 6px; height: 6px;"></span> SISTEM ONLINE
            </span>
            <span class="text-muted font-mono" style="font-size: 0.72rem;">PRODUCTION &bull; ASIA-SOUTHEAST (SIN1)</span>
        </div>
        <p class="text-secondary small mb-0" style="font-size: 0.825rem;">
            Ringkasan data operasional portofolio, interaksi rekruter masuk, dan status infrastruktur cloud.
        </p>
    </div>

    <!-- Quick Action Group -->
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <a href="{{ route('admin.projects.create') }}" class="btn-linear-primary" title="Tambah Proyek Baru">
            <i class="bi bi-plus-lg"></i>
            <span>Project Baru</span>
            <kbd class="kbd-shortcut ms-1 d-none d-sm-inline">N</kbd>
        </a>
        <a href="{{ route('admin.skills.create') }}" class="btn-linear-secondary" title="Tambah Keahlian">
            <i class="bi bi-cpu"></i>
            <span>Skill Baru</span>
        </a>
        <a href="{{ route('portfolio.index') }}" target="_blank" class="btn-linear-secondary" title="Buka Website Portofolio">
            <i class="bi bi-box-arrow-up-right"></i>
            <span class="d-none d-md-inline">Lihat Live</span>
        </a>
    </div>
</div>

<!-- ==========================================================================
     PRIMARY KPI METRIC CARDS (Linear Style - Razor Sharp, Tabular Numerals)
     ========================================================================== -->
<div class="row g-3 mb-4">
    <!-- Metric 1: Total Projects -->
    <div class="col-sm-6 col-xl-3">
        <div class="linear-card linear-kpi-card">
            <div class="kpi-header">
                <span class="kpi-title">TOTAL PROJECTS</span>
                <div class="kpi-icon">
                    <i class="bi bi-kanban"></i>
                </div>
            </div>
            <div class="kpi-value">{{ $stats['projects_count'] }}</div>
            <div class="kpi-meta font-mono">
                <span class="text-info fw-semibold">{{ $stats['featured_projects_count'] ?? 0 }} Unggulan</span> &bull; 
                <span>{{ $stats['projects_count'] }} Terpublikasi</span>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.projects.index') }}" class="kpi-link">
                    <span>Kelola Proyek</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
                <span class="text-muted font-mono" style="font-size: 0.7rem;">/projects</span>
            </div>
        </div>
    </div>

    <!-- Metric 2: Inbox & Inquiries -->
    <div class="col-sm-6 col-xl-3">
        <div class="linear-card linear-kpi-card">
            <div class="kpi-header">
                <span class="kpi-title">PESAN MASUK</span>
                <div class="kpi-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <div class="kpi-value" id="dashboardMessagesCount">{{ $stats['messages_count'] }}</div>
                @if($stats['unread_messages_count'] > 0)
                    <span class="chip-linear chip-linear-blue font-mono" id="dashboardUnreadBadge">
                        {{ $stats['unread_messages_count'] }} baru
                    </span>
                @else
                    <span class="chip-linear chip-linear-neutral font-mono" id="dashboardUnreadBadge" style="display: none;">
                        0 baru
                    </span>
                @endif
            </div>
            <div class="kpi-meta font-mono">
                @if($stats['unread_messages_count'] > 0)
                    <span class="text-warning fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>Perlu ditinjau</span>
                @else
                    <span class="text-success"><i class="bi bi-check2 me-1"></i>Semua telah dibaca</span>
                @endif
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.messages.index') }}" class="kpi-link">
                    <span>Buka Kotak Masuk</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
                <span class="text-muted font-mono" style="font-size: 0.7rem;">/messages</span>
            </div>
        </div>
    </div>

    <!-- Metric 3: Technical Skills Inventory -->
    <div class="col-sm-6 col-xl-3">
        <div class="linear-card linear-kpi-card">
            <div class="kpi-header">
                <span class="kpi-title">INVENTARIS SKILLS</span>
                <div class="kpi-icon">
                    <i class="bi bi-cpu"></i>
                </div>
            </div>
            <div class="kpi-value">{{ $stats['skills_count'] }}</div>
            <div class="kpi-meta font-mono">
                <span>Web &bull; Analyst &bull; Net &bull; IoT</span>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.skills.index') }}" class="kpi-link">
                    <span>Kelola Keahlian</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
                <span class="text-muted font-mono" style="font-size: 0.7rem;">/skills</span>
            </div>
        </div>
    </div>

    <!-- Metric 4: Academic & Credentials -->
    <div class="col-sm-6 col-xl-3">
        <div class="linear-card linear-kpi-card">
            <div class="kpi-header">
                <span class="kpi-title">KREDENSIAL RESMI</span>
                <div class="kpi-icon">
                    <i class="bi bi-award"></i>
                </div>
            </div>
            <div class="kpi-value">{{ ($stats['certificates_count'] ?? 0) + ($stats['education_count'] ?? 0) }}</div>
            <div class="kpi-meta font-mono">
                <span class="text-success fw-semibold">{{ $stats['certificates_count'] }} Sertifikat</span> &bull; 
                <span>{{ $stats['education_count'] }} Pendidikan</span>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.certificates.index') }}" class="kpi-link">
                    <span>Lihat Sertifikasi</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
                <span class="text-muted font-mono" style="font-size: 0.7rem;">/certificates</span>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     CORE DATA VIEW: TWO-COLUMN BALANCED SPLIT (Stripe/Linear Work Area)
     ========================================================================== -->
<div class="row g-4 mb-4">
    <!-- Panel 1: Live Inquiries Stream (Messages) -->
    <div class="col-lg-6">
        <div class="linear-card p-3 p-md-4 h-100 d-flex flex-column">
            <!-- Header bar -->
            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom border-white border-opacity-5">
                <div class="d-flex align-items-center gap-2">
                    <h2 class="h6 fw-bold mb-0 text-white font-heading">
                        Inquiries &amp; Pesan Kontak
                    </h2>
                    @if($stats['unread_messages_count'] > 0)
                        <span class="chip-linear chip-linear-blue font-mono" style="font-size: 0.65rem;">
                            {{ $stats['unread_messages_count'] }} UNREAD
                        </span>
                    @endif
                </div>
                <a href="{{ route('admin.messages.index') }}" class="btn-linear-secondary py-1 px-2" style="font-size: 0.75rem;">
                    <span>Semua Pesan</span>
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <!-- Messages Stream List -->
            <div class="list-group list-group-flush bg-transparent flex-grow-1" id="recentMessagesList">
                @forelse($recentMessages as $msg)
                    <div class="list-group-item bg-transparent px-0 py-3 border-bottom border-white border-opacity-5">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center gap-2">
                                @if(!$msg->is_read)
                                    <span class="live-pulse-dot" style="width: 7px; height: 7px; background-color: #38bdf8;" title="Pesan Belum Dibaca"></span>
                                @else
                                    <span style="width: 7px; height: 7px; border-radius: 50%; background-color: rgba(255,255,255,0.15); display: inline-block;"></span>
                                @endif
                                <span class="fw-semibold small {{ !$msg->is_read ? 'text-white' : 'text-secondary' }}">
                                    {{ $msg->name }}
                                </span>
                                @if(!$msg->is_read)
                                    <span class="chip-linear chip-linear-blue font-mono" style="font-size: 0.62rem; padding: 1px 4px;">BARU</span>
                                @endif
                            </div>
                            <span class="text-muted font-mono" style="font-size: 0.72rem;">
                                {{ $msg->created_at ? $msg->created_at->diffForHumans() : 'baru saja' }}
                            </span>
                        </div>
                        <div class="small fw-medium text-white mb-1 text-truncate" style="max-width: 92%;">
                            {{ $msg->subject }}
                        </div>
                        <p class="small text-muted text-truncate mb-2" style="font-size: 0.78rem; line-height: 1.5;">
                            {{ $msg->message }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between pt-1">
                            <span class="text-secondary font-mono" style="font-size: 0.7rem;">
                                <i class="bi bi-envelope me-1"></i> {{ $msg->email }}
                            </span>
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn-linear-secondary py-1 px-2" style="font-size: 0.72rem;">
                                <span>Detail</span>
                                <i class="bi bi-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted my-auto" id="emptyRecentMessages">
                        <i class="bi bi-inbox fs-3 d-block mb-2 opacity-30"></i>
                        <span class="small font-mono">Belum ada pesan kontak dari pengunjung.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Panel 2: Portfolio Project Inventory -->
    <div class="col-lg-6">
        <div class="linear-card p-3 p-md-4 h-100 d-flex flex-column">
            <!-- Header bar -->
            <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom border-white border-opacity-5">
                <div>
                    <h2 class="h6 fw-bold mb-0 text-white font-heading">
                        Katalog Proyek Terkini
                    </h2>
                    <span class="text-muted font-mono" style="font-size: 0.72rem;">Status publikasi &amp; showcase portofolio</span>
                </div>
                <a href="{{ route('admin.projects.create') }}" class="btn-linear-primary py-1 px-2" style="font-size: 0.75rem;">
                    <i class="bi bi-plus-lg me-1"></i> Tambah
                </a>
            </div>

            @if($recentProjects->count() > 0)
                <div class="table-responsive flex-grow-1">
                    <table class="linear-data-table align-middle">
                        <thead>
                            <tr>
                                <th>Proyek</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProjects as $p)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($p->image)
                                                <img src="{{ $p->image }}" alt="{{ $p->title }}" class="rounded" style="width: 32px; height: 32px; object-fit: cover; border: 1px solid rgba(255,255,255,0.08);">
                                            @else
                                                <div class="rounded d-flex align-items-center justify-content-center bg-dark text-muted" style="width: 32px; height: 32px; border: 1px solid rgba(255,255,255,0.08);">
                                                    <i class="bi bi-kanban" style="font-size: 0.8rem;"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold text-white small">{{ $p->title }}</div>
                                                <div class="text-muted font-mono" style="font-size: 0.7rem;">/{{ $p->slug }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="chip-linear chip-linear-neutral font-mono">
                                            {{ $p->category }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($p->is_featured)
                                            <span class="chip-linear chip-linear-blue font-mono" title="Ditampilkan di halaman utama">
                                                <i class="bi bi-star-fill text-warning" style="font-size: 0.65rem;"></i> Pilihan
                                            </span>
                                        @else
                                            <span class="chip-linear chip-linear-neutral font-mono">
                                                Standar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex align-items-center justify-content-end gap-1">
                                            <a href="{{ route('admin.projects.edit', $p->id) }}" class="btn-linear-secondary py-1 px-2" title="Edit Proyek" style="font-size: 0.75rem;">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if($p->demo_url)
                                                <a href="{{ $p->demo_url }}" target="_blank" class="btn-linear-secondary py-1 px-2" title="Buka Live Demo" style="font-size: 0.75rem;">
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted my-auto">
                    <i class="bi bi-folder2-open fs-3 d-block mb-2 opacity-30"></i>
                    <span class="small font-mono">Belum ada project yang ditambahkan.</span>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- ==========================================================================
     INFRASTRUCTURE, RUNTIME TELEMETRY & SECURITY (Stripe Workbench Style)
     ========================================================================== -->
<div class="linear-card p-3 p-md-4">
    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-white border-opacity-5">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-hdd-network text-info"></i>
            <h3 class="h6 fw-bold mb-0 text-white font-heading">
                Telemetri Sistem &amp; Pusat Keamanan
            </h3>
        </div>
        <span class="chip-linear chip-linear-green font-mono" style="font-size: 0.7rem;">
            <i class="bi bi-shield-check me-1"></i> ENKRIPSI AKTIF
        </span>
    </div>

    <div class="row g-3">
        <!-- Tile 1: Environment & Runtime -->
        <div class="col-md-4">
            <div class="telemetry-tile">
                <div class="text-muted font-mono small mb-1" style="font-size: 0.68rem; letter-spacing: 0.05em; text-transform: uppercase;">
                    Runtime &amp; Cloud Database
                </div>
                <div class="fw-semibold text-white small mb-1">
                    Laravel 12 &bull; PHP 8.2 &bull; PostgreSQL
                </div>
                <div class="text-secondary font-mono" style="font-size: 0.72rem;">
                    Host: Neon Cloud Serverless (pgvector ready)
                </div>
            </div>
        </div>

        <!-- Tile 2: Dispatcher & Communication -->
        <div class="col-md-4">
            <div class="telemetry-tile">
                <div class="text-muted font-mono small mb-1" style="font-size: 0.68rem; letter-spacing: 0.05em; text-transform: uppercase;">
                    Email Alert Dispatcher
                </div>
                <div class="fw-semibold text-white small mb-1">
                    Gmail SMTP TLS (Port 587)
                </div>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <span class="text-success font-mono" style="font-size: 0.72rem;">
                        <i class="bi bi-check-circle-fill me-1"></i> Siaga Otentikasi
                    </span>
                    <form action="{{ route('admin.security.test-email') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-linear-secondary py-1 px-2" style="font-size: 0.7rem;">
                            <i class="bi bi-send me-1"></i> Tes Ping
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tile 3: Emergency Lockdown Guard -->
        <div class="col-md-4">
            <div class="telemetry-tile">
                <div class="text-muted font-mono small mb-1" style="font-size: 0.68rem; letter-spacing: 0.05em; text-transform: uppercase;">
                    Protokol Darurat (Lockdown)
                </div>
                <div class="fw-semibold text-white small mb-1">
                    2FA &bull; One-Time Password Guard
                </div>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <span class="text-secondary font-mono" style="font-size: 0.72rem;">
                        Target: andikaamansyah427@gmail.com
                    </span>
                    <form action="{{ route('admin.security.trigger-lock') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengunci portal admin secara darurat? Portal akan langsung dibekukan dan kode OTP akan dikirim ke email terdaftar.');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2 font-mono" style="font-size: 0.7rem; border-color: rgba(239, 68, 68, 0.35);">
                            <i class="bi bi-lock me-1"></i> Kunci
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
