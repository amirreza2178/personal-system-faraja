@extends('layouts.app')

@section('title', 'ویرایش درخواست مرخصی')

@section('content')

<style>

    .leave-form-page {
        direction: rtl;
    }

    .leave-form-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .05);
        overflow: hidden;
    }

    .leave-form-header {
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
        background: #ffffff;
    }

    .leave-form-title {
        font-size: 21px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 5px;
    }

    .leave-form-subtitle {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }

    .leave-form-body {
        padding: 28px;
    }

    .form-label-custom {
        display: block;
        font-size: 13px;
        font-weight: 800;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-control-custom,
    .form-select-custom {
        width: 100%;
        min-height: 45px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        background: #ffffff;
        color: #111827;
        padding: 9px 13px;
        transition: .2s;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    textarea.form-control-custom {
        min-height: 120px;
        resize: vertical;
    }

    .date-input {
        direction: ltr;
        text-align: left;
        font-weight: 700;
    }

    .form-help {
        display: block;
        margin-top: 6px;
        font-size: 11px;
        color: #9ca3af;
    }

    .current-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 9px;
        background: #fff4df;
        color: #b45309;
        font-size: 12px;
        font-weight: 800;
    }

    .info-box {
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #1e40af;
        border-radius: 12px;
        padding: 15px;
        font-size: 12px;
        line-height: 2;
    }

    .form-actions {
        border-top: 1px solid #e5e7eb;
        margin-top: 25px;
        padding-top: 20px;
    }

</style>


<div class="container-fluid py-4 leave-form-page">


    {{-- Header --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                ویرایش درخواست مرخصی
            </h1>

            <p class="text-muted mb-0">
                اطلاعات درخواست را بررسی و بروزرسانی کنید.
            </p>

        </div>


        <a href="{{ route('leave-requests.index') }}"
           class="btn btn-light">

            <i class="bi bi-arrow-right me-1"></i>

            بازگشت

        </a>

    </div>


    {{-- Errors --}}

    @if($errors->any())

        <div class="alert alert-danger mb-4">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-circle me-1"></i>

                لطفاً خطاهای زیر را بررسی کنید:

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="row justify-content-center">

        <div class="col-12 col-xl-9">

            <div class="leave-form-card">


                {{-- Card Header --}}

                <div class="leave-form-header">

                    <div class="d-flex justify-content-between align-items-center gap-3">

                        <div>

                            <div class="leave-form-title">

                                <i class="bi bi-pencil-square me-1"></i>

                                اطلاعات درخواست

                            </div>

                            <p class="leave-form-subtitle">

                                درخواست شماره
                                #{{ $leaveRequest->id }}

                            </p>

                        </div>


                        <div>

                            @if($leaveRequest->status === 'pending')

                                <span class="current-status">

                                    <i class="bi bi-hourglass-split"></i>

                                    در انتظار بررسی

                                </span>

                            @elseif($leaveRequest->status === 'approved')

                                <span class="current-status"
                                      style="background:#e7f8ee;color:#15803d;">

                                    <i class="bi bi-check-circle-fill"></i>

                                    تأیید شده

                                </span>

                            @elseif($leaveRequest->status === 'rejected')

                                <span class="current-status"
                                      style="background:#feecec;color:#b91c1c;">

                                    <i class="bi bi-x-circle-fill"></i>

                                    رد شده

                                </span>

                            @else

                                <span class="current-status"
                                      style="background:#f3f4f6;color:#4b5563;">

                                    {{ $leaveRequest->status }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Form --}}

                <div class="leave-form-body">

                    <form method="POST"
                          action="{{ route('leave-requests.update', $leaveRequest) }}">

                        @csrf

                        @method('PUT')


                        <div class="row g-4">


                            {{-- Employee --}}

                            <div class="col-md-6">

                                <label class="form-label-custom">

                                    پرسنل
                                    <span class="text-danger">*</span>

                                </label>

                                <select name="employee_id"
                                        class="form-select-custom"
                                        required>

                                    <option value="">
                                        انتخاب پرسنل
                                    </option>

                                    @foreach($employees as $employee)

                                        <option value="{{ $employee->id }}"
                                            @selected(
                                                old(
                                                    'employee_id',
                                                    $leaveRequest->employee_id
                                                ) == $employee->id
                                            )>

                                            {{ $employee->first_name }}
                                            {{ $employee->last_name }}

                                            @if($employee->personnel_number)

                                                —
                                                {{ $employee->personnel_number }}

                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- Leave Type --}}

                            <div class="col-md-6">

                                <label class="form-label-custom">

                                    نوع مرخصی
                                    <span class="text-danger">*</span>

                                </label>

                                @php

                                    $currentLeaveType = $leaveRequest->leave_type;

                                    if ($currentLeaveType instanceof \BackedEnum) {
                                        $currentLeaveType = $currentLeaveType->value;
                                    }

                                @endphp

                                <select name="leave_type"
                                        class="form-select-custom"
                                        required>

                                    <option value="">
                                        انتخاب نوع مرخصی
                                    </option>

                                    <option value="entitlement"
                                        @selected(
                                            old('leave_type', $currentLeaveType)
                                            === 'entitlement'
                                        )>

                                        مرخصی استحقاقی

                                    </option>

                                    <option value="encouragement"
                                        @selected(
                                            old('leave_type', $currentLeaveType)
                                            === 'encouragement'
                                        )>

                                        مرخصی تشویقی

                                    </option>

                                    <option value="sick"
                                        @selected(
                                            old('leave_type', $currentLeaveType)
                                            === 'sick'
                                        )>

                                        مرخصی استعلاجی

                                    </option>

                                    <option value="continuity"
                                        @selected(
                                            old('leave_type', $currentLeaveType)
                                            === 'continuity'
                                        )>

                                        مرخصی مداومت

                                    </option>

                                </select>

                            </div>


                            {{-- Start Date --}}

                            <div class="col-md-6">

                                <label class="form-label-custom">

                                    تاریخ شروع
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="text"
                                       name="start_date"
                                       class="form-control-custom date-input"
                                       value="{{ old(
                                           'start_date',
                                           \App\Helpers\JalaliHelper::format(
                                               $leaveRequest->start_date
                                           )
                                       ) }}"
                                       placeholder="۱۴۰۵/۰۶/۱۳"
                                       autocomplete="off"
                                       required>

                                <span class="form-help">
                                    تاریخ را به صورت شمسی وارد کنید.
                                </span>

                            </div>


                            {{-- End Date --}}

                            <div class="col-md-6">

                                <label class="form-label-custom">

                                    تاریخ پایان
                                    <span class="text-danger">*</span>

                                </label>

                                <input type="text"
                                       name="end_date"
                                       class="form-control-custom date-input"
                                       value="{{ old(
                                           'end_date',
                                           \App\Helpers\JalaliHelper::format(
                                               $leaveRequest->end_date
                                           )
                                       ) }}"
                                       placeholder="۱۴۰۵/۰۶/۱۳"
                                       autocomplete="off"
                                       required>

                                <span class="form-help">
                                    تاریخ پایان باید برابر یا بعد از تاریخ شروع باشد.
                                </span>

                            </div>


                            {{-- Description --}}

                            <div class="col-12">

                                <label class="form-label-custom">

                                    توضیحات

                                </label>

                                <textarea name="description"
                                          class="form-control-custom"
                                          maxlength="2000"
                                          placeholder="توضیحات مربوط به درخواست...">{{ old(
                                            'description',
                                            $leaveRequest->description
                                        ) }}</textarea>

                                <span class="form-help">
                                    حداکثر ۲۰۰۰ کاراکتر
                                </span>

                            </div>


                            {{-- Info --}}

                            <div class="col-12">

                                <div class="info-box">

                                    <i class="bi bi-info-circle me-1"></i>

                                    مدت مرخصی به‌صورت خودکار توسط سیستم محاسبه می‌شود و
                                    مقدار واردشده توسط کاربر قابل اعتماد نیست.

                                    همچنین سیستم قبل از ذخیره، تداخل تاریخ و موجودی مرخصی را بررسی می‌کند.

                                </div>

                            </div>

                        </div>


                        {{-- Actions --}}

                        <div class="form-actions d-flex justify-content-between gap-2">

                            <a href="{{ route('leave-requests.show', $leaveRequest) }}"
                               class="btn btn-light px-4">

                                <i class="bi bi-eye me-1"></i>

                                مشاهده جزئیات

                            </a>


                            <div class="d-flex gap-2">

                                <a href="{{ route('leave-requests.index') }}"
                                   class="btn btn-light px-4">

                                    انصراف

                                </a>

                                <button type="submit"
                                        class="btn btn-primary px-4">

                                    <i class="bi bi-check-lg me-1"></i>

                                    ذخیره تغییرات

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection