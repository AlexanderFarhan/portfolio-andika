@extends('admin.layouts.admin')

@section('title', 'Dashboard Overview')
@section('page-title', 'Overview Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <!-- Stat 1: Projects -->
    <div class="col-sm-6 col-xl-3">
        <div class="glass-card p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-subtle small fw-semibold">Total Projects</span>
                <div class="p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-kanban fs-5"></i>
                </div>
            </div>
            <div class="fs-2 fw-bold text-gradient">{{ $stats['projects_count'] }}</div>
            <a href="{{ route('admin.projects.index') }}" class="small text-subtle text-decoration-none d-flex align-items-center gap-1 mt-2">
                Kelola Projects <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Stat 2: Skills -->
    <div class="col-sm-6 col-xl-3">
        <div class="glass-card p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-subtle small fw-semibold">Technical Skills</span>
                <div class="p-2 rounded-3 bg-success bg-opacity-10 text-success">
                    <i class="bi bi-tools fs-5"></i>
                </div>
            </div>
            <div class="fs-2 fw-bold text-success">{{ $stats['skills_count'] }}</div>
            <a href="{{ route('admin.skills.index') }}" class="small text-subtle text-decoration-none d-flex align-items-center gap-1 mt-2">
                Kelola Skills <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Stat 3: Certificates -->
    <div class="col-sm-6 col-xl-3">
        <div class="glass-card p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-subtle small fw-semibold">Certificates</span>
                <div class="p-2 rounded-3 bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-award fs-5"></i>
                </div>
            </div>
            <div class="fs-2 fw-bold text-warning">{{ $stats['certificates_count'] }}</div>
            <a href="{{ route('admin.certificates.index') }}" class="small text-subtle text-decoration-none d-flex align-items-center gap-1 mt-2">
                Kelola Sertifikat <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Stat 4: Messages -->
    <div class="col-sm-6 col-xl-3">
        <div class="glass-card p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-subtle small fw-semibold">Pesan Masuk</span>
                <div class="p-2 rounded-3 bg-danger bg-opacity-10 text-danger">
                    <i class="bi bi-envelope fs-5"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2">
                <div class="fs-2 fw-bold text-danger" id="dashboardMessagesCount">{{ $stats['messages_count'] }}</div>
                <span class="badge bg-danger rounded-pill" id="dashboardUnreadBadge" style="{{ $stats['unread_messages_count'] > 0 ? '' : 'display: none;' }}">{{ $stats['unread_messages_count'] }} baru</span>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="small text-subtle text-decoration-none d-flex align-items-center gap-1 mt-2">
                Buka Inbox <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Quick Access to All Portfolio Sections -->
<div class="glass-card p-3 p-md-4 mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h6 fw-bold mb-0 text-white font-heading">
            <i class="bi bi-pencil-square text-primary me-2"></i> Kelola Seluruh Section &amp; Kontainer Portofolio
        </h2>
        <span class="badge bg-primary bg-opacity-15 text-primary small">CRUD Konten Aktif</span>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-person-badge text-primary me-1"></i> Profil Utama
        </a>
        <a href="{{ route('admin.about.edit') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-info-circle text-info me-1"></i> About &amp; Pilar
        </a>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-kanban text-warning me-1"></i> Projects
        </a>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-tools text-success me-1"></i> Skills
        </a>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-briefcase text-primary me-1"></i> Experience
        </a>
        <a href="{{ route('admin.educations.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-mortarboard text-danger me-1"></i> Education
        </a>
        <a href="{{ route('admin.certificates.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-award text-warning me-1"></i> Certificates
        </a>
        <a href="{{ route('admin.social-links.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-share text-info me-1"></i> Social Media
        </a>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-custom">
            <i class="bi bi-chat-left-text text-success me-1"></i> Kontak &amp; Inbox
        </a>
    </div>
</div>

<!-- Security Monitoring & Remote Lock Card -->
<div class="glass-card p-3 p-md-4 mb-4 border-subtle">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-danger bg-opacity-20 text-danger border border-danger border-opacity-30">
                    <i class="bi bi-shield-check me-1"></i> Sistem Keamanan Aktif
                </span>
                <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30">
                    <i class="bi bi-broadcast me-1"></i> Remote Lock Siaga
                </span>
            </div>
            <h2 class="h6 fw-bold mb-1 text-white font-heading">
                Proteksi Akses Admin &amp; Notifikasi Email Otomatis
            </h2>
            <div class="small text-subtle">
                Pengirim Security: <span class="text-white fw-semibold">andikaamansyah31245@gmail.com</span> &bull; 
                Penerima Alert &amp; OTP: <span class="text-info fw-semibold">andikaamansyah427@gmail.com</span>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <form action="{{ route('admin.security.trigger-lock') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengunci halaman admin secara darurat? Portal akan langsung dikunci dan kode OTP akan dikirim ke email andikaamansyah427@gmail.com.');">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-lock-fill me-1"></i> Uji Kunci Darurat (Lockdown)
                </button>
            </form>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Messages -->
    <div class="col-lg-6">
        <div class="glass-card p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-subtle">
                <h2 class="h5 fw-bold mb-0 font-heading">
                    <i class="bi bi-chat-left-dots text-primary me-2"></i> Pesan Masuk Terbaru
                </h2>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-custom">Lihat Semua</a>
            </div>

                <div class="list-group list-group-flush bg-transparent" id="recentMessagesList">
                    @forelse($recentMessages as $msg)
                        <div class="list-group-item bg-transparent px-0 py-3 border-subtle">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="mb-0 fw-bold {{ !$msg->is_read ? 'text-primary' : '' }}">
                                    {{ $msg->name }}
                                    @if(!$msg->is_read)
                                        <span class="badge bg-primary ms-1" style="font-size: 0.65rem;">BARU</span>
                                    @endif
                                </h6>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ $msg->created_at ? $msg->created_at->diffForHumans() : 'baru saja' }}</small>
                            </div>
                            <div class="fw-medium small mb-1">{{ $msg->subject }}</div>
                            <p class="small text-subtle text-truncate mb-2">{{ $msg->message }}</p>
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-outline-custom py-1 px-2" style="font-size: 0.78rem;">
                                Baca Selengkapnya
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-4 text-subtle" id="emptyRecentMessages">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                            Belum ada pesan kontak yang masuk.
                        </div>
                    @endforelse
                </div>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="col-lg-6">
        <div class="glass-card p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-subtle">
                <h2 class="h5 fw-bold mb-0 font-heading">
                    <i class="bi bi-grid-fill text-primary me-2"></i> Daftar Featured Projects
                </h2>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-primary-custom">
                    <i class="bi bi-plus-lg"></i> Tambah Project
                </a>
            </div>

            @if($recentProjects->count() > 0)
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
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
                                                <img src="{{ $p->image }}" alt="{{ $p->title }}" class="rounded" style="width: 38px; height: 38px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <div class="fw-semibold small">{{ $p->title }}</div>
                                                <small class="text-muted" style="font-size: 0.72rem;">{{ $p->slug }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-25 text-info" style="font-size: 0.72rem;">
                                            {{ $p->category }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.projects.edit', $p->id) }}" class="btn btn-sm btn-outline-secondary p-1 px-2" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-subtle">
                    <i class="bi bi-folder-x fs-1 d-block mb-2 opacity-50"></i>
                    Belum ada project yang ditambahkan.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
