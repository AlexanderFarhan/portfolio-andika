<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => 'required|string|max:191',
            'company' => 'required|string|max:191',
            'type' => 'required|string|max:100',
            'start_date' => 'required|string|max:50',
            'end_date' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'skills_used' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ];
    }
}
