<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminLockdown;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminNotLocked
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (AdminLockdown::isLocked()) {
            if (Auth::check()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return redirect()->route('admin.login')
                ->with('error', 'Halaman admin saat ini dalam status TERKUNCI (LOCKDOWN). Masukkan kode verifikasi OTP untuk membuka akses.');
        }

        return $next($request);
    }
}
