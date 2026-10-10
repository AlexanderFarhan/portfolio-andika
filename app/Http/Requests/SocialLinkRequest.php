<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'platform' => 'required|string|max:100',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:100',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ];
    }
}
