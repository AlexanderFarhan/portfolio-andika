<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLockdown;
use App\Services\SecurityMailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SecurityController extends Controller
{
    /**
     * Handle remote lock trigger from email link.
     */
    public function remoteLock(Request $request, string $token)
    {
        $lockdown = AdminLockdown::instance();

        // Check if token matches
        if (empty($token) || $lockdown->lock_token !== $token) {
            return view('admin.security.locked-confirmation', [
                'success' => false,
                'message' => 'Tautan penguncian tidak valid, telah kedaluwarsa, atau sudah pernah digunakan sebelumnya.',
                'isLocked' => $lockdown->is_locked,
            ]);
        }

        // Activate lockdown and generate OTP
        $otp = AdminLockdown::lockPortal('Dikunci secara darurat dari jarak jauh melalui link email');

        // Logout any active session
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Send OTP verification code to andikaamansyah427@gmail.com
        try {
            SecurityMailService::sendUnlockOtp($otp, route('admin.login'));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirimkan email OTP: ' . $e->getMessage());
        }

        return view('admin.security.locked-confirmation', [
            'success' => true,
            'message' => 'Halaman Admin Web telah BERHASIL DIKUNCI secara darurat!',
            'isLocked' => true,
            'otpHint' => config('app.debug') ? $otp : null,
        ]);
    }

    /**
     * Verify OTP code submitted from web modal.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string',
        ]);

        $code = (string) $request->input('otp');
        $code = str_replace([' ', '-'], '', $code);

        if (AdminLockdown::verifyAndUnlock($code)) {
            return redirect()->route('admin.login')
                ->with('success', '✅ Verifikasi identitas berhasil! Halaman web admin telah berhasil dibuka kembali.');
        }

        return back()->with('error', 'Kode verifikasi yang Anda masukkan tidak sesuai atau telah kedaluwarsa. Silakan periksa email Anda.');
    }

    /**
     * Resend OTP code to andikaamansyah427@gmail.com.
     */
    public function resendOtp(Request $request)
    {
        $lockdown = AdminLockdown::instance();

        if (!$lockdown->is_locked) {
            return redirect()->route('admin.login')->with('info', 'Halaman admin saat ini tidak sedang terkunci.');
        }

        $otp = AdminLockdown::regenerateOtp();

        try {
            SecurityMailService::sendUnlockOtp($otp, route('admin.login'));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim ulang email OTP: ' . $e->getMessage());
        }

        return back()->with('success', 'Kode verifikasi OTP baru telah dikirimkan ke email andikaamansyah427@gmail.com. Silakan periksa kotak masuk atau spam email Anda.');
    }

    /**
     * Manual emergency lock trigger (for admin testing or instant security).
     */
    public function triggerLock(Request $request)
    {
        $otp = AdminLockdown::lockPortal('Dikunci secara manual oleh administrator');

        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        try {
            SecurityMailService::sendUnlockOtp($otp, route('admin.login'));
        } catch (\Throwable $e) {
            Log::error('Gagal mengirimkan email OTP: ' . $e->getMessage());
        }

        return redirect()->route('admin.login')
            ->with('info', 'Halaman admin telah dikunci secara darurat. Masukkan kode verifikasi dari email untuk membukanya.');
    }

    /**
     * Emergency 1-click unlock helper for site owner.
     */
    public function quickUnlock(Request $request)
    {
        $lockdown = AdminLockdown::instance();
        if ($lockdown->is_locked && !empty($lockdown->unlock_otp)) {
            AdminLockdown::verifyAndUnlock($lockdown->unlock_otp);
            return redirect()->route('admin.login')
                ->with('success', '✅ Halaman admin berhasil dibuka kembali secara darurat.');
        }

        return redirect()->route('admin.login');
    }
}
