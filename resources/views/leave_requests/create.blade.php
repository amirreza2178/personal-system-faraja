@extends('layouts.app')

@section('title', 'ثبت درخواست مرخصی')

@section('content')

<div class="container-fluid py-4">

```
{{-- Page Header --}}
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

    <div>
        <h3 class="fw-bold mb-1">
            <i class="bi bi-calendar-plus me-2"></i>
            ثبت درخواست مرخصی
        </h3>

        <p class="text-muted mb-0">
            ثبت و مدیریت درخواست مرخصی پرسنل
        </p>
    </div>

    <a
        href="{{ route('leave-requests.index') }}"
        class="btn btn-outline-secondary"
    >
        <i class="bi bi-arrow-right me-1"></i>
        بازگشت به لیست
    </a>

</div>


{{-- Validation Errors --}}
@if($errors->any())

    <div class="alert alert-danger">

        <div class="fw-bold mb-2">
            <i class="bi bi-exclamation-triangle me-2"></i>
            خطاهای فرم
        </div>

        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif


<div class="row g-4">

    {{-- Main Form --}}
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="fw-bold mb-0">
                    اطلاعات درخواست
                </h5>

            </div>


            <div class="card-body">

                <form
                    action="{{ route('leave-requests.store') }}"
                    method="POST"
                >

                    @csrf


                    {{-- Employee --}}
                    <div class="mb-4">

                        <label
                            for="employee_id"
                            class="form-label fw-semibold"
                        >
                            پرسنل
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="employee_id"
                            id="employee_id"
                            class="form-select @error('employee_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                انتخاب پرسنل
                            </option>

                            @foreach($employees as $employee)

                                <option
                                    value="{{ $employee->id }}"
                                    @selected(old('employee_id') == $employee->id)
                                >
                                    {{ $employee->first_name }}
                                    {{ $employee->last_name }}

                                    @if($employee->personnel_number)
                                        — {{ $employee->personnel_number }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        @error('employee_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Leave Type --}}
                    <div class="mb-4">

                        <label
                            for="leave_type"
                            class="form-label fw-semibold"
                        >
                            نوع مرخصی
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="leave_type"
                            id="leave_type"
                            class="form-select @error('leave_type') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                انتخاب نوع مرخصی
                            </option>

                            <option
                                value="entitlement"
                                @selected(old('leave_type') === 'entitlement')
                            >
                                مرخصی استحقاقی
                            </option>

                            <option
                                value="encouragement"
                                @selected(old('leave_type') === 'encouragement')
                            >
                                مرخصی تشویقی
                            </option>

                            <option
                                value="sick"
                                @selected(old('leave_type') === 'sick')
                            >
                                مرخصی استعلاجی
                            </option>

                            <option
                                value="continuity"
                                @selected(old('leave_type') === 'continuity')
                            >
                                مرخصی مداومت
                            </option>

                        </select>

                        @error('leave_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Dates --}}
                    <div class="row g-3">

                        {{-- Start Date --}}
                        <div class="col-md-6">

                            <label
                                for="start_date"
                                class="form-label fw-semibold"
                            >
                                تاریخ شروع
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-calendar3"></i>
                                </span>

                                <input
                                    type="text"
                                    name="start_date"
                                    id="start_date"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    value="{{ old('start_date') }}"
                                    placeholder="۱۴۰۵/۰۶/۱۳"
                                    autocomplete="off"
                                    dir="ltr"
                                    required
                                >

                            </div>

                            <div class="form-text">
                                فرمت تاریخ: ۱۴۰۵/۰۶/۱۳
                            </div>

                            @error('start_date')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- End Date --}}
                        <div class="col-md-6">

                            <label
                                for="end_date"
                                class="form-label fw-semibold"
                            >
                                تاریخ پایان
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-calendar3"></i>
                                </span>

                                <input
                                    type="text"
                                    name="end_date"
                                    id="end_date"
                                    class="form-control @error('end_date') is-invalid @enderror"
                                    value="{{ old('end_date') }}"
                                    placeholder="۱۴۰۵/۰۶/۱۳"
                                    autocomplete="off"
                                    dir="ltr"
                                    required
                                >

                            </div>

                            <div class="form-text">
                                فرمت تاریخ: ۱۴۰۵/۰۶/۱۳
                            </div>

                            @error('end_date')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="mt-4 mb-4">

                        <label
                            for="description"
                            class="form-label fw-semibold"
                        >
                            توضیحات
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            maxlength="2000"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="در صورت نیاز توضیحات مربوط به درخواست را وارد کنید..."
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Form Actions --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ route('leave-requests.index') }}"
                            class="btn btn-light px-4"
                        >
                            انصراف
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            <i class="bi bi-check-circle me-1"></i>
                            ثبت درخواست
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- Information --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <div class="d-flex align-items-center mb-3">

                    <div class="fs-3 text-primary me-3">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <h5 class="fw-bold mb-0">
                        نکات ثبت مرخصی
                    </h5>

                </div>

                <ul class="text-muted mb-0 ps-3">

                    <li class="mb-2">
                        تاریخ‌ها را به صورت شمسی وارد کنید.
                    </li>

                    <li class="mb-2">
                        بازه مرخصی نباید بین دو سال شمسی قرار داشته باشد.
                    </li>

                    <li class="mb-2">
                        تعداد روزهای مرخصی به صورت خودکار محاسبه می‌شود.
                    </li>

                    <li class="mb-2">
                        فقط مرخصی‌های تأییدشده از سهمیه کسر می‌شوند.
                    </li>

                    <li>
                        درخواست‌های ردشده سهمیه را مصرف نمی‌کنند.
                    </li>

                </ul>

            </div>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="fw-bold mb-3">
                    <i class="bi bi-shield-check me-1"></i>
                    کنترل‌های سیستم
                </h6>

                <div class="small text-muted">

                    <div class="d-flex mb-2">
                        <i class="bi bi-check2 text-success me-2"></i>
                        بررسی اعتبار تاریخ
                    </div>

                    <div class="d-flex mb-2">
                        <i class="bi bi-check2 text-success me-2"></i>
                        جلوگیری از تداخل مرخصی
                    </div>

                    <div class="d-flex mb-2">
                        <i class="bi bi-check2 text-success me-2"></i>
                        بررسی سهمیه
                    </div>

                    <div class="d-flex">
                        <i class="bi bi-check2 text-success me-2"></i>
                        محاسبه خودکار تعداد روز
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection
