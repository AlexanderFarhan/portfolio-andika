<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\ContactMessage;

class AuthController extends Controller
{
    /**
     * Show admin login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

        // Brute-force protection: rate limit up to 5 attempts
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
        $timeString = now()->timezone('Asia/Jakarta')->format('d M Y, H:i:s') . ' WIB';

        // 1. Log security warning
        Log::warning("Unauthorized admin login attempt: Email: {$attemptedEmail}, IP: {$ip}, UA: {$userAgent}");

        // 2. Record security alert in contact_messages as high-priority real-time message
        try {
            ContactMessage::create([
                'name' => '⚠️ Sistem Keamanan (Security Alert)',
                'email' => 'security-alert@andika.dev',
                'phone' => null,
                'subject' => "🚨 Percobaan Menerobos Masuk Admin ({$attemptedEmail})",
                'message' => "Terdeteksi percobaan login tidak sah / gagal masuk ke Admin Portal.\n\nDetail Percobaan:\n- Email Percobaan: {$attemptedEmail}\n- Alamat IP Pengakses: {$ip}\n- Perangkat / Browser: {$userAgent}\n- Waktu Deteksi: {$timeString}\n- Status: Ditolak oleh sistem otentikasi.",
                'is_read' => false,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to log security message: ' . $e->getMessage());
        }

        // 3. Send email alert to andikaamansyah427@gmail.com
        try {
            $alertRecipient = 'andikaamansyah427@gmail.com';
            $alertSubject = "🚨 [PERINGATAN KEAMANAN] Percobaan Masuk Ilegal Terdeteksi di Admin Portfolio";
            $alertBody = "Halo Andika Amansyah,\n\nSistem keamanan portofolio mendeteksi aktivitas mencurigakan: seseorang mencoba memaksa/menerobos masuk ke halaman Admin Portal dengan kredensial yang tidak sah.\n\nDetail Aktivitas:\n- Email yang digunakan: {$attemptedEmail}\n- Alamat IP: {$ip}\n- Perangkat / User-Agent: {$userAgent}\n- Waktu Kejadian: {$timeString}\n- Status Akses: DITOLAK (Unauthorized)\n\nJika ini bukan Anda, pastikan kredensial admin Anda tetap aman dan tidak dibagikan kepada siapapun.\n\nSalam hangat,\nSistem Keamanan Portfolio Andika";

            Mail::raw($alertBody, function ($mail) use ($alertRecipient, $alertSubject) {
                $mail->to($alertRecipient)
                     ->subject($alertSubject);
            });
        } catch (\Throwable $e) {
            Log::error('Failed to send security alert email: ' . $e->getMessage());
        }

        return back()->withErrors([
            'email' => 'Kredensial login yang Anda masukkan tidak sesuai.',
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
