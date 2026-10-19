<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ($isLocked ?? false) ? 'Akses Terkunci (Lockdown)' : 'Masuk ke Portal Admin' }} | Andika Amansyah</title>
    
    <!-- Clean, Enterprise Typography: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --bg-base: #0c0e14;
            --card-surface: #141824;
            --input-surface: #0f121a;
            --border-neutral: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(255, 255, 255, 0.16);
            --border-focus: #3b82f6;
            --text-main: #f8fafc;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
        }

        body {
            font-family: var(--font-family);
            background: radial-gradient(circle at 50% 0%, #1a2030 0%, #0d1017 65%, #080a0f 100%);
            color: var(--text-main);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            -webkit-font-smoothing: antialiased;
        }

        /* Enterprise Centered Authentication Container */
        .auth-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .auth-card {
            background-color: var(--card-surface);
            border: 1px solid var(--border-neutral);
            border-radius: 16px;
            padding: 36px 32px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.6), 0 0 1px 1px rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
        }

        /* Brand Logo Monogram */
        .brand-logo-container {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #1e2538 0%, #121622 100%);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .brand-logo-text {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        /* Form Labels & Inputs */
        .form-label-custom {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 6px;
            display: block;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-custom {
            width: 100%;
            background-color: var(--input-surface) !important;
            border: 1px solid var(--border-neutral) !important;
            color: var(--text-main) !important;
            border-radius: 8px !important;
            font-size: 14px !important;
            padding: 11px 14px !important;
            transition: all 0.2s ease;
        }

        .input-custom:hover {
            border-color: var(--border-hover) !important;
        }

        .input-custom:focus {
            border-color: var(--border-focus) !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
            outline: none !important;
        }

        .input-toggle-btn {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0;
            display: inline-flex;
            align-items: center;
            font-size: 15px;
            transition: color 0.15s ease;
        }

        .input-toggle-btn:hover {
            color: var(--text-main);
        }

        /* Primary Action Button (Clean, Solid, Confident) */
        .btn-primary-action {
            width: 100%;
            background-color: #f8fafc;
            color: #0f172a;
            border: 1px solid #ffffff;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            padding: 11px 16px;
            transition: all 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .btn-primary-action:hover {
            background-color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.12);
        }

        .btn-primary-action:active {
            transform: translateY(0);
        }

        /* Passkey Touch Biometric Button (Understated & Tactile) */
        .btn-passkey-subtle {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.04);
            color: var(--text-secondary);
            border: 1px solid var(--border-neutral);
            border-radius: 8px;
            font-weight: 500;
            font-size: 13.5px;
            padding: 10px 16px;
            transition: all 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-passkey-subtle:hover {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: var(--border-hover);
            color: var(--text-main);
        }

        /* Subtle alerts */
        .alert-subtle-error {
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            font-size: 13px;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-subtle-success {
            background: rgba(16, 185, 129, 0.08);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            font-size: 13px;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Footer Link */
        .footer-nav {
            text-align: center;
            margin-top: 24px;
        }

        .footer-nav a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .footer-nav a:hover {
            color: var(--text-secondary);
        }

        .footer-copyright {
            text-align: center;
            color: #475569;
            font-size: 11.5px;
            margin-top: 28px;
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">

        @if($isLocked ?? false)
            <!-- ============================================================== -->
            <!-- TAMPILAN LOCKDOWN DARURAT (MINIMALIS & PROFESIONAL)            -->
            <!-- ============================================================== -->
            <div class="auth-card border border-danger border-opacity-30">
                <div class="text-center mb-4">
                    <div class="brand-logo-container border-danger border-opacity-30 bg-danger bg-opacity-10 text-danger mb-3">
                        <i class="bi bi-shield-lock fs-4"></i>
                    </div>
                    <h1 class="h5 fw-bold text-white mb-1">Akses Terkunci</h1>
                    <p class="text-secondary small mb-0">Proteksi otomatis aktif setelah terdeteksi aktivitas login anomali.</p>
                </div>

                @if(session('error') || $errors->any())
                    <div class="alert-subtle-error">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') ?? $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.security.verify-otp') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="otp" class="form-label-custom text-center">Kode Verifikasi (OTP)</label>
                        <input type="text" name="otp" id="otp" 
                               class="input-custom text-center fw-bold fs-4 py-2"
                               placeholder="000000" maxlength="6" inputmode="numeric" pattern="[0-9]{6}" required autofocus
                               style="letter-spacing: 6px;">
                    </div>

                    <button type="submit" class="btn-primary-action mb-2">
                        Verifikasi &amp; Buka Akses
                    </button>
                </form>

                <form action="{{ route('admin.security.resend-otp') }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="btn-passkey-subtle w-100 py-2 small">
                        Kirim Ulang Kode OTP ke Email
                    </button>
                </form>

                <div class="footer-nav">
                    <a href="{{ route('portfolio.index') }}">
                        <i class="bi bi-arrow-left"></i> Kembali ke Website Utama
                    </a>
                </div>
            </div>

        @else
            <!-- ============================================================== -->
            <!-- TAMPILAN LOGIN UTAMA (ENTERPRISE / BESPOKE LARGE COMPANY)       -->
            <!-- ============================================================== -->
            <div class="auth-card">
                
                <!-- Brand Header -->
                <div class="text-center mb-4">
                    <div class="brand-logo-container">
                        <span class="brand-logo-text">A.</span>
                    </div>
                    <h1 class="h4 fw-bold text-white mb-1" style="letter-spacing: -0.3px;">Portal Admin</h1>
                    <p class="text-secondary small mb-0">Masuk untuk mengelola portofolio &amp; pesan kontak.</p>
                </div>

                <!-- Notifikasi / Pesan Error -->
                @if(session('success'))
                    <div class="alert-subtle-success">
                        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error') || $errors->any())
                    <div class="alert-subtle-error">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') ?? $errors->first() }}
                    </div>
                @endif

                <!-- Form Login -->
                <form action="{{ route('admin.login.submit') }}" method="POST" id="adminLoginForm">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label-custom">Email</label>
                        <div class="input-group-custom">
                            <input type="email" name="email" id="email" 
                                   class="input-custom @error('email') is-invalid @enderror" 
                                   value="{{ old('email', 'andika@theta-studio.dev') }}" 
                                   required autocomplete="email" autofocus 
                                   placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label-custom mb-0">Kata Sandi</label>
                            <a href="javascript:void(0)" onclick="handleRecoverPrompt()" class="small text-muted text-decoration-none" style="font-size: 12px;">
                                Lupa sandi?
                            </a>
                        </div>
                        <div class="input-group-custom">
                            <input type="password" name="password" id="password" 
                                   class="input-custom @error('password') is-invalid @enderror" 
                                   required placeholder="••••••••••••" value="">
                            <button type="button" class="input-toggle-btn" id="togglePasswordBtn" title="Tampilkan sandi">
                                <i class="bi bi-eye" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Ingat Saya -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="form-check d-flex align-items-center gap-2 m-0 p-0">
                            <input class="form-check-input bg-transparent border-secondary m-0" type="checkbox" name="remember" id="remember" checked style="cursor: pointer;">
                            <label class="form-check-label text-secondary small ms-2" for="remember" style="cursor: pointer; font-size: 13px;">
                                Ingat sesi login
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Utama: Masuk -->
                    <button type="submit" class="btn-primary-action mb-2" id="submitBtn">
                        <span>Masuk ke Dashboard</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>

                    <!-- Tombol Passkey Touch (Khusus Layar HP / Touch) -->
                    <div class="d-block d-md-none mt-2">
                        <button type="button" class="btn-passkey-subtle" id="passkeyTouchBtn" onclick="triggerPasskeyTouch()">
                            <i class="bi bi-fingerprint fs-5"></i>
                            <span>Masuk dengan Sidik Jari</span>
                        </button>
                    </div>

                    <!-- Tombol Passkey untuk Desktop (Subtle) -->
                    <div class="d-none d-md-block mt-2">
                        <button type="button" class="btn-passkey-subtle" onclick="triggerPasskeyTouch()">
                            <i class="bi bi-fingerprint"></i>
                            <span>Masuk dengan Passkey / Biometrik</span>
                        </button>
                    </div>

                </form>

            </div>

            <!-- Footer Navigation & Copyright -->
            <div class="footer-nav">
                <a href="{{ route('portfolio.index') }}">
                    <i class="bi bi-arrow-left"></i> Kembali ke Website Utama
                </a>
            </div>

            <div class="footer-copyright">
                &copy; {{ date('Y') }} Andika Amansyah. Seluruh hak cipta dilindungi.
            </div>

        @endif

    </div>

    <!-- Script Interaktif & WebAuthn / Passkey -->
    <script>
        // Toggle visibilitas kata sandi
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passInput && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                const isPass = passInput.getAttribute('type') === 'password';
                passInput.setAttribute('type', isPass ? 'text' : 'password');
                toggleIcon.className = isPass ? 'bi bi-eye-slash text-info' : 'bi bi-eye';
            });
        }

        function handleRecoverPrompt() {
            alert("Pemulihan Akun:\n\nSilakan periksa email terdaftar Anda (andikaamansyah427@gmail.com) atau gunakan kunci pemulihan darurat dari terminal artisan.");
        }

        // Otentikasi Biometrik Passkey Touch
        async function triggerPasskeyTouch() {
            const btn = document.getElementById('passkeyTouchBtn');
            const originalHtml = btn ? btn.innerHTML : '';

            if (navigator.vibrate) {
                navigator.vibrate([20, 30, 20]);
            }

            try {
                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Menghubungkan sensor...`;
                }

                if (!window.PublicKeyCredential) {
                    throw new Error('Perangkat ini belum mendukung WebAuthn biometrik.');
                }

                const challengeRes = await fetch("{{ route('admin.login.passkey.challenge') }}", {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (!challengeRes.ok) throw new Error('Gagal melakukan handshake dengan server.');
                const challengeData = await challengeRes.json();

                const isPlatformAvailable = await PublicKeyCredential.isUserVerifyingPlatformAuthenticatorAvailable();
                if (isPlatformAvailable) {
                    const randomBuffer = new Uint8Array(32);
                    window.crypto.getRandomValues(randomBuffer);

                    await navigator.credentials.get({
                        publicKey: {
                            challenge: randomBuffer,
                            timeout: 60000,
                            userVerification: "preferred",
                            rpId: window.location.hostname
                        }
                    }).catch(e => console.log("Biometric prompt fallback:", e));
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const rememberMe = document.getElementById('remember')?.checked ?? true;

                const loginRes = await fetch("{{ route('admin.login.passkey') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        remember: rememberMe,
                        device: 'mobile-touch-biometric'
                    })
                });

                const result = await loginRes.json();
                if (result.success) {
                    if (btn) {
                        btn.innerHTML = `<i class="bi bi-check2-circle text-success me-2"></i> Berhasil! Mengalihkan...`;
                    }
                    if (navigator.vibrate) navigator.vibrate(40);
                    window.location.href = result.redirect;
                } else {
                    throw new Error(result.message || 'Verifikasi biometrik gagal.');
                }
            } catch (err) {
                console.error("Passkey Touch error:", err);
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
                alert(err.message || 'Gagal memverifikasi sidik jari.');
            }
        }
    </script>
</body>
</html>
