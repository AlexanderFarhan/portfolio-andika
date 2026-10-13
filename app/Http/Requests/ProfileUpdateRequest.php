<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'tagline' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'bio_focus' => 'required|string|max:255',
            'about_me' => 'required|string',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:50',
            'location' => 'required|string|max:150',
            'years_of_experience' => 'nullable|string|max:50',
            'completed_projects' => 'nullable|integer|min:0',
            'gpa' => 'nullable|string|max:50',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'resume_file' => 'nullable|file|mimes:pdf|max:4096',
        ];
    }

    public function messages(): array
    {
        return [
            'avatar_file.image' => 'File foto profil harus berupa gambar yang valid.',
            'avatar_file.mimes' => 'Format foto profil harus JPG, PNG, WEBP, atau SVG.',
            'avatar_file.max' => 'Ukuran foto profil maksimal 2MB.',
            'resume_file.file' => 'Berkas CV harus berupa file yang valid.',
            'resume_file.mimes' => 'Berkas CV harus berformat PDF.',
            'resume_file.max' => 'Ukuran berkas CV maksimal 4MB.',
        ];
    }
}
