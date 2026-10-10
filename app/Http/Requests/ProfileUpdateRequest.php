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
            'resume_file' => 'nullable|file|mimes:pdf|max:5120',
        ];
    }
}
