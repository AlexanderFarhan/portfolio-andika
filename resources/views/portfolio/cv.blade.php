<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae — {{ $profile->name ?? 'Andika Amansyah' }} (Mahasiswa TI UBSI)</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            background-color: #f1f5f9;
            color: #1e293b;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 2rem 0;
        }

        .cv-sheet {
            background: #ffffff;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 18mm 18mm;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
        }

        .cv-header-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 26pt;
            color: #0f172a;
            margin-bottom: 2pt;
            letter-spacing: -0.02em;
        }

        .cv-subtitle {
            font-size: 11pt;
            font-weight: 600;
            color: #0284c7;
            margin-bottom: 8pt;
        }

        .cv-contact-strip {
            font-size: 9pt;
            color: #475569;
            display: flex;
            flex-wrap: wrap;
            gap: 12pt;
            padding-bottom: 10pt;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 14pt;
        }

        .cv-section-title {
            font-family: 'Outfit', sans-serif;
            font-size: 12pt;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1.5px solid #0284c7;
            padding-bottom: 3pt;
            margin-top: 14pt;
            margin-bottom: 8pt;
        }

        .cv-item {
            margin-bottom: 9pt;
        }

        .cv-item-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 2pt;
        }

        .cv-role {
            font-weight: 700;
            font-size: 10.5pt;
            color: #0f172a;
        }

        .cv-period {
            font-size: 8.5pt;
            font-family: monospace;
            color: #64748b;
            font-weight: 600;
        }

        .cv-org {
            font-size: 9.5pt;
            font-weight: 600;
            color: #0369a1;
            margin-bottom: 2pt;
        }

        .cv-desc {
            font-size: 9pt;
            color: #334155;
            line-height: 1.5;
            margin-bottom: 2pt;
        }

        .cv-skills-grid {
            display: grid;
            grid-template-columns: 140pt 1fr;
            row-gap: 5pt;
            font-size: 9pt;
            margin-bottom: 8pt;
        }

        .cv-skill-category {
            font-weight: 700;
            color: #0f172a;
        }

        .cv-skill-values {
            color: #334155;
        }

        /* Printable Mode Rules */
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .cv-sheet {
                box-shadow: none;
                margin: 0;
                padding: 12mm 12mm;
                width: 100%;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Action Toolbar for Screen View -->
    <div class="no-print position-fixed top-0 start-0 end-0 bg-dark text-white p-3 shadow-lg d-flex justify-content-between align-items-center" style="z-index: 9999;">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('portfolio.index') }}" class="btn btn-sm btn-outline-light">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Portfolio
            </a>
            <span class="small d-none d-md-inline text-light opacity-75">Curriculum Vitae (CV) — {{ $profile->name ?? 'Andika Amansyah' }}</span>
        </div>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-sm btn-primary-custom">
                <i class="bi bi-printer-fill me-1"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <!-- Printable CV Sheet -->
    <div class="cv-sheet" style="margin-top: 3.5rem;">
        <!-- Header -->
        <div class="cv-header-title">{{ $profile->name ?? 'Andika Amansyah' }}</div>
        <div class="cv-subtitle">{{ $profile->tagline ?? 'Mahasiswa Teknologi Informasi — Universitas Bina Sarana Informatika (UBSI)' }}</div>

        <div class="cv-contact-strip">
            <span><i class="bi bi-envelope-fill me-1"></i> {{ $profile->email ?? 'andika.amansyah@gmail.com' }}</span>
            <span><i class="bi bi-telephone-fill me-1"></i> {{ $profile->phone ?? '+62 812-3456-7890' }}</span>
            <span><i class="bi bi-geo-alt-fill me-1"></i> {{ $profile->location ?? 'Bekasi / Jakarta, Indonesia' }}</span>
            <span><i class="bi bi-star-fill text-warning me-1"></i> IPK: {{ $profile->gpa ?? '3.85 / 4.00' }}</span>
            <span><i class="bi bi-globe me-1"></i> andika.dev</span>
        </div>

        <!-- Ringkasan Profil -->
        <div class="cv-section-title">Ringkasan Profesional</div>
        <div class="cv-desc" style="margin-bottom: 12pt;">
            Mahasiswa aktif program studi S1 Teknologi Informasi di Universitas Bina Sarana Informatika (UBSI) dengan konsentrasi pada integrasi rekayasa perangkat lunak (Software Engineering) dan infrastruktur jaringan (Computer Networking). Berpengalaman dalam perancangan arsitektur web modern dengan Laravel 12 &amp; MySQL, integrasi mikrokontroler IoT (ESP32 &amp; RFID), administrasi routing MikroTik RouterOS, serta server Linux Ubuntu CLI. Memiliki dedikasi tinggi terhadap penulisan kode bersih, analisis sistem yang terstruktur, dan pemecahan masalah algoritma secara efisien.
        </div>

        <!-- Pendidikan -->
        <div class="cv-section-title">Pendidikan Formal</div>
        @foreach($educations as $edu)
            <div class="cv-item">
                <div class="cv-item-header">
                    <span class="cv-role">{{ $edu->institution }}</span>
                    <span class="cv-period">{{ $edu->start_year }} — {{ $edu->end_year ?? 'Sekarang' }}</span>
                </div>
                <div class="cv-org">{{ $edu->degree }} {{ $edu->field_of_study ? '— ' . $edu->field_of_study : '' }} @if($edu->gpa) (IPK: {{ $edu->gpa }}) @endif</div>
                @if($edu->description)
                    <div class="cv-desc">{{ $edu->description }}</div>
                @endif
            </div>
        @endforeach

        <!-- Keahlian Teknis -->
        <div class="cv-section-title">Keahlian &amp; Kompetensi Teknis</div>
        <div class="cv-skills-grid">
            <div class="cv-skill-category">Pengembangan Web:</div>
            <div class="cv-skill-values">Laravel Framework, PHP 8.2+, MySQL Relational Database, Blade, Bootstrap 5, RESTful API, JavaScript, Vite</div>

            <div class="cv-skill-category">Analisis &amp; Desain:</div>
            <div class="cv-skill-values">System Requirement Specification (SRS), UML Diagrams, Database Normalization &amp; ERD, Algorithmic Problem Solving</div>

            <div class="cv-skill-category">Jaringan &amp; Sistem:</div>
            <div class="cv-skill-values">MikroTik RouterOS (Routing, NAT, Simple Queue, VLAN), Ubuntu Server 22.04 LTS CLI, Nginx, Bash Scripting</div>

            <div class="cv-skill-category">IoT &amp; Hardware:</div>
            <div class="cv-skill-values">ESP32 Development Board, RFID RC522 Reader, C++ / Arduino IDE, Protocol HTTP/REST API Integration</div>
        </div>

        <!-- Pengalaman Kerja & Proyek -->
        <div class="cv-section-title">Pengalaman Kerja &amp; Proyek</div>
        @foreach($experiences as $exp)
            <div class="cv-item">
                <div class="cv-item-header">
                    <span class="cv-role">{{ $exp->role }}</span>
                    <span class="cv-period">{{ $exp->start_date }} — {{ $exp->end_date ?? 'Sekarang' }}</span>
                </div>
                <div class="cv-org">{{ $exp->company }} ({{ $exp->type }})</div>
                <div class="cv-desc">{{ $exp->description }}</div>
                @if($exp->skills_used)
                    <div class="cv-desc" style="font-size: 8.5pt; color: #64748b;"><strong>Keahlian Terkait:</strong> {{ $exp->skills_used }}</div>
                @endif
            </div>
        @endforeach

        <!-- Proyek Portofolio Terpilih -->
        <div class="cv-section-title">Proyek Portofolio Utama</div>
        @foreach($projects as $proj)
            <div class="cv-item">
                <div class="cv-item-header">
                    <span class="cv-role">{{ $proj->title }}</span>
                    <span class="cv-period">{{ $proj->category }}</span>
                </div>
                <div class="cv-desc">{{ $proj->summary }}</div>
                <div class="cv-desc" style="font-size: 8.5pt; color: #64748b;">
                    <strong>Tech Stack:</strong> {{ is_array($proj->technologies) ? implode(', ', $proj->technologies) : $proj->technologies }}
                </div>
            </div>
        @endforeach

        <!-- Sertifikasi & Prestasi -->
        <div class="cv-section-title">Sertifikasi &amp; Prestasi Resmi</div>
        @foreach($certificates as $cert)
            <div class="cv-item" style="margin-bottom: 5pt;">
                <div class="cv-item-header">
                    <span class="cv-role" style="font-size: 9.5pt;">{{ $cert->title }}</span>
                    <span class="cv-period">{{ $cert->issue_date }}</span>
                </div>
                <div class="cv-desc" style="font-size: 8.5pt;">
                    {{ $cert->issuer }} @if($cert->credential_id) — No: {{ $cert->credential_id }} @endif
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
