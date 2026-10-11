<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Andika Amansyah Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark text-light admin-body">
    <div class="d-flex admin-wrapper">
        <!-- Admin Sidebar -->
        <aside class="admin-sidebar d-flex flex-column p-3" id="adminSidebar">
            <div class="d-flex align-items-center justify-content-between mb-4 px-2">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                    <span class="p-2 rounded-3 bg-primary text-white d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                        <i class="bi bi-code-slash fs-5"></i>
                    </span>
                    <span class="fs-5 fw-bold text-white font-heading">Andika Admin</span>
                </a>
                <button class="btn btn-sm btn-outline-secondary d-lg-none" id="closeSidebarBtn">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <nav class="admin-sidebar-nav flex-grow-1">
                <small class="text-uppercase text-muted fw-bold px-3 mb-2" style="font-size: 0.75rem;">Menu Utama</small>
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="admin-nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> Data Profil
                </a>
                <a href="{{ route('admin.about.edit') }}" class="admin-nav-item {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                    <i class="bi bi-info-circle"></i> Tentang Saya (About)
                </a>

                <small class="text-uppercase text-muted fw-bold px-3 mt-3 mb-2" style="font-size: 0.75rem;">Konten Portofolio</small>
                <a href="{{ route('admin.projects.index') }}" class="admin-nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-kanban"></i> Projects
                </a>
                <a href="{{ route('admin.skills.index') }}" class="admin-nav-item {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i> Skills
                </a>
                <a href="{{ route('admin.experiences.index') }}" class="admin-nav-item {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i> Experience
                </a>
                <a href="{{ route('admin.educations.index') }}" class="admin-nav-item {{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard"></i> Education
                </a>
                <a href="{{ route('admin.certificates.index') }}" class="admin-nav-item {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
                    <i class="bi bi-award"></i> Certificates
                </a>

                <small class="text-uppercase text-muted fw-bold px-3 mt-3 mb-2" style="font-size: 0.75rem;">Interaksi & Media</small>
                <a href="{{ route('admin.messages.index') }}" class="admin-nav-item d-flex justify-content-between align-items-center {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <span><i class="bi bi-chat-left-text me-2"></i> Messages</span>
                    @php
                        $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.social-links.index') }}" class="admin-nav-item {{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}">
                    <i class="bi bi-share"></i> Social Links
                </a>

                <hr class="border-secondary opacity-25 my-3">
                <a href="{{ route('portfolio.index') }}" target="_blank" class="admin-nav-item text-info">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Portofolio
                </a>
            </nav>

            <div class="pt-3 border-top border-secondary border-opacity-25 mt-auto">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary bg-opacity-25 text-primary p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="fw-semibold small text-truncate text-white">{{ Auth::user()->name ?? 'Admin' }}</div>
                            <div class="text-muted" style="font-size: 0.72rem;">{{ Auth::user()->email ?? '' }}</div>
                        </div>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger p-1 px-2" title="Keluar">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Admin Main Content -->
        <div class="admin-main flex-grow-1">
            <!-- Top Navbar -->
            <header class="d-flex align-items-center justify-content-between pb-3 mb-4 border-bottom border-secondary border-opacity-25">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-secondary d-lg-none" id="toggleSidebarBtn">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <h1 class="h4 mb-0 fw-bold">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="theme-toggle-btn" id="themeToggleBtn" title="Ganti Tema">
                        <i class="bi bi-sun-fill text-warning"></i>
                    </button>
                    <a href="{{ route('portfolio.index') }}" target="_blank" class="btn btn-sm btn-outline-custom">
                        <i class="bi bi-eye"></i> <span class="d-none d-sm-inline">Preview Website</span>
                    </a>
                </div>
            </header>

            <!-- Flash Notifications -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-circle-fill me-1"></i> Terdapat beberapa kesalahan input:</div>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Main Page Content -->
            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.getElementById('toggleSidebarBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => sidebar.classList.toggle('show'));
            }
            if (closeBtn && sidebar) {
                closeBtn.addEventListener('click', () => sidebar.classList.remove('show'));
            }
        });
    </script>
</body>
</html>
