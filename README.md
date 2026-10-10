# Portfolio Andika Amansyah

> Website Portofolio Interaktif & Sistem Manajemen Konten (CMS) berbasis Laravel 12 & Vite.

---

## 🌟 Fitur Utama

- **Modern Responsive Design**: Antarmuka responsif dengan Bootstrap 5 & Tailwind CSS utility, glassmorphism, dan dark/light mode accents.
- **Dynamic Content**:
  - Profil & About Me dengan metrik interaktif (GPA, Proyek, Pengalaman)
  - Riwayat Pendidikan & Pengalaman Kerja
  - Keahlian teknis (System Analysis, Problem Solving, Web Dev, Networking)
  - Showcase Proyek & Halaman Detail Proyek Interaktif
  - Sertifikasi Profesional & Lisensi
  - Live Contact Form & Pesan Masuk
  - Halaman Cetak/Download CV Online
- **Admin Dashboard CMS** (`/admin`):
  - Autentikasi Admin
  - CRUD Lengkap untuk Profil, Pendidikan, Pengalaman, Skill, Proyek, Sertifikat, Sosial Media, dan Kotak Pesan

---

## 🚀 Panduan Deployment Cloud (100% Gratis Selamanya)

### Opsi 1: Deploy ke Vercel (100% Gratis Selamanya, Super Cepat, Tanpa Sleep)

1. Buka **[vercel.com](https://vercel.com)** dan klik **Sign In** dengan akun GitHub Anda (`AlexanderFarhan`).
2. Klik tombol **Add New...** > **Project**.
3. Pilih repository **`portfolio-andika`** dan klik **Import**.
4. Semua pengaturan (Framework, Root Directory, dan Routes) sudah otomatis terkonfigurasi melalui `vercel.json`!
5. Klik **Deploy**. Dalam waktu sekitar 1 menit, website Anda langsung aktif dengan domain gratis HTTPS (misalnya `portfolio-andika.vercel.app`)!

---

### Opsi 2: Deploy ke Render (Web Service Gratis)

1. **Buka [render.com](https://render.com)** dan login menggunakan akun GitHub Anda (`AlexanderFarhan`).
2. Klik **New +** > **Blueprint** (atau **Web Service**).
3. Hubungkan repository ini: `AlexanderFarhan/portfolio-andika`.
4. Jika menggunakan Blueprint, Render akan otomatis membaca konfigurasi `render.yaml`.
5. Jika membuat manual via **Web Service**:
   - **Environment**: `Docker`
   - **Region**: `Singapore (Southeast Asia)`
   - **Instance Type**: `Free`
   - **Environment Variables**:
     - `APP_ENV`: `production`
     - `APP_DEBUG`: `false`
     - `APP_KEY`: *(Generate otomatis atau jalankan `php artisan key:generate --show`)*
     - `DB_CONNECTION`: `sqlite` *(atau gunakan PostgreSQL/MySQL Render)*
     - `RUN_SEEDER`: `true`
6. Klik **Create Web Service**. Website Anda akan otomatis live dalam beberapa menit!

---

### Opsi B: Deploy ke Railway

1. Buka [railway.app](https://railway.app) dan login dengan GitHub.
2. Klik **New Project** > **Deploy from GitHub repo** > pilih `portfolio-andika`.
3. Railway akan otomatis mendeteksi `Dockerfile` dan menjalankan build.
4. Tambahkan Environment Variable:
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
   - `RUN_SEEDER`: `true`
   - `PORT`: `8080` (atau biarkan Railway mengatur secara dinamis)
5. Generate Domain di tab **Settings** > **Networking** > **Generate Domain**.

---

## 🔐 Akun Admin Default

Setelah migrasi & seeder dijalankan (`RUN_SEEDER=true`):
- **URL Admin**: `/admin/login`
- **Email**: `admin@andika.dev`
- **Password**: `password123`

---

## 💻 Menjalankan Secara Lokal

```bash
# 1. Clone repository
git clone https://github.com/AlexanderFarhan/portfolio-andika.git
cd portfolio-andika

# 2. Install dependencies
composer install
npm install

# 3. Konfigurasi Environment
cp .env.example .env
php artisan key:generate

# 4. Migrasi & Seed Database
php artisan migrate --seed

# 5. Jalankan server lokal
npm run build
php artisan serve
```
