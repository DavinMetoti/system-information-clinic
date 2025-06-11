<?php

namespace App\Http\Requests\Auth\Register;

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
            'email'                 => 'required|string|email|max:255',
            'contact'               => 'nullable|string|max:15',
            'address'               => 'nullable|string|max:255',
            'gender'                => 'required|in:Laki-laki,Perempuan',
            'date_of_birth'         => 'nullable|date',
            'place_of_birth'        => 'nullable|string|max:255',
            'blood_type'            => 'nullable|in:A,B,AB,O',
            'bpjs_number'           => 'nullable|string|max:20',
        ];
    }
}
