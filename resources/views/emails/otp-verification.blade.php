<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi Buka Kunci Admin</title>
</head>
<body style="margin: 0; padding: 0; background-color: #050811; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #f1f5f9;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #050811; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width: 600px; background-color: #0b1329; border: 1px solid #1e293b; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 28px 32px; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); border-bottom: 1px solid #1e293b; text-align: center;">
                            <div style="display: inline-block; padding: 10px 18px; background-color: rgba(56, 189, 248, 0.15); border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 999px; color: #38bdf8; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;">
                                🔐 KODE VERIFIKASI KEAMANAN
                            </div>
                            <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">
                                Buka Kunci Darurat Admin Portal
                            </h1>
                            <p style="margin: 8px 0 0; font-size: 14px; color: #94a3b8;">
                                Sistem Keamanan Portofolio Andika Amansyah
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 32px;">
                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.6; color: #cbd5e1;">
                                Halo <strong>Andika Amansyah</strong>,
                            </p>
                            <p style="margin: 0 0 24px; font-size: 14px; line-height: 1.6; color: #cbd5e1;">
                                Halaman web <strong>Admin Portal</strong> Anda saat ini dalam status <strong style="color: #ef4444;">TERKUNCI (LOCKDOWN)</strong>. Untuk memverifikasi identitas Anda dan membuka kembali akses ke halaman admin, gunakan 6-digit Kode Verifikasi (OTP) berikut:
                            </p>

                            <!-- Big OTP Code Box -->
                            <div style="background-color: #070d1e; border: 2px dashed #38bdf8; border-radius: 14px; padding: 24px; text-align: center; margin-bottom: 24px;">
                                <div style="font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">
                                    KODE VERIFIKASI SATU KALI PAKAI (OTP)
                                </div>
                                <div style="font-size: 42px; font-weight: 900; letter-spacing: 12px; color: #38bdf8; font-family: 'Courier New', Courier, monospace; margin: 10px 0;">
                                    {{ $otp }}
                                </div>
                                <div style="font-size: 12px; color: #fbbf24; margin-top: 6px;">
                                    ⏰ Berlaku selama 30 menit dari waktu pengiriman ({{ $timeString }})
                                </div>
                            </div>

                            <p style="font-size: 13px; line-height: 1.6; color: #94a3b8; margin: 0 0 24px;">
                                <strong>Langkah Selanjutnya:</strong> Buka halaman login admin di web portofolio Anda, pop-up verifikasi darurat akan otomatis muncul. Masukkan 6-digit angka di atas pada kolom yang tersedia lalu klik <em>Verifikasi &amp; Buka Kunci</em>.
                            </p>

                            <!-- Action button -->
                            <div style="text-align: center; margin-bottom: 20px;">
                                <a href="{{ $adminUrl }}" target="_blank" style="display: inline-block; background-color: #2563eb; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 700; padding: 12px 28px; border-radius: 8px; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);">
                                    🌐 Buka Halaman Admin Sekarang
                                </a>
                            </div>

                            <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.5; text-align: center;">
                                ⚠️ Jangan bagikan kode verifikasi ini kepada siapapun demi keamanan akun Anda.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 32px; background-color: #070d1e; border-top: 1px solid #1e293b; text-align: center; font-size: 12px; color: #64748b;">
                            Dikirim oleh Sistem Keamanan Web: <strong>andikaamansyah31245@gmail.com</strong><br>
                            Penerima: <strong>andikaamansyah427@gmail.com</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
