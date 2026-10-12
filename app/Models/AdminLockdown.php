<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdminLockdown extends Model
{
    protected $table = 'admin_lockdowns';

    protected $fillable = [
        'is_locked',
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
     * Prepare or update state on a failed unauthorized login attempt.
     */
    public static function registerFailedAttempt(string $email, string $ip, string $ua): self
    {
        $instance = static::instance();
        $token = Str::random(48);

        $instance->update([
            'lock_token' => $token,
            'attempted_email' => $email,
            'ip_address' => $ip,
            'user_agent' => $ua,
            'last_alert_sent_at' => now(),
        ]);

        return $instance;
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
