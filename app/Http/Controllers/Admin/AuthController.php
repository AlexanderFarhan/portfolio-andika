<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\AdminLockdown;
use App\Services\SecurityMailService;

class AuthController extends Controller
{
    /**
     * Show admin login page or emergency lockdown screen if locked.
     */
    public function showLogin()
    {
        $isLocked = AdminLockdown::isLocked();
        $lockdown = $isLocked ? AdminLockdown::instance() : null;

        if (Auth::check()) {
            if ($isLocked) {
                Auth::logout();
            } else {
                return redirect()->route('admin.dashboard');
            }
        }

        return view('admin.auth.login', [
            'isLocked' => $isLocked,
            'lockdown' => $lockdown,
        ]);
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        // Check if admin portal is under emergency lockdown
        if (AdminLockdown::isLocked()) {
            return back()->withErrors([
                'email' => 'Halaman admin saat ini dalam status TERKUNCI (LOCKDOWN). Masukkan kode verifikasi OTP untuk membuka akses.',
            ])->onlyInput('email');
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

        // Rate limit: 5 attempts per window
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login gagal. Demi keamanan, akun terkunci sementara. Coba lagi dalam {$seconds} detik.",
            ])->onlyInput('email');
        }

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        // Increment failed attempt counter
        RateLimiter::hit($throttleKey, 300);

        // Security Intrusion Tracking
        $attemptedEmail = (string) $credentials['email'];
        $ip = $request->ip() ?? 'Unknown IP';
        $userAgent = $request->userAgent() ?? 'Unknown Browser';

        // 1. Log security warning in system logs
        Log::warning("Unauthorized admin login attempt: Email: {$attemptedEmail}, IP: {$ip}, UA: {$userAgent}");

        // 2. Prepare remote lock token in AdminLockdown state
        $lockdown = AdminLockdown::registerFailedAttempt($attemptedEmail, $ip, $userAgent);
        $remoteLockUrl = route('admin.security.remote-lock', ['token' => $lockdown->lock_token]);

        // 3. Dispatch security alert email to andikaamansyah427@gmail.com with remote lock button
        try {
            SecurityMailService::sendSecurityAlert($attemptedEmail, $ip, $userAgent, $remoteLockUrl);
        } catch (\Throwable $e) {
            Log::error('Failed to dispatch security alert email: ' . $e->getMessage());
        }

        return back()->withErrors([
            'email' => 'Kredensial login yang Anda masukkan tidak sesuai. Peringatan keamanan telah dikirimkan ke email pemilik.',
        ])->onlyInput('email');
    }

    /**
     * Log the admin out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah berhasil keluar (logged out).');
    }
}
