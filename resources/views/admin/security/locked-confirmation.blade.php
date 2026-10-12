<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Keamanan Admin | Portfolio Andika Amansyah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3" style="background: radial-gradient(circle at 50% 20%, #1e1b4b 0%, #0a0f1d 85%); color: #f1f5f9;">
    <div class="card glass-card border-subtle shadow-lg p-4 p-sm-5 text-center" style="max-width: 520px; width: 100%; border-radius: 20px;">
        @if($success ?? false)
            <!-- Lock success icon -->
            <div class="mb-4">
                <div class="d-inline-flex p-4 rounded-circle bg-danger bg-opacity-15 text-danger border border-danger border-opacity-30 shadow-lg" style="animation: pulse 2s infinite;">
                    <i class="bi bi-shield-slash-fill" style="font-size: 3.5rem;"></i>
                </div>
            </div>

            <div class="badge bg-danger bg-opacity-25 text-danger border border-danger border-opacity-40 px-3 py-2 text-uppercase fw-bold letter-spacing-1 mb-3">
                <i class="bi bi-lock-fill me-1"></i> Status: Lockdown Darurat Aktif
            </div>

            <h2 class="h3 fw-bold font-heading mb-2 text-white">
                Admin Berhasil Dikunci!
            </h2>

            <p class="text-subtle small mb-4" style="line-height: 1.6;">
                Permintaan penguncian jarak jauh melalui email telah <strong>diterapkan ke seluruh sistem secara real-time</strong>. Siapapun yang mengakses halaman admin sekarang akan diblokir oleh sistem verifikasi keamanan darurat.
            </p>

            <div class="alert alert-dark border-subtle text-start p-3 mb-4 rounded-3" style="background-color: rgba(15, 23, 42, 0.7);">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-envelope-check text-info fs-5 me-2"></i>
                    <span class="small fw-bold text-white">Kode Verifikasi (OTP) Dikirim:</span>
                </div>
                <p class="small text-subtle mb-0">
                    Sistem telah mengirimkan 6-digit kode verifikasi ke email pemilik: <strong class="text-info">andikaamansyah427@gmail.com</strong> untuk membuka portal saat Anda siap.
                </p>
                @if(!empty($otpHint))
                    <div class="mt-2 pt-2 border-top border-secondary border-opacity-25 small text-warning">
                        <i class="bi bi-info-circle me-1"></i> Mode Pengujian (Debug OTP): <span class="badge bg-warning text-dark font-monospace fs-6">{{ $otpHint }}</span>
                    </div>
                @endif
            </div>

            <div class="d-grid gap-2 mb-3">
                <a href="{{ route('admin.login') }}" class="btn btn-primary-custom py-2 fw-semibold">
                    <i class="bi bi-arrow-right-circle me-1"></i> Buka Halaman Admin (Masukkan OTP)
                </a>
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline-secondary py-2 small border-subtle text-subtle">
                    <i class="bi bi-house me-1"></i> Kembali ke Website Utama
                </a>
            </div>
        @else
            <!-- Failed / Invalid token icon -->
            <div class="mb-4">
                <div class="d-inline-flex p-4 rounded-circle bg-warning bg-opacity-15 text-warning border border-warning border-opacity-30">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 3.5rem;"></i>
                </div>
            </div>

            <h2 class="h4 fw-bold font-heading mb-2 text-white">
                Tautan Tidak Valid atau Kedaluwarsa
            </h2>

            <p class="text-subtle small mb-4">
                {{ $message ?? 'Tautan penguncian darurat ini tidak dapat diproses. Mungkin telah kedaluwarsa atau sudah pernah digunakan.' }}
            </p>

            <div class="d-grid gap-2">
                <a href="{{ route('admin.login') }}" class="btn btn-primary-custom py-2">
                    <i class="bi bi-shield-lock me-1"></i> Menuju Halaman Admin
                </a>
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline-secondary py-2 small border-subtle text-subtle">
                    <i class="bi bi-house me-1"></i> Kembali ke Website Utama
                </a>
            </div>
        @endif
    </div>

    <style>
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 16px rgba(239, 68, 68, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }
    </style>
</body>
</html>
