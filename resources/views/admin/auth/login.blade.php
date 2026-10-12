<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($isLocked ?? false) ? '🚨 Halaman Terkunci (Lockdown)' : 'Login Admin' }} | Portfolio Andika Amansyah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3" style="background: radial-gradient(circle at 50% 20%, {{ ($isLocked ?? false) ? '#2e1020 0%, #0a0814 85%' : '#1e293b 0%, #0a0f1d 80%' }}); color: #f1f5f9;">

    @if($isLocked ?? false)
        <!-- ========================================== -->
        <!-- POP-UP / SCREEN VERIFIKASI LOCKDOWN DARURAT -->
        <!-- ========================================== -->
        <div class="card glass-card shadow-lg p-4 p-sm-5 border border-danger border-opacity-30" style="max-width: 480px; width: 100%; border-radius: 20px; animation: modalFadeIn 0.3s ease-out;">
            <div class="text-center mb-4">
                <div class="d-inline-flex p-3 rounded-circle bg-danger bg-opacity-15 text-danger border border-danger border-opacity-30 mb-3" style="animation: sirenPulse 2s infinite;">
                    <i class="bi bi-shield-slash-fill fs-1"></i>
                </div>
                <div class="badge bg-danger bg-opacity-25 text-danger border border-danger border-opacity-40 px-3 py-1 mb-2 text-uppercase fw-bold letter-spacing-1">
                    <i class="bi bi-lock-fill me-1"></i> Status: Lockdown Darurat
                </div>
                <h2 class="h4 fw-bold font-heading mb-1 text-white">Halaman Admin Terkunci</h2>
                <p class="text-subtle small mb-0">Portal dikunci demi perlindungan keamanan web Anda.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success py-2 small mb-3">
                    <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') ?? $errors->first() }}
                </div>
            @endif

            <div class="alert alert-dark border-subtle p-3 mb-4 rounded-3" style="background-color: rgba(15, 23, 42, 0.7); font-size: 13px;">
                <div class="d-flex align-items-start">
                    <i class="bi bi-info-circle text-info fs-5 me-2 mt-n1"></i>
                    <div>
                        Masukkan <strong>6-digit Kode Verifikasi (OTP)</strong> yang dikirimkan ke email pemilik:
                        <div class="text-info fw-bold mt-1">andikaamansyah427@gmail.com</div>
                    </div>
                </div>
            </div>

            <!-- Form Verifikasi OTP -->
            <form action="{{ route('admin.security.verify-otp') }}" method="POST" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="otp" class="form-label small fw-semibold text-subtle text-center d-block mb-2">
                        Masukkan 6-Digit Kode Verifikasi
                    </label>
                    <input type="text" name="otp" id="otp" 
                           class="form-control form-control-custom text-center fw-bold font-monospace fs-3 py-2 text-info"
                           placeholder="000000" maxlength="6" inputmode="numeric" pattern="[0-9]{6}" required autofocus
                           style="letter-spacing: 8px;">
                </div>

                <button type="submit" class="btn btn-danger w-100 py-2 fw-bold mb-2 shadow-sm">
                    <i class="bi bi-unlock-fill me-1"></i> Verifikasi &amp; Buka Halaman Admin
                </button>
            </form>

            <!-- Form Kirim Ulang OTP -->
            <form action="{{ route('admin.security.resend-otp') }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="btn btn-outline-secondary w-100 py-2 small border-subtle text-subtle">
                    <i class="bi bi-arrow-clockwise me-1"></i> Kirim Ulang Kode OTP ke Email
                </button>
            </form>

            <div class="text-center">
                <a href="{{ route('portfolio.index') }}" class="small text-subtle text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Kembali ke Website Utama
                </a>
            </div>
        </div>

    @else
        <!-- ========================================== -->
        <!-- FORM LOGIN ADMIN NORMAL                     -->
        <!-- ========================================== -->
        <div class="card glass-card border-subtle shadow-lg p-4 p-sm-5" style="max-width: 440px; width: 100%; border-radius: 20px;">
            <div class="text-center mb-4">
                <div class="d-inline-flex p-3 rounded-circle bg-primary bg-opacity-10 text-primary mb-3">
                    <i class="bi bi-shield-lock-fill fs-2"></i>
                </div>
                <h2 class="h3 fw-bold font-heading mb-1 text-white">Admin Portal</h2>
                <p class="text-subtle small mb-0">Masuk untuk mengelola portofolio &amp; pesan kontak Andika Amansyah</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success py-2 small mb-3">
                    <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') ?? $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-subtle">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-subtle text-subtle"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control form-control-custom @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="password" class="form-label small fw-semibold text-subtle">Password</label>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-subtle text-subtle"><i class="bi bi-key"></i></span>
                        <input type="password" name="password" id="password" class="form-control form-control-custom @error('password') is-invalid @enderror" required placeholder="Masukkan password" value="">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label small text-subtle" for="remember">
                            Ingat Saya
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-custom w-100 py-2 mb-3">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk ke Dashboard
                </button>

                <div class="text-center">
                    <a href="{{ route('portfolio.index') }}" class="small text-subtle text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Kembali ke Website Utama
                    </a>
                </div>
            </form>
        </div>
    @endif

    <style>
        @keyframes sirenPulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 14px rgba(239, 68, 68, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(12px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>
</body>
</html>
