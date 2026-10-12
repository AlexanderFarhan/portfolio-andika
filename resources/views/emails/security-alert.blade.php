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
                            <div style="display: inline-block; padding: 10px 18px; background-color: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); border-radius: 999px; color: #ef4444; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">
                                🚨 PERINGATAN SISTEM KEAMANAN
                            </div>
                            <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">
                                Upaya Masuk Paksa Terdeteksi
                            </h1>
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
                            <p style="margin: 0 0 24px; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
                                Sistem keamanan mendeteksi upaya login tidak sah atau percobaan menerobos masuk ke halaman <strong>Admin Portal</strong> web portofolio Anda. Upaya akses ini telah <strong style="color: #ef4444;">DITOLAK</strong> oleh sistem otentikasi.
                            </p>

                            <!-- Incident Details Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #070d1e; border: 1px solid #1e293b; border-radius: 12px; margin-bottom: 28px;">
                                <tr>
                                    <td style="padding: 18px 20px;">
                                        <div style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">
                                            Detail Aktivitas Yang Terdeteksi:
                                        </div>
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="6" style="font-size: 13px;">
                                            <tr>
                                                <td width="35%" style="color: #94a3b8; font-weight: 600;">Target Email:</td>
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
                                                <td style="color: #94a3b8; font-weight: 600;">Waktu Deteksi:</td>
                                                <td style="color: #f1f5f9;">{{ $timeString }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #94a3b8; font-weight: 600;">Status Akses:</td>
                                                <td style="color: #ef4444; font-weight: 700;">BLOCKED / UNAUTHORIZED</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Remote Lock Action -->
                            <div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.12) 0%, rgba(185, 28, 28, 0.05) 100%); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 12px; padding: 22px; text-align: center; margin-bottom: 24px;">
                                <div style="font-size: 15px; font-weight: 700; color: #f87171; margin-bottom: 8px;">
                                    Tindakan Pencegahan Jarak Jauh (Remote Action)
                                </div>
                                <p style="font-size: 13px; color: #cbd5e1; margin: 0 0 18px; line-height: 1.5;">
                                    Jika Anda merasa aktivitas ini mencurigakan, Anda dapat langsung <strong>mengunci halaman web admin</strong> dari jarak jauh melalui tombol di bawah ini:
                                </p>

                                <a href="{{ $remoteLockUrl }}" target="_blank" style="display: inline-block; background-color: #dc2626; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 800; padding: 14px 28px; border-radius: 8px; box-shadow: 0 4px 14px rgba(220, 38, 38, 0.4); letter-spacing: 0.5px;">
                                    🔒 KUNCI HALAMAN WEB ADMIN SEKARANG
                                </a>

                                <p style="font-size: 12px; color: #94a3b8; margin: 14px 0 0;">
                                    Setelah dikunci, siapa pun yang membuka halaman admin akan dihadang oleh pop-up verifikasi darurat dan membutuhkan Kode OTP yang dikirimkan ke email Anda untuk membukanya.
                                </p>
                            </div>

                            <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.5;">
                                *Jika tombol di atas tidak dapat diklik, salin dan buka tautan berikut di peramban Anda:<br>
                                <a href="{{ $remoteLockUrl }}" style="color: #38bdf8; word-break: break-all;">{{ $remoteLockUrl }}</a>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 32px; background-color: #070d1e; border-top: 1px solid #1e293b; text-align: center; font-size: 12px; color: #64748b;">
                            Dikirim otomatis dari Sistem Keamanan: <strong>andikaamansyah31245@gmail.com</strong><br>
                            Tujuan Pemilik: <strong>andikaamansyah427@gmail.com</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
