@extends('admin.layouts.admin')

@section('title', 'Dashboard Overview')
@section('page-title', 'Overview Dashboard')

@section('content')
<style>
    /* Scoped Enterprise Dashboard Styling: Quiet, Calm, Professional */
    .dashboard-header-subtitle {
        color: #94a3b8;
        font-size: 0.875rem;
        margin-top: -8px;
        margin-bottom: 24px;
    }

    .enterprise-card {
        background-color: #121620;
        border: 1px solid rgba(255, 255, 255, 0.07);
        border-radius: 12px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .enterprise-card:hover {
        border-color: rgba(255, 255, 255, 0.14);
        box-shadow: 0 8px 24px -10px rgba(0, 0, 0, 0.4);
    }

    /* Stat Cards */
    .stat-card-label {
        font-size: 0.8125rem;
        font-weight: 500;
        color: #94a3b8;
        letter-spacing: -0.1px;
    }

    .stat-card-number {
        font-size: 2rem;
        font-weight: 700;
        color: #f8fafc;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }

    .stat-icon-wrapper {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
    }

    .stat-card-link {
        font-size: 0.78125rem;
        color: #94a3b8;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color 0.15s ease;
    }

    .stat-card-link:hover {
        color: #f8fafc;
    }

    /* Clean Category & Status Pills */
    .pill-neutral {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #94a3b8;
        font-size: 0.72rem;
        font-weight: 500;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .unread-indicator-dot {
        width: 7px;
        height: 7px;
        background-color: #3b82f6;
        border-radius: 50%;
        display: inline-block;
    }

    /* Enterprise Table Styling */
    .table-enterprise {
        --bs-table-bg: transparent;
        --bs-table-color: #cbd5e1;
        margin-bottom: 0;
    }

    .table-enterprise thead th {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        padding: 10px 14px;
    }

    .table-enterprise tbody td {
        padding: 12px 14px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        vertical-align: middle;
        font-size: 0.85rem;
    }

    .table-enterprise tbody tr:hover td {
        background-color: rgba(255, 255, 255, 0.02);
    }

    /* Action Buttons */
    .btn-action-neutral {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #cbd5e1;
        font-size: 0.8rem;
        font-weight: 500;
        border-radius: 6px;
        padding: 5px 10px;
        transition: all 0.15s ease;
    }

    .btn-action-neutral:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.2);
    }

    .btn-action-white {
        background: #f8fafc;
        border: 1px solid #ffffff;
        color: #0f172a;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 6px;
        padding: 5px 12px;
        transition: all 0.15s ease;
    }

    .btn-action-white:hover {
        background: #ffffff;
        color: #000000;
        transform: translateY(-1px);
    }
</style>

<!-- Subtitle deskriptif ringkas -->
<p class="dashboard-header-subtitle">
    Ringkasan performa portofolio, metrik konten, dan pesan masuk terbaru.
</p>

<!-- 4 Kartu Metrik Utama (Bersih & Elegan) -->
<div class="row g-3 mb-4">
    <!-- Stat 1: Projects -->
    <div class="col-sm-6 col-xl-3">
        <div class="enterprise-card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="stat-card-label">Total Projects</span>
                <div class="stat-icon-wrapper">
                    <i class="bi bi-kanban fs-6"></i>
                </div>
            </div>
            <div class="stat-card-number mb-2">{{ $stats['projects_count'] }}</div>
            <a href="{{ route('admin.projects.index') }}" class="stat-card-link">
                <span>Kelola Projects</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Stat 2: Skills -->
    <div class="col-sm-6 col-xl-3">
        <div class="enterprise-card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="stat-card-label">Technical Skills</span>
                <div class="stat-icon-wrapper">
                    <i class="bi bi-tools fs-6"></i>
                </div>
            </div>
            <div class="stat-card-number mb-2">{{ $stats['skills_count'] }}</div>
            <a href="{{ route('admin.skills.index') }}" class="stat-card-link">
                <span>Kelola Skills</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Stat 3: Certificates -->
    <div class="col-sm-6 col-xl-3">
        <div class="enterprise-card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="stat-card-label">Certificates</span>
                <div class="stat-icon-wrapper">
                    <i class="bi bi-award fs-6"></i>
                </div>
            </div>
            <div class="stat-card-number mb-2">{{ $stats['certificates_count'] }}</div>
            <a href="{{ route('admin.certificates.index') }}" class="stat-card-link">
                <span>Kelola Sertifikat</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Stat 4: Messages -->
    <div class="col-sm-6 col-xl-3">
        <div class="enterprise-card p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="stat-card-label">Pesan Kontak</span>
                <div class="stat-icon-wrapper">
                    <i class="bi bi-envelope fs-6"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2 mb-2">
                <div class="stat-card-number" id="dashboardMessagesCount">{{ $stats['messages_count'] }}</div>
                @if($stats['unread_messages_count'] > 0)
                    <span class="badge bg-primary bg-opacity-20 text-primary border border-primary border-opacity-30 rounded-pill small" id="dashboardUnreadBadge" style="font-size: 0.7rem;">
                        {{ $stats['unread_messages_count'] }} baru
                    </span>
                @endif
            </div>
            <a href="{{ route('admin.messages.index') }}" class="stat-card-link">
                <span>Buka Inbox Pesan</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Layout Utama: 2 Kolom Seimbang (Pesan Masuk & Featured Projects) -->
<div class="row g-4 mb-4">
    <!-- Kolom 1: Pesan Masuk Terbaru -->
    <div class="col-lg-6">
        <div class="enterprise-card p-4 h-100 d-flex flex-column">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-white border-opacity-5">
                <div>
                    <h2 class="h6 fw-bold mb-0 text-white font-heading">
                        Pesan Masuk Terbaru
                    </h2>
                    <span class="text-muted" style="font-size: 0.75rem;">Pertanyaan dan tawaran kerja sama</span>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="btn-action-neutral">
                    Lihat Semua
                </a>
            </div>

            <div class="list-group list-group-flush bg-transparent flex-grow-1" id="recentMessagesList">
                @forelse($recentMessages as $msg)
                    <div class="list-group-item bg-transparent px-0 py-3 border-bottom border-white border-opacity-5">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center gap-2">
                                @if(!$msg->is_read)
                                    <span class="unread-indicator-dot" title="Belum dibaca"></span>
                                @endif
                                <span class="fw-semibold small {{ !$msg->is_read ? 'text-white' : 'text-secondary' }}">
                                    {{ $msg->name }}
                                </span>
                            </div>
                            <span class="text-muted" style="font-size: 0.72rem;">
                                {{ $msg->created_at ? $msg->created_at->diffForHumans() : 'baru saja' }}
                            </span>
                        </div>
                        <div class="small text-white fw-medium mb-1 text-truncate" style="max-width: 90%;">
                            {{ $msg->subject }}
                        </div>
                        <p class="small text-muted text-truncate mb-2" style="font-size: 0.8rem;">
                            {{ $msg->message }}
                        </p>
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn-action-neutral py-1 px-2" style="font-size: 0.75rem;">
                            Baca Pesan <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted my-auto" id="emptyRecentMessages">
                        <i class="bi bi-inbox fs-3 d-block mb-2 opacity-40"></i>
                        <span class="small">Belum ada pesan kontak yang masuk.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Kolom 2: Featured Projects -->
    <div class="col-lg-6">
        <div class="enterprise-card p-4 h-100 d-flex flex-column">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-white border-opacity-5">
                <div>
                    <h2 class="h6 fw-bold mb-0 text-white font-heading">
                        Daftar Featured Projects
                    </h2>
                    <span class="text-muted" style="font-size: 0.75rem;">Koleksi proyek portofolio aktif</span>
                </div>
                <a href="{{ route('admin.projects.create') }}" class="btn-action-white">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Project
                </a>
            </div>

            @if($recentProjects->count() > 0)
                <div class="table-responsive flex-grow-1">
                    <table class="table table-enterprise align-middle">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Kategori</th>
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
                                                    <i class="bi bi-image" style="font-size: 0.8rem;"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold text-white small">{{ $p->title }}</div>
                                                <div class="text-muted" style="font-size: 0.72rem;">{{ $p->slug }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="pill-neutral">
                                            {{ $p->category }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.projects.edit', $p->id) }}" class="btn-action-neutral py-1 px-2" title="Edit Proyek">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted my-auto">
                    <i class="bi bi-folder2-open fs-3 d-block mb-2 opacity-40"></i>
                    <span class="small">Belum ada project yang ditambahkan.</span>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Keamanan & Status Sistem (Tenang, Minimalis, Terletak Rapi di Bagian Bawah) -->
<div class="enterprise-card p-3 p-md-4">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-icon-wrapper" style="width: 40px; height: 40px;">
                <i class="bi bi-shield-check text-success fs-5"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="fw-semibold text-white small">Sistem Keamanan Aktif</span>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25" style="font-size: 0.68rem;">Siaga</span>
                </div>
                <div class="text-muted" style="font-size: 0.75rem;">
                    Pengirim: <span class="text-secondary">andikaamansyah31245@gmail.com</span> &bull; 
                    Penerima Alert &amp; OTP: <span class="text-secondary">andikaamansyah427@gmail.com</span>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Tombol Uji Kirim Email -->
            <form action="{{ route('admin.security.test-email') }}" method="POST">
                @csrf
                <button type="submit" class="btn-action-neutral" style="font-size: 0.75rem;">
                    <i class="bi bi-send me-1"></i> Uji Email
                </button>
            </form>

            <!-- Tombol Kunci Darurat (Lockdown) -->
            <form action="{{ route('admin.security.trigger-lock') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengunci halaman admin secara darurat? Portal akan langsung dikunci dan kode OTP akan dikirim ke email andikaamansyah427@gmail.com.');">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger" style="font-size: 0.75rem; border-color: rgba(239, 68, 68, 0.3); color: #f87171;">
                    <i class="bi bi-lock me-1"></i> Kunci Darurat
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
