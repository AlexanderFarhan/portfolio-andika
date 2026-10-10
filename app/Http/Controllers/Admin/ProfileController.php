<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show profile edit form.
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
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * Update profile data and files.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $profile = Profile::first();
        $data = $request->validated();

        if ($request->hasFile('avatar_file')) {
            if ($profile->avatar && !str_starts_with($profile->avatar, '/images/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $profile->avatar));
            }
            $path = $request->file('avatar_file')->store('profile', 'public');
            $data['avatar'] = '/storage/' . $path;
        }

        if ($request->hasFile('resume_file')) {
            if ($profile->resume_pdf && !str_starts_with($profile->resume_pdf, '/cv/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $profile->resume_pdf));
            }
            $path = $request->file('resume_file')->store('resumes', 'public');
            $data['resume_pdf'] = '/storage/' . $path;
        }

        $profile->update($data);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Data profil Andika Amansyah berhasil diperbarui!');
    }
}
