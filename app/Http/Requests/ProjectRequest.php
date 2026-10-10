<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('project') ? $this->route('project')->id : null;

        return [
            'title' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:projects,slug,' . $id,
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'technologies' => 'required|string', // Comma separated, then exploded to array in controller
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ];
    }
}
