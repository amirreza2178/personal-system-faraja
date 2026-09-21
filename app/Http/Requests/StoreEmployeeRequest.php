<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'employee_id' => [
                'required',
                'integer',
                'exists:employees,id',
            ],

            'leave_type' => [
                'required',
                Rule::in([
                    'daily',
                    'hourly',
                    'medical',
                    'continuity',
                ]),
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'start_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'end_time' => [
                'nullable',
                'date_format:H:i',
                'after:start_time',
            ],

            'reason' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' =>
                'انتخاب پرسنل الزامی است.',

            'employee_id.exists' =>
                'پرسنل انتخاب‌شده وجود ندارد.',

            'leave_type.required' =>
                'نوع مرخصی را انتخاب کنید.',

            'start_date.required' =>
                'تاریخ شروع الزامی است.',

            'end_date.after_or_equal' =>
                'تاریخ پایان نمی‌تواند قبل از تاریخ شروع باشد.',

            'start_time.date_format' =>
                'فرمت ساعت شروع صحیح نیست.',

            'end_time.date_format' =>
                'فرمت ساعت پایان صحیح نیست.',

            'end_time.after' =>
                'ساعت پایان باید بعد از ساعت شروع باشد.',

            'reason.max' =>
                'توضیحات نمی‌تواند بیشتر از ۱۰۰۰ کاراکتر باشد.',
        ];
    }
}