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
                    <span class="badge bg-danger rounded-pill" id="sidebarUnreadBadge" style="{{ $unreadCount > 0 ? '' : 'display: none;' }}">{{ $unreadCount }}</span>
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
                    <!-- Realtime Live Sync Status Indicator -->
                    <div class="d-none d-md-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-dark bg-opacity-50 border border-secondary border-opacity-25" id="realtimeStatusIndicator" title="Live Sync: Memeriksa pesan masuk secara otomatis">
                        <span class="live-pulse-dot"></span>
                        <span class="small text-subtle" style="font-size: 0.75rem;">Live Sync: <span id="syncStatusText" class="text-success fw-medium">Aktif</span></span>
                    </div>

                    <!-- Quick Messages Bell with live badge -->
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-custom position-relative p-2" title="Kotak Masuk Pesan">
                        <i class="bi bi-bell-fill"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="headerUnreadBadge" style="{{ $unreadCount > 0 ? '' : 'display: none;' }}">
                            {{ $unreadCount }}
                        </span>
                    </a>

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

    <!-- Realtime Toast Notification Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1090;">
        <div id="liveMessageToast" class="toast align-items-center text-white bg-dark border border-primary shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="12000">
            <div class="d-flex p-2">
                <div class="p-2 text-primary fs-3 d-flex align-items-center">
                    <i class="bi bi-chat-dots-fill"></i>
                </div>
                <div class="toast-body flex-grow-1">
                    <div class="fw-bold text-primary mb-1">🔔 Pesan Baru Masuk!</div>
                    <div class="small fw-semibold text-white" id="toastSenderName">Nama Pengirim</div>
                    <div class="small text-subtle text-truncate" style="max-width: 240px;" id="toastSubject">Subjek Pesan</div>
                    <div class="mt-2 pt-1 border-top border-secondary border-opacity-25 d-flex gap-2">
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-primary-custom py-1 px-2" style="font-size: 0.75rem;">Buka Inbox</a>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
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

        // Realtime Polling Engine with Synthesized Audio Chime & Live Notifications
        (function() {
            let audioCtx = null;
            function getAudioContext() {
                try {
                    if (!audioCtx) {
                        const AudioContext = window.AudioContext || window.webkitAudioContext;
                        if (AudioContext) audioCtx = new AudioContext();
                    }
                    if (audioCtx && audioCtx.state === 'suspended') {
                        audioCtx.resume();
                    }
                    return audioCtx;
                } catch(e) {
                    return null;
                }
            }
            document.addEventListener('click', () => { getAudioContext(); }, { once: true });

            function playChime() {
                try {
                    const ctx = getAudioContext();
                    if (!ctx) return;

                    // Chime note 1 (D5)
                    const osc1 = ctx.createOscillator();
                    const gain1 = ctx.createGain();
                    osc1.type = 'sine';
                    osc1.frequency.setValueAtTime(587.33, ctx.currentTime);
                    gain1.gain.setValueAtTime(0.2, ctx.currentTime);
                    gain1.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.35);
                    osc1.connect(gain1);
                    gain1.connect(ctx.destination);
                    osc1.start(ctx.currentTime);
                    osc1.stop(ctx.currentTime + 0.35);

                    // Chime note 2 (A5)
                    const osc2 = ctx.createOscillator();
                    const gain2 = ctx.createGain();
                    osc2.type = 'sine';
                    osc2.frequency.setValueAtTime(880, ctx.currentTime + 0.12);
                    gain2.gain.setValueAtTime(0.25, ctx.currentTime + 0.12);
                    gain2.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.65);
                    osc2.connect(gain2);
                    gain2.connect(ctx.destination);
                    osc2.start(ctx.currentTime + 0.12);
                    osc2.stop(ctx.currentTime + 0.65);
                } catch(e) {}
            }

            const originalTitle = document.title;
            let unreadNotificationCount = 0;
            window.addEventListener('focus', () => {
                unreadNotificationCount = 0;
                document.title = originalTitle;
            });

            let lastKnownId = {{ (int) (\App\Models\ContactMessage::max('id') ?? 0) }};
            const pollUrl = "{{ route('admin.messages.poll') }}";

            async function checkLiveMessages() {
                try {
                    const res = await fetch(`${pollUrl}?after_id=${lastKnownId}`, {
                        headers: { 'Accept': 'application/json' }
                    });
                    if (!res.ok) return;
                    const data = await res.json();

                    // Update badges across admin layout
                    const sidebarBadge = document.getElementById('sidebarUnreadBadge');
                    const headerBadge = document.getElementById('headerUnreadBadge');
                    const dashboardCount = document.getElementById('dashboardMessagesCount');
                    const dashboardUnreadBadge = document.getElementById('dashboardUnreadBadge');

                    if (sidebarBadge) {
                        sidebarBadge.innerText = data.unread_count;
                        sidebarBadge.style.display = data.unread_count > 0 ? 'inline-block' : 'none';
                    }
                    if (headerBadge) {
                        headerBadge.innerText = data.unread_count;
                        headerBadge.style.display = data.unread_count > 0 ? 'inline-block' : 'none';
                    }
                    if (dashboardCount) {
                        dashboardCount.innerText = data.total_count;
                    }
                    if (dashboardUnreadBadge) {
                        dashboardUnreadBadge.innerText = `${data.unread_count} baru`;
                        dashboardUnreadBadge.style.display = data.unread_count > 0 ? 'inline-block' : 'none';
                    }

                    // Handle newly arrived messages
                    if (data.has_new && data.new_messages && data.new_messages.length > 0) {
                        playChime();

                        // Tab alert
                        unreadNotificationCount += data.new_messages.length;
                        document.title = `(🔔 ${unreadNotificationCount} Pesan Baru!) ${originalTitle}`;

                        // Toast alert (latest message)
                        const latest = data.new_messages[data.new_messages.length - 1];
                        const nameEl = document.getElementById('toastSenderName');
                        const subjEl = document.getElementById('toastSubject');
                        if (nameEl) nameEl.innerText = latest.name;
                        if (subjEl) subjEl.innerText = latest.subject;

                        const toastEl = document.getElementById('liveMessageToast');
                        if (toastEl && window.bootstrap && window.bootstrap.Toast) {
                            const toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }

                        // Live inject row into messages table if open
                        const tableBody = document.getElementById('messagesTableBody');
                        if (tableBody) {
                            const emptyRow = document.getElementById('emptyMessagesRow');
                            if (emptyRow) emptyRow.remove();

                            const subtitle = document.getElementById('messagesCountSubtitle');
                            if (subtitle && data.total_count) {
                                subtitle.innerText = `Total ${data.total_count} pesan masuk melalui form kontak website`;
                            }

                            data.new_messages.forEach(msg => {
                                const tr = document.createElement('tr');
                                tr.className = 'table-active table-success-highlight';
                                tr.innerHTML = `
                                    <td><span class="badge bg-danger rounded-pill pulse">Baru</span></td>
                                    <td><div class="fw-bold text-primary">${escapeHtml(msg.name)}</div></td>
                                    <td><a href="mailto:${escapeHtml(msg.email)}" class="small text-subtle">${escapeHtml(msg.email)}</a></td>
                                    <td>
                                        <div class="fw-semibold small">${escapeHtml(msg.subject)}</div>
                                        <small class="text-muted text-truncate d-block" style="max-width: 250px;">${escapeHtml(msg.message)}</small>
                                    </td>
                                    <td><span class="small text-success fw-bold">${msg.created_at_human}</span></td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <a href="${msg.show_url}" class="btn btn-outline-primary" title="Buka Pesan"><i class="bi bi-eye"></i></a>
                                        </div>
                                    </td>
                                `;
                                tableBody.prepend(tr);
                            });
                        }

                        // Live inject item into recent messages list on dashboard if open
                        const recentList = document.getElementById('recentMessagesList');
                        if (recentList) {
                            const emptyRecent = document.getElementById('emptyRecentMessages');
                            if (emptyRecent) emptyRecent.remove();

                            data.new_messages.forEach(msg => {
                                const item = document.createElement('div');
                                item.className = 'list-group-item bg-transparent px-0 py-3 border-subtle table-success-highlight';
                                item.innerHTML = `
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="mb-0 fw-bold text-primary">${escapeHtml(msg.name)} <span class="badge bg-primary ms-1" style="font-size: 0.65rem;">BARU</span></h6>
                                        <small class="text-success fw-bold" style="font-size: 0.75rem;">${msg.created_at_human}</small>
                                    </div>
                                    <div class="fw-medium small mb-1">${escapeHtml(msg.subject)}</div>
                                    <p class="small text-subtle text-truncate mb-2">${escapeHtml(msg.message)}</p>
                                    <a href="${msg.show_url}" class="btn btn-sm btn-outline-custom py-1 px-2" style="font-size: 0.78rem;">Baca Selengkapnya</a>
                                `;
                                recentList.prepend(item);
                            });
                        }

                        lastKnownId = Math.max(lastKnownId, data.latest_id);
                    }
                } catch(e) {}
            }

            function escapeHtml(str) {
                if (!str) return '';
                return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
            }

            // Poll every 3.5 seconds
            setInterval(checkLiveMessages, 3500);
        })();
    </script>
</body>
</html>
