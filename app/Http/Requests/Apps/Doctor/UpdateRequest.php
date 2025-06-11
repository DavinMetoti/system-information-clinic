<?php

namespace App\Http\Requests\Apps\Doctor;

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
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|max:255',
            'contact'               => 'nullable|string|max:15',
            'address'               => 'nullable|string|max:255',
            'gender'                => 'required|in:Laki-laki,Perempuan',
            'license_number'        => 'required|string|max:50',
            'specialization_id'     => 'required|exists:specializations,id',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'                 => 'The name is required.',
            'email.required'                => 'The email address is required.',
            'email.email'                   => 'The email address must be a valid email.',
            'password.min'                  => 'The password must be at least 8 characters long.',
            'gender.required'               => 'The gender is required.',
        ];
    }
}
