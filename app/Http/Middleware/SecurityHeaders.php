<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and apply production-grade security headers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1. Prevent Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // 2. Prevent MIME-type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 3. Control referrer information leaked in HTTP requests
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 4. Restrict dangerous browser features and device hardware APIs
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=(), usb=()'
        );

        // 5. Content Security Policy (CSP)
        // Balanced to allow self-hosted assets, Google Fonts, and inline scripts/styles needed by Vite & Bootstrap
        $csp = "default-src 'self'; "
            . "script-src 'self' 'unsafe-inline' 'unsafe-eval'; "
            . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
            . "font-src 'self' https://fonts.gstatic.com data:; "
            . "img-src 'self' data: https:; "
            . "connect-src 'self' https:; "
            . "frame-ancestors 'self'; "
            . "form-action 'self'; "
            . "base-uri 'self';";

        $response->headers->set('Content-Security-Policy', $csp);

        // 6. Remove sensitive backend disclosure headers
        $response->headers->remove('X-Powered-By');
        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
        }

        return $response;
    }
}
