<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tagline',
        'headline',
        'about_me',
        'about_title',
        'about_subtitle',
        'about_pillars',
        'bio_focus',
        'email',
        'phone',
        'location',
        'avatar',
        'resume_pdf',
        'years_of_experience',
        'completed_projects',
        'gpa',
    ];

    protected $casts = [
        'about_pillars' => 'array',
    ];

    /**
     * Return default 4 core pillars if not customized yet.
     */
    public function getActivePillars(): array
    {
        if (!empty($this->about_pillars) && is_array($this->about_pillars)) {
            return $this->about_pillars;
        }

        return [
            [
                'title' => 'System Analysis',
                'icon' => 'bi-diagram-3-fill',
                'description' => 'Membedah kebutuhan pengguna, menyusun diagram alir bisnis (UML, DFD), dan merancang skema basis data relational (ERD) ter-normalisasi.',
            ],
            [
                'title' => 'Problem Solving',
                'icon' => 'bi-lightbulb-fill',
                'description' => 'Pendekatan analitis logis dalam memecahkan kompleksitas algoritma, troubleshooting sistem, dan optimasi performa beban kerja aplikasi.',
            ],
            [
                'title' => 'Web Development',
                'icon' => 'bi-code-square',
                'description' => 'Pembangunan arsitektur web modern full-stack menggunakan Laravel 12, PHP 8.2+, MySQL, Blade engine, dan antarmuka responsif Bootstrap 5.',
            ],
            [
                'title' => 'Networking & Linux',
                'icon' => 'bi-router-fill',
                'description' => 'Konfigurasi router MikroTik RouterOS (VLAN, NAT, QoS, Firewall) dan administrasi server Linux Ubuntu Server murni melalui antarmuka CLI.',
            ],
        ];
    }
}
