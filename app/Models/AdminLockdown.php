<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdminLockdown extends Model
{
    protected $table = 'admin_lockdowns';

    protected $fillable = [
        'is_locked',
        'failed_attempts',
        'last_failed_at',
        'lock_token',
        'unlock_otp',
        'otp_expires_at',
        'locked_at',
        'locked_reason',
        'attempted_email',
        'ip_address',
        'user_agent',
        'last_alert_sent_at',
    ];

    protected $casts = [
        'is_locked' => 'boolean',
        'failed_attempts' => 'integer',
        'last_failed_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'locked_at' => 'datetime',
        'last_alert_sent_at' => 'datetime',
    ];

    /**
     * Get or create the singleton lockdown state record.
     */
    public static function instance(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'is_locked' => false,
                'failed_attempts' => 0,
                'lock_token' => Str::random(48),
            ]
        );
    }

    /**
     * Check if the admin portal is currently locked.
     */
    public static function isLocked(): bool
    {
        try {
            $record = static::instance();
            return (bool) $record->is_locked;
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Track failed login attempts.
     * Automatically locks the portal if failed attempts reach 3.
     */
    public static function recordFailedAttempt(string $email, string $ip, string $ua): array
    {
        $instance = static::instance();
        $now = now();

        // Reset failed attempts if last failure was more than 30 minutes ago
        $attempts = (int) $instance->failed_attempts;
        if ($instance->last_failed_at && $instance->last_failed_at->diffInMinutes($now) > 30) {
            $attempts = 0;
        }

        $attempts++;
        $token = Str::random(48);

        $instance->update([
            'failed_attempts' => $attempts,
            'last_failed_at' => $now,
            'lock_token' => $token,
            'attempted_email' => $email,
            'ip_address' => $ip,
            'user_agent' => $ua,
            'last_alert_sent_at' => $now,
        ]);

        $isAutoLocked = ($attempts >= 3);
        $otp = null;

        if ($isAutoLocked) {
            $otp = static::lockPortal('Terkunci otomatis karena 3 kali percobaan login gagal berturut-turut');
            $instance->update([
                'failed_attempts' => 0,
            ]);
        }

        return [
            'attempts' => $attempts,
            'remaining' => max(0, 3 - $attempts),
            'is_locked' => $isAutoLocked,
            'otp' => $otp,
            'lock_token' => $token,
        ];
    }

    /**
     * Reset failed attempts upon successful login.
     */
    public static function resetFailedAttempts(): void
    {
        try {
            static::instance()->update([
                'failed_attempts' => 0,
                'last_failed_at' => null,
            ]);
        } catch (\Throwable $e) {
            // Ignore offline errors
        }
    }

    /**
     * Activate emergency lock.
     */
    public static function lockPortal(string $reason = 'Dikunci dari jarak jauh melalui email keamanan'): string
    {
        $instance = static::instance();
        $otp = sprintf('%06d', mt_rand(100000, 999999));

        $instance->update([
            'is_locked' => true,
            'locked_at' => now(),
            'locked_reason' => $reason,
            'unlock_otp' => $otp,
            'otp_expires_at' => now()->addMinutes(30),
            'failed_attempts' => 0,
        ]);

        return $otp;
    }

    /**
     * Regenerate OTP for unlocking.
     */
    public static function regenerateOtp(): string
    {
        $instance = static::instance();
        $otp = sprintf('%06d', mt_rand(100000, 999999));

        $instance->update([
            'unlock_otp' => $otp,
            'otp_expires_at' => now()->addMinutes(30),
        ]);

        return $otp;
    }

    /**
     * Verify OTP and unlock portal.
     */
    public static function verifyAndUnlock(string $code): bool
    {
        $instance = static::instance();

        if (!$instance->is_locked) {
            return true;
        }

        $trimmed = trim($code);
        if (empty($trimmed) || empty($instance->unlock_otp)) {
            return false;
        }

        // Compare OTP code
        if ($instance->unlock_otp === $trimmed) {
            if ($instance->otp_expires_at && $instance->otp_expires_at->isPast()) {
                return false;
            }

            $instance->update([
                'is_locked' => false,
                'failed_attempts' => 0,
                'unlock_otp' => null,
                'otp_expires_at' => null,
                'locked_at' => null,
                'locked_reason' => null,
                'lock_token' => Str::random(48),
            ]);

            return true;
        }

        return false;
    }
}
