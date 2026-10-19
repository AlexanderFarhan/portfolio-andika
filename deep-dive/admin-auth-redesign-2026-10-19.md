# Deep Dive: Admin Terminal Redesign & Passkey Touch (WebAuthn) Architecture
**Date:** 2026-10-19  
**Target:** `resources/views/admin/auth/login.blade.php`, `app/Http/Controllers/Admin/AuthController.php`, `routes/web.php`  
**Mode:** Compact (AntiVibe Framework)

---

## 1. Overview
Dokumen ini mendokumentasikan refaktor tampilan login admin dari template generic "AI-look" menjadi antarmuka **Architectural Industrial Terminal** bertaraf enterprise, sekaligus penambahan fitur autentikasi biometrik **Passkey Touch (WebAuthn)** khusus perangkat seluler (HP).

### Mengapa Perubahan Ini Dibuat?
1. **Eliminasi "AI-look" Clichés:** Menghapus gradasi kosmik ungu/sian yang generik, efek kaca (*glassmorphism*) buram yang berlebihan, dan elemen melayang tanpa struktur grid. Menggantinya dengan rasio grid presisi 32px, tipografi monospaced teknikal, dan status telemetri nyata (*Zero-Trust Environment*, *Cluster Status*, *Throughput Wave*).
2. **Kebutuhan Akses Cepat di HP:** Admin yang sering memantau portofolio lewat ponsel tidak perlu mengetik kata sandi panjang secara manual. Fitur **Passkey Touch** memanfaatkan sensor biometrik bawaan HP (Touch ID / Fingerprint / Face ID) via W3C Web Authentication API (`navigator.credentials`).

---

## 2. Key Components & Architecture

### A. Dual-Layout Responsive Architecture
- **Desktop (Split 60/40):** Sisi kiri menampilkan *infrastructure canvas* (Cluster status, latency global, metrik branch, dan visualisasi *dynamic throughput wave*). Sisi kanan merupakan *terminal console* otentikasi.
- **Mobile (< 992px):** Berubah otomatis menjadi *grounded terminal card* tunggal yang ringkas dengan header *Console Mobile Node v2.4*, banner *Strict Access Zone*, baris *Session ID*, serta tombol khusus **WebAuthn / Passkey Touch**.

### B. Biometric WebAuthn (Passkey Touch) Flow
```
[User HP: Tap 'Passkey Touch']
           │
           ▼
[Check PublicKeyCredential Support & Haptic Touch]
           │
           ▼
[GET /admin/passkey/challenge] ─── Server generates 32-byte crypto challenge
           │
           ▼
[Browser prompts Native Fingerprint Sensor Dialog]
           │
           ▼
[POST /admin/passkey/login] ──── Validates Session & Logins Admin Directly
           │
           ▼
[Redirect to /admin/dashboard with 200 OK]
```

### C. Design Decisions & Trade-offs
1. **Mengapa Membatasi Passkey Touch Utamanya di HP?**
   - Layar sentuh seluler secara *default* memiliki sensor biometrik terintegrasi (*Platform Authenticator*). Pada desktop tanpa sensor sidik jari, pengguna umumnya lebih memilih kredensial kata sandi atau kunci fisik YubiKey.
2. **Pertahanan Zero-Trust & Emergency Lockdown:**
   - Halaman ini tetap mempertahankan mekanisme *Rate Limiting* (5 percobaan) dan proteksi *3-Strikes Auto-Lockdown* dengan verifikasi OTP darurat jika terjadi percobaan brute-force.
3. **Optimasi Asset Vite & Tailwind/Bootstrap:**
   - Menggunakan token CSS natif di dalam Blade view untuk memastikan rendering instan tanpa ketergantungan class dinamis yang berpotensi ter-purge oleh build production.
