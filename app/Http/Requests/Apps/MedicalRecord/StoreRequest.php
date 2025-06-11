<?php

namespace App\Http\Requests\Apps\MedicalRecord;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'      => ['required', 'exists:users,id'],
            'doctor_id'    => ['required', 'exists:users,id'],
            'date'         => ['required', 'date'],
            'complaint'    => ['nullable', 'string', 'max:255'],
            'diagnosis'    => ['nullable', 'string'],
            'treatment'    => ['nullable', 'string'],
            'notes'        => ['nullable', 'string'],
            'prescription' => ['nullable', 'json'],
            'status'       => ['required', 'in:done,process,end'],
        ];
    }
}
