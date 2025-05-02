<?php

namespace App\Http\Requests\Apps\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:255',
            'logo'            => 'nullable|string',
            'description'     => 'required|string',
            'address'         => 'required|string',
            'phone'           => 'required|string|max:20',
            'email'           => 'nullable|email|max:255',
            'contact_person'  => 'nullable|string|max:255',
            'website'         => 'nullable|url|max:255',
            'npwp'            => 'nullable|string|max:30',
            'is_active'       => 'boolean',
        ];
    }
}
