<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\MediaStorageService;
use Illuminate\Support\Facades\Log;

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
        try {
            $profile = Profile::firstOrCreate(['id' => 1]);
            $data = $request->validated();

            if ($request->hasFile('avatar_file')) {
                MediaStorageService::delete($profile->avatar);
                $data['avatar'] = MediaStorageService::store($request->file('avatar_file'), 'profile');
            }

            if ($request->hasFile('resume_file')) {
                MediaStorageService::delete($profile->resume_pdf);
                $data['resume_pdf'] = MediaStorageService::store($request->file('resume_file'), 'resumes');
            }

            $profile->update($data);

            return redirect()->route('admin.profile.edit')
                ->with('success', 'Data profil Andika Amansyah berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('ProfileController@update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('admin.profile.edit')
                ->withInput()
                ->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }
}
