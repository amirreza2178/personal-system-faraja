<?php

namespace App\Http\Requests;

use App\Enums\LeaveType;
use App\Rules\ValidJalaliDate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLeaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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
                Rule::enum(LeaveType::class),
            ],

            'start_date' => [
                'required',
                'string',
                new ValidJalaliDate(),
            ],

            'end_date' => [
                'required',
                'string',
                new ValidJalaliDate(),
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' =>
                'انتخاب پرسنل الزامی است.',

            'employee_id.integer' =>
                'پرسنل انتخاب‌شده معتبر نیست.',

            'employee_id.exists' =>
                'پرسنل انتخاب‌شده معتبر نیست.',

            'leave_type.required' =>
                'نوع مرخصی را انتخاب کنید.',

            'leave_type.enum' =>
                'نوع مرخصی انتخاب‌شده معتبر نیست.',

            'start_date.required' =>
                'تاریخ شروع الزامی است.',

            'end_date.required' =>
                'تاریخ پایان الزامی است.',

            'description.max' =>
                'توضیحات نمی‌تواند بیشتر از ۲۰۰۰ کاراکتر باشد.',
        ];
    }
}



// {
//     /**
//      * Determine if the user is authorized to make this request.
//      */
//     public function authorize(): bool
//     {
//         return true;
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      */
//     public function rules(): array
//     {
//         return [
//             'employee_id' => [
//                 'required',
//                 'integer',
//                 'exists:employees,id',
//             ],

//             'leave_type' => [
//                 'required',
//                 new Enum(LeaveType::class),
//             ],

//             'start_date' => [
//                 'required',
//                 'date',
//             ],

//             'end_date' => [
//                 'required',
//                 'date',
//                 'after_or_equal:start_date',
//             ],

//             'days' => [
//                 'nullable',
//                 'integer',
//                 'min:1',
//             ],

//             'description' => [
//                 'nullable',
//                 'string',
//                 'max:5000',
//             ],
//         ];
//     }

//     /**
//      * Additional validation after the basic rules.
//      */
//     public function withValidator($validator): void
//     {
//         $validator->after(function ($validator) {

//             if (!$this->filled('leave_type')) {
//                 return;
//             }

//             $type = $this->enum(
//                 'leave_type',
//                 LeaveType::class
//             );

//             if (!$type) {
//                 return;
//             }

//             if (
//                 $type === LeaveType::SICK &&
//                 !$this->filled('description')
//             ) {
//                 $validator->errors()->add(
//                     'description',
//                     'برای مرخصی استعلاجی ثبت توضیحات الزامی است.'
//                 );
//             }
//         });
//     }
// }

