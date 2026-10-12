<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringatan Keamanan Admin</title>
</head>
<body style="margin: 0; padding: 0; background-color: #050811; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #f1f5f9;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #050811; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width: 600px; background-color: #0b1329; border: 1px solid #1e293b; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 28px 32px; background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%); border-bottom: 1px solid #1e293b; text-align: center;">
                            @if($isAutoLocked ?? false)
                                <div style="display: inline-block; padding: 10px 18px; background-color: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.5); border-radius: 999px; color: #ef4444; font-size: 13px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">
                                    🚨 SISTEM DIKUNCI OTOMATIS (3X GAGAL)
                                </div>
                                <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">
                                    Portal Admin Telah Terkunci
                                </h1>
                            @else
                                <div style="display: inline-block; padding: 10px 18px; background-color: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.4); border-radius: 999px; color: #f59e0b; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">
                                    ⚠️ PERCOBAAN GAGAL KE-{{ $attempts ?? 1 }} DARI 3
                                </div>
                                <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">
                                    Upaya Masuk Tidak Sah Terdeteksi
                                </h1>
                            @endif
                            <p style="margin: 8px 0 0; font-size: 14px; color: #94a3b8;">
                                Sistem Keamanan Portofolio Andika Amansyah
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 32px;">
                            <p style="margin: 0 0 18px; font-size: 15px; line-height: 1.6; color: #cbd5e1;">
                                Halo <strong>Andika Amansyah</strong>,
                            </p>

                            @if($isAutoLocked ?? false)
                                <div style="background-color: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.35); border-radius: 12px; padding: 18px; margin-bottom: 24px; color: #fca5a5; font-size: 14px; line-height: 1.6;">
                                    <strong>🚨 PERINGATAN DARURAT:</strong> Terdeteksi <strong>3 kali percobaan login gagal berturut-turut</strong> ke halaman Admin Portal. Sesuai aturan keamanan ketat, sistem web saat ini telah <strong>DIKUNCI TOTAL SECARA OTOMATIS</strong>. Kode OTP verifikasi untuk membuka portal telah dikirimkan secara terpisah ke email ini.
                                </div>
                            @else
                                <p style="margin: 0 0 24px; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
                                    Sistem keamanan mendeteksi upaya login gagal ke-<strong>{{ $attempts ?? 1 }}</strong> ke halaman <strong>Admin Portal</strong>. Upaya akses ini telah <strong style="color: #ef4444;">DITOLAK</strong>. Tersisa <strong style="color: #f59e0b;">{{ max(0, 3 - ($attempts ?? 1)) }} kali kesempatan lagi</strong> sebelum portal admin dikunci secara otomatis oleh sistem.
                                </p>
                            @endif

                            <!-- Incident Details Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #070d1e; border: 1px solid #1e293b; border-radius: 12px; margin-bottom: 28px;">
                                <tr>
                                    <td style="padding: 18px 20px;">
                                        <div style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">
                                            Detail Percobaan Akses:
                                        </div>
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="6" style="font-size: 13px;">
                                            <tr>
                                                <td width="35%" style="color: #94a3b8; font-weight: 600;">Email Target:</td>
                                                <td style="color: #f1f5f9; font-family: monospace;">{{ $attemptedEmail }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #94a3b8; font-weight: 600;">Alamat IP:</td>
                                                <td style="color: #f1f5f9; font-family: monospace;">{{ $ip }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #94a3b8; font-weight: 600;">Perangkat:</td>
                                                <td style="color: #f1f5f9; word-break: break-all;">{{ $userAgent }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #94a3b8; font-weight: 600;">Waktu:</td>
                                                <td style="color: #f1f5f9;">{{ $timeString }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #94a3b8; font-weight: 600;">Status Portal:</td>
                                                <td style="color: {{ ($isAutoLocked ?? false) ? '#ef4444' : '#f59e0b' }}; font-weight: 700;">
                                                    {{ ($isAutoLocked ?? false) ? '🔒 TERKUNCI OTOMATIS (LOCKDOWN)' : '⚠️ WASPADA (GAGAL KE-' . ($attempts ?? 1) . ')' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            @if($isAutoLocked ?? false)
                                <div style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.12) 0%, rgba(30, 64, 175, 0.05) 100%); border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 12px; padding: 22px; text-align: center; margin-bottom: 24px;">
                                    <div style="font-size: 15px; font-weight: 700; color: #38bdf8; margin-bottom: 8px;">
                                        Cara Membuka Kembali Halaman Admin
                                    </div>
                                    <p style="font-size: 13px; color: #cbd5e1; margin: 0 0 18px; line-height: 1.5;">
                                        Buka halaman admin web Anda, pop-up verifikasi darurat akan langsung muncul. Masukkan <strong>6-digit Kode OTP</strong> yang dikirimkan ke email ini untuk membuka portal.
                                    </p>
                                    <a href="https://portfolio-andika-theta.vercel.app/admin/login" target="_blank" style="display: inline-block; background-color: #2563eb; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 800; padding: 14px 28px; border-radius: 8px; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);">
                                        🌐 Buka Halaman Admin (Verifikasi OTP)
                                    </a>
                                </div>
                            @else
                                <!-- Remote Lock Action -->
                                <div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.12) 0%, rgba(185, 28, 28, 0.05) 100%); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 12px; padding: 22px; text-align: center; margin-bottom: 24px;">
                                    <div style="font-size: 15px; font-weight: 700; color: #f87171; margin-bottom: 8px;">
                                        Kunci Web Jarak Jauh (Remote Action)
                                    </div>
                                    <p style="font-size: 13px; color: #cbd5e1; margin: 0 0 18px; line-height: 1.5;">
                                        Jika Anda merasa ada ancaman, Anda tidak perlu menunggu 3 kali gagal. Anda dapat langsung <strong>mengunci halaman admin sekarang</strong> melalui tombol di bawah:
                                    </p>

                                    <a href="{{ $remoteLockUrl }}" target="_blank" style="display: inline-block; background-color: #dc2626; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 800; padding: 14px 28px; border-radius: 8px; box-shadow: 0 4px 14px rgba(220, 38, 38, 0.4); letter-spacing: 0.5px;">
                                        🔒 KUNCI HALAMAN WEB ADMIN SEKARANG
                                    </a>

                                    <p style="font-size: 12px; color: #94a3b8; margin: 14px 0 0;">
                                        Sistem akan otomatis mengunci portal jika percobaan mencapai 3 kali.
                                    </p>
                                </div>
                            @endif
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 32px; background-color: #070d1e; border-top: 1px solid #1e293b; text-align: center; font-size: 12px; color: #64748b;">
                            Dikirim otomatis dari Sistem Keamanan Web: <strong>andikaamansyah31245@gmail.com</strong><br>
                            Tujuan Pemilik: <strong>andikaamansyah427@gmail.com</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
