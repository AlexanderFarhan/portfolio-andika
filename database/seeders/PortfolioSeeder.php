<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\SocialLink;
use App\Models\ContactMessage;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@andika.dev'],
            [
                'name' => 'Andika Amansyah',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Profile
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Andika Amansyah',
                'tagline' => 'Mahasiswa Teknologi Informasi — Universitas Bina Sarana Informatika (UBSI)',
                'headline' => 'Aspiring System Analyst & Full-Stack Web Developer',
                'bio_focus' => 'System Analysis, Problem Solving, Web Development, dan Networking',
                'about_me' => "Halo! Saya Andika Amansyah, seorang mahasiswa aktif jurusan Teknologi Informasi di Universitas Bina Sarana Informatika (UBSI). Saya memiliki antusiasme mendalam pada integrasi antara rekayasa perangkat lunak (Software Engineering) dan infrastruktur jaringan (Computer Networking).\n\nFokus keahlian saya terbagi dalam empat pilar utama: Analisis Sistem (System Analysis) untuk memetakan alur bisnis menjadi arsitektur aplikasi terstruktur; Pemecahan Masalah (Problem Solving) yang berorientasi algoritma efisien; Pengembangan Web (Full-Stack Laravel & modern frontend); serta Konfigurasi Jaringan & Server (MikroTik RouterOS & Ubuntu Linux CLI).\n\nSaya percaya bahwa sistem perangkat lunak yang hebat tidak hanya memiliki antarmuka yang elegan, namun juga arsitektur database yang kokoh, performa yang handal, dan keamanan yang terjamin.",
                'about_title' => 'Tentang Andika Amansyah',
                'about_subtitle' => 'Kombinasi analisis kebutuhan bisnis yang terstruktur, algoritma problem-solving terukur, serta keahlian teknis pengembangan aplikasi dan jaringan komputer.',
                'email' => 'andika.amansyah@gmail.com',
                'phone' => '+62 812-3456-7890',
                'location' => 'Bekasi / Jakarta, Indonesia',
                'avatar' => '/images/avatar-andika.svg',
                'resume_pdf' => '/cv/CV_Andika_Amansyah.pdf',
                'years_of_experience' => '2+ Tahun',
                'completed_projects' => 15,
                'gpa' => '3.85 / 4.00',
            ]
        );

        // 3. Education
        Education::truncate();
        Education::create([
            'institution' => 'Universitas Bina Sarana Informatika (UBSI)',
            'degree' => 'Sarjana Komputer (S.Kom) — Teknologi Informasi',
            'field_of_study' => 'Teknologi Informasi / Software Engineering & Networking',
            'start_year' => '2022',
            'end_year' => 'Sekarang',
            'gpa' => '3.85 / 4.00',
            'description' => 'Mempelajari Rekayasa Perangkat Lunak, Analisis & Perancangan Sistem Berorientasi Objek (UML/ERD), Basis Data Relasional, Jaringan Komputer Lanjut, Pemrograman Web Enterprise Laravel, serta Keamanan Sistem Informasi.',
            'order' => 1,
        ]);

        Education::create([
            'institution' => 'SMK / SMA Negeri',
            'degree' => 'Teknik Komputer & Jaringan (TKJ)',
            'field_of_study' => 'Infrastruktur Jaringan & Troubleshooting Komputer',
            'start_year' => '2019',
            'end_year' => '2022',
            'gpa' => 'Predikat Sangat Memuaskan',
            'description' => 'Mendalami dasar arsitektur routing & switching, pengkabelan UTP/Fiber Optic, konfigurasi LAN/WAN, instalasi sistem operasi Linux & Windows Server, serta pemeliharaan hardware komputer.',
            'order' => 2,
        ]);

        // 4. Experience
        Experience::truncate();
        Experience::create([
            'role' => 'System Analyst & Full-Stack Web Developer',
            'company' => 'Freelance & Independent Projects',
            'type' => 'Freelance / Projects',
            'start_date' => 'Jan 2024',
            'end_date' => 'Sekarang',
            'description' => 'Menganalisis proses bisnis klien, menyusun dokumen Software Requirement Specification (SRS), merancang Entity Relationship Diagram (ERD), dan mengembangkan aplikasi web end-to-end dengan Laravel 11/12, MySQL, dan Bootstrap 5.',
            'skills_used' => 'Laravel, MySQL, System Analysis, REST API, Bootstrap 5, Git',
            'order' => 1,
        ]);

        Experience::create([
            'role' => 'Network Administrator & Lab Technician',
            'company' => 'Campus Networking & System Laboratory',
            'type' => 'Academic / Internship',
            'start_date' => 'Agt 2023',
            'end_date' => 'Des 2024',
            'description' => 'Mengonfigurasi router MikroTik RouterOS (VLAN multi-segmen, Simple Queue bandwidth management, firewall filter rule) dan mengelola server lokal Ubuntu Server untuk web development sandbox.',
            'skills_used' => 'MikroTik RouterOS, Winbox, Ubuntu CLI, Subnetting, VLAN, NAT',
            'order' => 2,
        ]);

        Experience::create([
            'role' => 'IoT & Hardware Integration Specialist',
            'company' => 'Academic Research Project',
            'type' => 'Research Project',
            'start_date' => 'Mar 2024',
            'end_date' => 'Jul 2024',
            'description' => 'Mengembangkan prototipe sistem absensi pintar berbasis ESP32 dan RFID RC522. Mengintegrasikan komunikasi data mikrokontroler dengan REST API backend Laravel dan logging presensi real-time.',
            'skills_used' => 'ESP32, C++, RFID RC522, HTTP Client, JSON, API Integration',
            'order' => 3,
        ]);

        // 5. Skills
        Skill::truncate();
        $skills = [
            // Web Development
            ['name' => 'Laravel Framework', 'category' => 'Web Development', 'proficiency' => 92, 'icon' => 'bi-boxes', 'is_featured' => true, 'order' => 1],
            ['name' => 'PHP 8.2+', 'category' => 'Web Development', 'proficiency' => 90, 'icon' => 'bi-code-slash', 'is_featured' => true, 'order' => 2],
            ['name' => 'MySQL & Database Design', 'category' => 'Web Development', 'proficiency' => 88, 'icon' => 'bi-database', 'is_featured' => true, 'order' => 3],
            ['name' => 'Bootstrap 5 & Responsive UI', 'category' => 'Web Development', 'proficiency' => 90, 'icon' => 'bi-bootstrap', 'is_featured' => true, 'order' => 4],
            ['name' => 'RESTful API & JSON', 'category' => 'Web Development', 'proficiency' => 88, 'icon' => 'bi-arrow-left-right', 'is_featured' => true, 'order' => 5],
            ['name' => 'JavaScript (ES6+) & AJAX', 'category' => 'Web Development', 'proficiency' => 82, 'icon' => 'bi-filetype-js', 'is_featured' => true, 'order' => 6],

            // System Analysis & Problem Solving
            ['name' => 'System Requirements Analysis (SRS)', 'category' => 'System Analysis & Problem Solving', 'proficiency' => 90, 'icon' => 'bi-diagram-3', 'is_featured' => true, 'order' => 7],
            ['name' => 'UML Modeling (Use Case, Activity, Class)', 'category' => 'System Analysis & Problem Solving', 'proficiency' => 88, 'icon' => 'bi-diagram-2', 'is_featured' => true, 'order' => 8],
            ['name' => 'Database Normalization & ERD', 'category' => 'System Analysis & Problem Solving', 'proficiency' => 89, 'icon' => 'bi-hdd-network', 'is_featured' => true, 'order' => 9],
            ['name' => 'Algorithmic Problem Solving', 'category' => 'System Analysis & Problem Solving', 'proficiency' => 87, 'icon' => 'bi-cpu', 'is_featured' => true, 'order' => 10],

            // Computer Networking & Systems
            ['name' => 'MikroTik RouterOS (Routing & NAT)', 'category' => 'Computer Networking', 'proficiency' => 88, 'icon' => 'bi-router', 'is_featured' => true, 'order' => 11],
            ['name' => 'VLAN, DHCP & Bandwidth Management', 'category' => 'Computer Networking', 'proficiency' => 86, 'icon' => 'bi-hdd-stack', 'is_featured' => true, 'order' => 12],
            ['name' => 'Ubuntu Linux Server & CLI', 'category' => 'Computer Networking', 'proficiency' => 85, 'icon' => 'bi-terminal', 'is_featured' => true, 'order' => 13],
            ['name' => 'Network Troubleshooting & Wireshark', 'category' => 'Computer Networking', 'proficiency' => 83, 'icon' => 'bi-shield-check', 'is_featured' => true, 'order' => 14],

            // Embedded & IoT
            ['name' => 'ESP32 Microcontroller Programming', 'category' => 'Embedded & IoT', 'proficiency' => 82, 'icon' => 'bi-motherboard', 'is_featured' => true, 'order' => 15],
            ['name' => 'RFID RC522 Sensor Integration', 'category' => 'Embedded & IoT', 'proficiency' => 85, 'icon' => 'bi-credit-card-2-front', 'is_featured' => true, 'order' => 16],
            ['name' => 'Git & Version Control', 'category' => 'Tools & Workflows', 'proficiency' => 89, 'icon' => 'bi-git', 'is_featured' => true, 'order' => 17],
            ['name' => 'Postman & API Testing', 'category' => 'Tools & Workflows', 'proficiency' => 87, 'icon' => 'bi-send', 'is_featured' => true, 'order' => 18],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // 6. Projects (5 Featured Projects Sesuai Permintaan)
        Project::truncate();
        $projects = [
            [
                'title' => 'Web Penggajian Karyawan — Laravel',
                'slug' => 'web-penggajian-karyawan-laravel',
                'category' => 'Web Development',
                'summary' => 'Sistem informasi pengelolaan gaji komprehensif dengan kalkulasi tunjangan otomatis, potongan pajak/BPJS, rekap absensi, dan cetak slip gaji format PDF.',
                'description' => "Aplikasi Web Penggajian Karyawan yang dirancang untuk mengotomasi alur perhitungan payroll bulanan perusahaan. Dilengkapi dengan manajemen data jabatan, golongan gaji, perhitungan jam lembur, absensi karyawan, hingga pembuatan laporan rekapitulasi gaji per periode.\n\nFitur Utama:\n- Autentikasi multi-level (Admin HRD & Karyawan)\n- Rumus kalkulasi gaji otomatis berdasarkan kehadiran dan performa\n- Generator slip gaji digital berformat PDF via DomPDF\n- Dashboard statistik pengeluaran beban gaji perusahaan\n- Ekspor data laporan ke format Excel & CSV.",
                'image' => '/images/project-payroll.svg',
                'technologies' => ['Laravel 12', 'PHP 8.2', 'MySQL', 'Bootstrap 5', 'DomPDF', 'Chart.js'],
                'demo_url' => 'https://demo-payroll.andika.dev',
                'github_url' => 'https://github.com/andika-amansyah/laravel-payroll-system',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Sistem Absensi RFID — ESP32',
                'slug' => 'sistem-absensi-rfid-esp32',
                'category' => 'IoT & Embedded System',
                'summary' => 'Solusi presensi cerdas real-time menggunakan mikrokontroler ESP32, RFID RC522 Card Reader, layar LCD I2C, dan koneksi API backend server.',
                'description' => "Prototipe sistem absensi kehadiran berbasis Internet of Things (IoT). Setiap pengguna memindai kartu RFID Mifare 13.56MHz pada reader. Data UID kartu dikirim secara nirkabel melalui WiFi ESP32 ke endpoint REST API backend Laravel untuk divalidasi dan dicatat ke database MySQL secara instan.\n\nFitur Utama:\n- Verifikasi kartu kilat dengan latensi di bawah 300ms\n- Feedback visual via LCD Display I2C 16x2 dan buzzer audio\n- Anti-fraud detection (mencegah double tap dalam rentang waktu singkat)\n- Log monitoring presensi live pada dashboard admin web\n- Mode offline caching saat jaringan terputus sementara.",
                'image' => '/images/project-rfid.svg',
                'technologies' => ['ESP32', 'RFID RC522', 'C++ / Arduino IDE', 'Laravel REST API', 'MySQL', 'Hardware Wiring'],
                'demo_url' => 'https://demo-rfid.andika.dev',
                'github_url' => 'https://github.com/andika-amansyah/esp32-rfid-attendance',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Café Kopi Rahasia — Web System',
                'slug' => 'cafe-kopi-rahasia-web-system',
                'category' => 'Web Development',
                'summary' => 'Sistem Point of Sale (POS) dan reservasi meja café modern dengan manajemen menu dinamis, manajemen inventaris bahan, dan analitik omzet.',
                'description' => "Sistem informasi manajemen café terpadu untuk Café Kopi Rahasia. Dirancang untuk mempercepat transaksi di meja kasir dan mempermudah pelanggan dalam melihat menu serta melakukan reservasi meja secara online.\n\nFitur Utama:\n- Antarmuka POS responsif dan cepat untuk kasir barista\n- Manajemen varian menu, addons topping, dan stok bahan baku\n- Kalkulasi diskon, voucher promo, dan pajak otomatis\n- Pencetakan struk pembayaran thermal printer (58mm/80mm)\n- Laporan harian, mingguan, dan bulanan dengan visualisasi grafik.",
                'image' => '/images/project-cafe.svg',
                'technologies' => ['Laravel', 'MySQL', 'Bootstrap 5', 'JavaScript', 'SweetAlert2', 'Thermal Print API'],
                'demo_url' => 'https://kopirahasia.andika.dev',
                'github_url' => 'https://github.com/andika-amansyah/cafe-kopi-rahasia-pos',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'MikroTik Networking Project',
                'slug' => 'mikrotik-networking-project',
                'category' => 'Computer Networking',
                'summary' => 'Perancangan topologi jaringan kantor multi-gedung dengan MikroTik RouterOS mencakup VLAN Segregation, Hotspot User Manager, QoS, dan Firewall Security.',
                'description' => "Proyek arsitektur jaringan komputer enterprise skala menengah menggunakan router MikroTik RouterOS. Mengisolasi traffic antar departemen untuk meningkatkan keamanan dan memprioritaskan bandwidth untuk aplikasi kritis perusahaan.\n\nFitur Utama:\n- Segmentasi VLAN (Management, Staff, Guest WiFi, Server Farm)\n- Manajemen bandwidth dengan Simple Queue & PCQ (Per Connection Queueing)\n- Captive Portal Hotspot dengan integrasi RADIUS / User Manager\n- Firewall Filter & NAT Security (mencegah brute-force port, blocking port scans)\n- Failover Dual WAN dengan routing static berbobot distance.",
                'image' => '/images/project-mikrotik.svg',
                'technologies' => ['MikroTik RouterOS', 'Winbox', 'VLAN Trunking', 'QoS / Bandwidth Management', 'Firewall Filter & NAT'],
                'demo_url' => 'https://network-docs.andika.dev',
                'github_url' => 'https://github.com/andika-amansyah/mikrotik-network-topology',
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'title' => 'Ubuntu CLI Project',
                'slug' => 'ubuntu-cli-project',
                'category' => 'System Administration',
                'summary' => 'Implementasi otomatisasi server Ubuntu Server via CLI dengan Nginx reverse proxy, SSL Let\'s Encrypt, hardening security, dan auto-backup database.',
                'description' => "Konfigurasi dan manajemen server Linux Ubuntu 22.04 LTS murni berbasis Command Line Interface (CLI). Dioptimalkan untuk deployment web production yang aman, efisien, dan memiliki sistem pemulihan otomatis.\n\nFitur Utama:\n- Konfigurasi LEMP stack (Linux, Nginx, MySQL, PHP-FPM) berperforma tinggi\n- Bash Script otomatis untuk backup database MySQL harian & sinkronisasi ke cloud\n- Security hardening: UFW firewall, SSH key-only login, Fail2ban intrusion prevention\n- Pemantauan resource server via htop, iotop, dan systemd service watchdog\n- Otomatisasi pembaharuan sertifikat SSL dengan Certbot Let's Encrypt.",
                'image' => '/images/project-ubuntu.svg',
                'technologies' => ['Ubuntu Server 22.04 LTS', 'Bash Shell Scripting', 'Nginx Web Server', 'MySQL Tuning', 'Fail2ban & UFW', 'Systemd'],
                'demo_url' => 'https://server-status.andika.dev',
                'github_url' => 'https://github.com/andika-amansyah/ubuntu-server-automation-cli',
                'is_featured' => true,
                'order' => 5,
            ],
        ];

        foreach ($projects as $proj) {
            Project::create($proj);
        }

        // 7. Certificates
        Certificate::truncate();
        $certs = [
            [
                'title' => 'Junior Web Developer (JWD) Certified',
                'issuer' => 'Badan Nasional Sertifikasi Profesi (BNSP)',
                'issue_date' => '2024',
                'credential_id' => 'BNSP-JWD-771892',
                'credential_url' => 'https://bnsp.go.id/verify/BNSP-JWD-771892',
                'image' => '/images/cert-bnsp.svg',
                'description' => 'Sertifikasi kompetensi standar nasional Indonesia dalam pemrograman web, mencakup algoritma, arsitektur basis data, dan implementasi aplikasi berbasis web.',
                'order' => 1,
            ],
            [
                'title' => 'MikroTik Certified Network Associate (MTCNA)',
                'issuer' => 'MikroTik Training & Certification',
                'issue_date' => '2023',
                'credential_id' => 'MTCNA-2309-8812',
                'credential_url' => 'https://mikrotik.com/certificate/MTCNA-2309-8812',
                'image' => '/images/cert-mikrotik.svg',
                'description' => 'Sertifikasi keahlian routing, bridging, wireless, firewall, QoS, web proxy, dan tunnel dalam lingkungan MikroTik RouterOS.',
                'order' => 2,
            ],
            [
                'title' => 'Belajar Membuat Aplikasi Web dengan Laravel & PHP',
                'issuer' => 'Dicoding Academy Indonesia',
                'issue_date' => '2024',
                'credential_id' => 'DICODING-WEB-99120',
                'credential_url' => 'https://dicoding.com/certificates/DICODING-WEB-99120',
                'image' => '/images/cert-dicoding.svg',
                'description' => 'Menyelesaikan kurikulum arsitektur MVC, database migration & seeder, Eloquent ORM, REST API, dan security best practices.',
                'order' => 3,
            ],
            [
                'title' => 'NDG Linux Unhatched & System Administration',
                'issuer' => 'Cisco Networking Academy',
                'issue_date' => '2023',
                'credential_id' => 'CISCO-LNX-44129',
                'credential_url' => 'https://netacad.com/certificates/CISCO-LNX-44129',
                'image' => '/images/cert-cisco.svg',
                'description' => 'Penguasaan dasar perintah CLI Linux, izin akses berkas (file permissions), manajemen paket, dan konfigurasi jaringan Linux.',
                'order' => 4,
            ],
            [
                'title' => 'Juara 2 Lomba Karya Cipta Teknologi Informasi',
                'issuer' => 'Universitas Bina Sarana Informatika (UBSI)',
                'issue_date' => '2024',
                'credential_id' => 'UBSI-HACK-2024-02',
                'credential_url' => null,
                'image' => '/images/cert-hackathon.svg',
                'description' => 'Penghargaan atas inovasi perancangan prototipe sistem absensi terintegrasi IoT dan web dashboard analitik kehadiran real-time.',
                'order' => 5,
            ],
        ];

        foreach ($certs as $cert) {
            Certificate::create($cert);
        }

        // 8. Social Links
        SocialLink::truncate();
        $socials = [
            ['platform' => 'GitHub', 'url' => 'https://github.com/andika-amansyah', 'icon' => 'bi-github', 'is_active' => true, 'order' => 1],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/andika-amansyah', 'icon' => 'bi-linkedin', 'is_active' => true, 'order' => 2],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/andika.amansyah', 'icon' => 'bi-instagram', 'is_active' => true, 'order' => 3],
            ['platform' => 'WhatsApp', 'url' => 'https://wa.me/6281234567890?text=Halo%20Andika,%20saya%20melihat%20portofolio%20Anda', 'icon' => 'bi-whatsapp', 'is_active' => true, 'order' => 4],
            ['platform' => 'Telegram', 'url' => 'https://t.me/andikaamansyah', 'icon' => 'bi-telegram', 'is_active' => true, 'order' => 5],
        ];

        foreach ($socials as $soc) {
            SocialLink::create($soc);
        }

        // 9. Sample Contact Message
        ContactMessage::truncate();
        ContactMessage::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@techcorp.co.id',
            'subject' => 'Tawaran Proyek Integrasi Sistem Web & IoT',
            'message' => 'Halo Mas Andika, saya melihat portofolio Anda khususnya proyek Web Penggajian Laravel dan Sistem Absensi RFID ESP32. Sangat rapi dan fungsional. Kami ingin mendiskusikan kemungkinan kolaborasi proyek otomasi sistem kantor kami. Kapan kira-kira ada waktu luang untuk Zoom meeting singkat? Terima kasih.',
            'is_read' => false,
            'read_at' => null,
        ]);
    }
}
