<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:191',
            'issuer' => 'required|string|max:191',
            'issue_date' => 'required|string|max:50',
            'credential_id' => 'nullable|string|max:100',
            'credential_url' => 'nullable|url|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ];
    }
}
