<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],

            'last_name' => ['required', 'string', 'max:100'],

            'father_name' => ['required', 'string', 'max:100'],

            'personnel_number' => ['required', 'string', 'max:50'],

            'national_code' => ['required', 'digits:10'],

            'birth_certificate_number' => ['required', 'numeric'],

            'mobile' => ['required', 'digits_between:10,15'],

            'backup_mobile' => ['nullable', 'digits_between:10,15'],

            'home_phone' => ['nullable', 'digits_between:7,15'],

            'home_address' => ['nullable', 'string'],

            'job' => ['required', 'string', 'max:100'],

            'position' => ['required', 'string', 'max:100'],

            'service_branch' => ['required', 'string', 'max:100'],

            'service_summary' => ['nullable', 'string'],
        ];
    }
}