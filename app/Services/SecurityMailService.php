<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SecurityMailService
{
    public const SENDER_EMAIL = 'andikaamansyah31245@gmail.com';
    public const SENDER_NAME = 'Sistem Keamanan Portfolio Andika';
    public const RECIPIENT_EMAIL = 'andikaamansyah427@gmail.com';
    public const RECIPIENT_NAME = 'Andika Amansyah';

    /**
     * Send remote-lock security alert email.
     */
    public static function sendSecurityAlert(
        string $attemptedEmail,
        string $ip,
        string $userAgent,
        string $remoteLockUrl,
        int $attempts = 1,
        bool $isAutoLocked = false
    ): bool {
        $timeString = now()->timezone('Asia/Jakarta')->format('d M Y, H:i:s') . ' WIB';

        if ($isAutoLocked) {
            $subject = 'Peringatan Keamanan: Portal Admin Telah Dikunci Otomatis (3x Gagal)';
        } else {
            $subject = "Peringatan Keamanan: Percobaan Masuk Gagal Ke-{$attempts} Dideteksi";
        }

        $htmlContent = view('emails.security-alert', [
            'attemptedEmail' => $attemptedEmail,
            'ip' => $ip,
            'userAgent' => $userAgent,
            'timeString' => $timeString,
            'remoteLockUrl' => $remoteLockUrl,
            'attempts' => $attempts,
            'isAutoLocked' => $isAutoLocked,
        ])->render();

        return static::dispatchEmail(
            static::RECIPIENT_EMAIL,
            static::RECIPIENT_NAME,
            $subject,
            $htmlContent
        );
    }

    /**
     * Send emergency OTP verification email to unlock admin portal.
     */
    public static function sendUnlockOtp(string $otp, string $adminUrl): bool
    {
        $timeString = now()->timezone('Asia/Jakarta')->format('d M Y, H:i:s') . ' WIB';
        $subject = "Kode OTP Buka Kunci Admin: {$otp}";

        $htmlContent = view('emails.otp-verification', [
            'otp' => $otp,
            'timeString' => $timeString,
            'adminUrl' => $adminUrl,
        ])->render();

        return static::dispatchEmail(
            static::RECIPIENT_EMAIL,
            static::RECIPIENT_NAME,
            $subject,
            $htmlContent
        );
    }

    /**
     * Multi-channel email dispatcher:
     * 1. Resend API (cURL with SSL bypass for AWS Lambda/Vercel)
     * 2. Resend API (Guzzle fallback)
     * 3. Brevo API
     * 4. SMTP / Laravel mailer
     */
    protected static function dispatchEmail(string $recipientEmail, string $recipientName, string $subject, string $htmlContent): bool
    {
        $delivered = false;
        $resendKey = env('RESEND_API_KEY') ?: config('services.resend.key') ?: base64_decode('cmVfNkh4NHEyekhfN21EMWRGMzFUNUZpS044Wnc4Y25pZmFq');

        // 1. Direct cURL to Resend API (Bulletproof on Vercel Serverless / AWS Lambda)
        if (!empty($resendKey) && function_exists('curl_init')) {
            try {
                $payload = json_encode([
                    'from' => static::SENDER_NAME . ' <onboarding@resend.dev>',
                    'reply_to' => static::SENDER_EMAIL,
                    'to' => [$recipientEmail],
                    'subject' => $subject,
                    'html' => $htmlContent,
                ]);

                $ch = curl_init('https://api.resend.com/emails');
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $payload,
                    CURLOPT_HTTPHEADER => [
                        'Authorization: Bearer ' . $resendKey,
                        'Content-Type: application/json',
                    ],
                    CURLOPT_TIMEOUT => 15,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                ]);

                $result = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($httpCode >= 200 && $httpCode < 300) {
                    Log::info("Security email delivered via Resend cURL to {$recipientEmail}: {$subject}");
                    $delivered = true;
                } else {
                    Log::warning("Resend cURL HTTP {$httpCode}: " . $result);
                }
            } catch (\Throwable $e) {
                Log::warning("Resend cURL exception: " . $e->getMessage());
            }
        }

        // 2. Laravel Http client fallback
        if (!$delivered && !empty($resendKey)) {
            try {
                $response = Http::withOptions(['verify' => false, 'timeout' => 12])
                    ->withToken($resendKey)
                    ->post('https://api.resend.com/emails', [
                        'from' => static::SENDER_NAME . ' <onboarding@resend.dev>',
                        'reply_to' => static::SENDER_EMAIL,
                        'to' => [$recipientEmail],
                        'subject' => $subject,
                        'html' => $htmlContent,
                    ]);

                if ($response->successful()) {
                    Log::info("Security email dispatched via Resend Http to {$recipientEmail}: {$subject}");
                    $delivered = true;
                }
            } catch (\Throwable $e) {
                Log::warning("Resend Http exception: " . $e->getMessage());
            }
        }

        // 3. Check Brevo API Key
        $brevoKey = env('BREVO_API_KEY');
        if (!$delivered && !empty($brevoKey)) {
            try {
                $response = Http::withOptions(['verify' => false, 'timeout' => 8])
                    ->withHeaders([
                        'api-key' => $brevoKey,
                        'Content-Type' => 'application/json',
                    ])->post('https://api.brevo.com/v3/smtp/email', [
                        'sender' => [
                            'name' => static::SENDER_NAME,
                            'email' => static::SENDER_EMAIL,
                        ],
                        'to' => [
                            ['email' => $recipientEmail, 'name' => $recipientName],
                        ],
                        'subject' => $subject,
                        'htmlContent' => $htmlContent,
                    ]);

                if ($response->successful()) {
                    Log::info("Security email dispatched via Brevo API to {$recipientEmail}: {$subject}");
                    $delivered = true;
                }
            } catch (\Throwable $e) {
                Log::warning("Brevo API exception: " . $e->getMessage());
            }
        }

        // 4. Fallback to SMTP / Mailer
        if (!$delivered) {
            try {
                Mail::mailer('smtp')->html($htmlContent, function ($message) use ($recipientEmail, $recipientName, $subject) {
                    $message->from(static::SENDER_EMAIL, static::SENDER_NAME)
                        ->to($recipientEmail, $recipientName)
                        ->subject($subject);
                });
                $delivered = true;
            } catch (\Throwable $e) {
                Log::warning("SMTP delivery failed: " . $e->getMessage());
            }
        }

        return $delivered;
    }
}
