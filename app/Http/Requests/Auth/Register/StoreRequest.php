<?php

namespace App\Http\Requests\Auth\Register;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string,
     */
    public function rules(): array
    {
        return [
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email|max:255',
            'password'          => 'required|string|min:8|confirmed',
            'contact'           => 'nullable|string|max:15',
            'address'           => 'nullable|string|max:255',
            'gender'            => 'required|in:Laki-laki,Perempuan',
            'date_of_birth'     => 'nullable|date',
            'place_of_birth'    => 'nullable|string|max:255',
            'blood_type'        => 'nullable|in:A,B,AB,O',
            'bpjs_number'       => 'nullable|string|max:20|unique:user_pasiens,bpjs_number',
            'role'              => ['nullable', 'string'],
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
            'name.required'         => 'The name is required.',
            'email.required'        => 'The email address is required.',
            'email.email'           => 'The email address must be a valid email.',
            'email.unique'          => 'The email address has already been taken.',
            'password.required'     => 'The password is required.',
            'password.min'          => 'The password must be at least 8 characters long.',
            'password.confirmed'    => 'The password confirmation does not match.',
            'gender.required'       => 'The gender is required.',
            'gender.in'             => 'The gender must be Laki-laki or Perempuan.',
            'blood_type.in'         => 'The blood type must be one of: A, B, AB, O.',
            'bpjs_number.unique'    => 'The BPJS number has already been taken.',
        ];
    }
}
