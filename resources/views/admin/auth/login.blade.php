<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Portfolio Andika Amansyah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3" style="background: radial-gradient(circle at 50% 20%, #1e293b 0%, #0a0f1d 80%);">
    <div class="card glass-card border-subtle shadow-lg p-4 p-sm-5" style="max-width: 440px; width: 100%;">
        <div class="text-center mb-4">
            <div class="d-inline-flex p-3 rounded-circle bg-primary bg-opacity-10 text-primary mb-3">
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
            <h2 class="h3 fw-bold font-heading mb-1">Admin Portal</h2>
            <p class="text-subtle small">Masuk untuk mengelola portofolio &amp; pesan kontak Andika Amansyah</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success py-2 small mb-3">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                <i class="bi bi-exclamation-triangle me-1"></i> {{ $errors->first() }}
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
</body>
</html>
