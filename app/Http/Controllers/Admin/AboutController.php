<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Show the form for editing the About section.
     */
    public function edit()
    {
        $profile = Profile::firstOrCreate(['id' => 1], [
            'name' => 'Andika Amansyah',
            'tagline' => 'Mahasiswa Teknologi Informasi — Universitas Bina Sarana Informatika (UBSI)',
            'headline' => 'System Analyst & Full-Stack Developer',
            'bio_focus' => 'System Analysis, Problem Solving, Web Development, dan Networking',
            'about_me' => 'Deskripsi profil...',
            'email' => 'andika.amansyah@example.com',
            'phone' => '+62 812-3456-7890',
            'location' => 'Bekasi / Jakarta, Indonesia',
            'about_title' => 'Tentang Andika Amansyah',
            'about_subtitle' => 'Kombinasi analisis kebutuhan bisnis yang terstruktur, algoritma problem-solving terukur, serta keahlian teknis pengembangan aplikasi dan jaringan komputer.',
        ]);

        $pillars = $profile->getActivePillars();

        return view('admin.about.edit', compact('profile', 'pillars'));
    }

    /**
     * Update the About section content in database.
     */
    public function update(Request $request)
    {
        $profile = Profile::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'about_title' => 'required|string|max:150',
            'about_subtitle' => 'nullable|string|max:500',
            'headline' => 'required|string|max:255',
            'bio_focus' => 'required|string|max:255',
            'about_me' => 'required|string',
            'pillars' => 'nullable|array|max:8',
            'pillars.*.title' => 'required|string|max:100',
            'pillars.*.icon' => 'required|string|max:60',
            'pillars.*.description' => 'required|string|max:500',
        ]);

        $profile->update([
            'about_title' => $validated['about_title'],
            'about_subtitle' => $validated['about_subtitle'] ?? null,
            'headline' => $validated['headline'],
            'bio_focus' => $validated['bio_focus'],
            'about_me' => $validated['about_me'],
            'about_pillars' => array_values($validated['pillars'] ?? []),
        ]);

        return redirect()->route('admin.about.edit')
            ->with('success', 'Konten section "About / Tentang Saya" berhasil diperbarui dan langsung tampil di portofolio publik!');
    }
}
