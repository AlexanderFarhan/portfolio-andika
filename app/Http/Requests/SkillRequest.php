<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'proficiency' => 'required|integer|min:1|max:100',
            'icon' => 'nullable|string|max:100',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ];
    }
}
