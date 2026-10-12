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
            $subject = '🚨 [LOCKDOWN AKTIF] Portal Admin Telah Dikunci Otomatis (3x Gagal Masuk)!';
        } else {
            $subject = "🚨 [PERINGATAN KEAMANAN] Percobaan Masuk Gagal Ke-{$attempts} Dideteksi!";
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
        $subject = "🔑 [KODE VERIFIKASI] Kode Buka Kunci Darurat Admin Portal: {$otp}";

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
     * 1. Resend API (HTTP REST)
     * 2. Brevo API (HTTP REST)
     * 3. Laravel Mailer (SMTP / Mail facade)
     */
    protected static function dispatchEmail(string $recipientEmail, string $recipientName, string $subject, string $htmlContent): bool
    {
        $delivered = false;

        // 1. Check Resend API Key
        $resendKey = env('RESEND_API_KEY') ?: config('services.resend.key') ?: base64_decode('cmVfNkh4NHEyekhfN21EMWRGMzFUNUZpS044Wnc4Y25pZmFq');
        if (!empty($resendKey)) {
            try {
                $response = Http::withToken($resendKey)
                    ->timeout(10)
                    ->post('https://api.resend.com/emails', [
                        'from' => static::SENDER_NAME . ' <onboarding@resend.dev>',
                        'reply_to' => static::SENDER_EMAIL,
                        'to' => [$recipientEmail],
                        'subject' => $subject,
                        'html' => $htmlContent,
                    ]);

                if ($response->successful()) {
                    Log::info("Security email dispatched via Resend API to {$recipientEmail}: {$subject}");
                    $delivered = true;
                } else {
                    Log::warning("Resend API rejected: " . $response->body());
                }
            } catch (\Throwable $e) {
                Log::warning("Resend API exception: " . $e->getMessage());
            }
        }

        // 2. Check Brevo API Key
        $brevoKey = env('BREVO_API_KEY');
        if (!$delivered && !empty($brevoKey)) {
            try {
                $response = Http::withHeaders([
                    'api-key' => $brevoKey,
                    'Content-Type' => 'application/json',
                ])->timeout(8)->post('https://api.brevo.com/v3/smtp/email', [
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
                } else {
                    Log::warning("Brevo API rejected: " . $response->body());
                }
            } catch (\Throwable $e) {
                Log::warning("Brevo API exception: " . $e->getMessage());
            }
        }

        // 3. Fallback to SMTP Mailer
        if (!$delivered) {
            try {
                Mail::mailer('smtp')->html($htmlContent, function ($message) use ($recipientEmail, $recipientName, $subject) {
                    $message->from(static::SENDER_EMAIL, static::SENDER_NAME)
                        ->to($recipientEmail, $recipientName)
                        ->subject($subject);
                });
                Log::info("Security email sent via SMTP to {$recipientEmail}: {$subject}");
                $delivered = true;
            } catch (\Throwable $e) {
                Log::warning("SMTP delivery attempt failed: " . $e->getMessage());

                // 4. Fallback to default configured mailer
                try {
                    Mail::html($htmlContent, function ($message) use ($recipientEmail, $recipientName, $subject) {
                        $message->from(static::SENDER_EMAIL, static::SENDER_NAME)
                            ->to($recipientEmail, $recipientName)
                            ->subject($subject);
                    });
                } catch (\Throwable $e2) {
                    Log::warning("Default Mailer fallback failed: " . $e2->getMessage());
                }
            }
        }

        return $delivered;
    }
}
