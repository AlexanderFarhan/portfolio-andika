<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'institution' => 'required|string|max:191',
            'degree' => 'required|string|max:191',
            'field_of_study' => 'nullable|string|max:191',
            'start_year' => 'required|string|max:50',
            'end_year' => 'nullable|string|max:50',
            'gpa' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ];
    }
}
