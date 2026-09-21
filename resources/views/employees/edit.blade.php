@extends('layouts.app')

@section('title', 'ویرایش پرسنل')

@section('content')

<div class="breadcrumb">
    <span>مدیریت منابع انسانی</span>
    <span>←</span>
    <span>پرسنل</span>
    <span>←</span>
    <span class="current">ویرایش پرسنل</span>
</div>

<div class="page-header">

    <div>
        <h1>ویرایش پرسنل</h1>

        <p>
            ویرایش اطلاعات {{ $employee->first_name }} {{ $employee->last_name }}
        </p>
    </div>

    <div class="page-actions">

        <a href="{{ route('employees.show', $employee) }}"
           class="btn btn-secondary">
            ← بازگشت
        </a>

    </div>

</div>


{{-- =========================================================
     VALIDATION ERRORS
========================================================= --}}

@if ($errors->any())
    <div class="alert alert-danger">
        <div>
            <strong>خطا در اطلاعات واردشده</strong>

            <ul style="margin:8px 0 0; padding-right:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form action="{{ route('employees.update', $employee) }}"
      method="POST">

    @csrf

    @method('PUT')


    {{-- =====================================================
         PERSONAL INFORMATION
    ====================================================== --}}

    <div class="card section-card">

        <div class="card-header">

            <div style="
                display:flex;
                align-items:center;
                gap:10px;
            ">

                <div class="section-number">
                    ۱
                </div>

                <div class="card-heading">

                    <h2>
                        اطلاعات هویتی
                    </h2>

                    <p>
                        مشخصات شناسنامه‌ای پرسنل
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body">

            <div class="form-grid">


                <div class="form-group">

                    <label class="form-label">
                        نام
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        value="{{ old('first_name', $employee->first_name) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        نام خانوادگی
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        value="{{ old('last_name', $employee->last_name) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        نام پدر
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="father_name"
                        class="form-control"
                        value="{{ old('father_name', $employee->father_name) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        کد ملی
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="national_code"
                        class="form-control"
                        value="{{ old('national_code', $employee->national_code) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        شماره شناسنامه
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="birth_certificate_number"
                        class="form-control"
                        value="{{ old('birth_certificate_number', $employee->birth_certificate_number) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        وضعیت تأهل
                        <span class="required">*</span>
                    </label>

                    <select
                        name="marital_status"
                        class="form-control"
                        required
                    >

                        <option value="">
                            انتخاب وضعیت
                        </option>

                        <option value="مجرد"
                            @selected(old('marital_status', $employee->marital_status) === 'مجرد')>
                            مجرد
                        </option>

                        <option value="متأهل"
                            @selected(old('marital_status', $employee->marital_status) === 'متأهل')>
                            متأهل
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label class="form-label">
                        تاریخ تولد
                        <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="birth_date"
                        class="form-control"
                        value="{{ old('birth_date', optional($employee->birth_date)->format('Y-m-d')) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        تاریخ ارتقاء
                    </label>

                    <input
                        type="date"
                        name="promotion_date"
                        class="form-control"
                        value="{{ old('promotion_date', optional($employee->promotion_date)->format('Y-m-d')) }}"
                    >

                </div>


            </div>

        </div>

    </div>


    {{-- =====================================================
         ORGANIZATIONAL INFORMATION
    ====================================================== --}}

    <div class="card section-card">

        <div class="card-header">

            <div style="
                display:flex;
                align-items:center;
                gap:10px;
            ">

                <div class="section-number">
                    ۲
                </div>

                <div class="card-heading">

                    <h2>
                        اطلاعات سازمانی
                    </h2>

                    <p>
                        مشخصات خدمتی و سازمانی
                    </p>

                </div>

            </div>

        </div>

        <div class="form-group">

    <label class="form-label">
        وضعیت پرسنل
        <span class="required">*</span>
    </label>

    <select
        name="status"
        class="form-control"
        required
    >

        <option value="">
            انتخاب وضعیت
        </option>

        <option
            value="فعال"
            @selected(
                old('status', $employee->status) === 'فعال'
            )
        >
            🟢 فعال
        </option>

        <option
            value="غیرفعال"
            @selected(
                old('status', $employee->status) === 'غیرفعال'
            )
        >
            🔴 غیرفعال
        </option>

        <option
            value="ماموریت"
            @selected(
                old('status', $employee->status) === 'ماموریت'
            )
        >
            🔵 ماموریت
        </option>

        <option
            value="مرخصی"
            @selected(
                old('status', $employee->status) === 'مرخصی'
            )
        >
            🟠 مرخصی
        </option>

    </select>

</div>


        <div class="card-body">

            <div class="form-grid">


                <div class="form-group">

                    <label class="form-label">
                        درجه
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="rank"
                        class="form-control"
                        value="{{ old('rank', $employee->rank) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        شغل
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="job"
                        class="form-control"
                        value="{{ old('job', $employee->job) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        سمت
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="position"
                        class="form-control"
                        value="{{ old('position', $employee->position) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        رسته خدمتی
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="service_branch"
                        class="form-control"
                        value="{{ old('service_branch', $employee->service_branch) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        واحد سازمانی
                    </label>

                    <select
                        name="department_id"
                        class="form-control"
                    >

                        <option value="">
                            بدون واحد سازمانی
                        </option>

                        @foreach($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                @selected(
                                    old(
                                        'department_id',
                                        $employee->department_id
                                    ) == $department->id
                                )
                            >
                                {{ $department->name }}
                            </option>

                        @endforeach

                    </select>

                </div>






   <div class="form-group">

    <label class="form-label">
        مقطع تحصیلی
    </label>

    <select
        name="education_level"
        class="form-control"
    >

        <option value="">
            انتخاب مقطع تحصیلی
        </option>

        <option
            value="دیپلم"
            @selected(
                old(
                    'education_level',
                    $employee->education_level
                ) === 'دیپلم'
            )
        >
            دیپلم
        </option>

        <option
            value="فوق دیپلم"
            @selected(
                old(
                    'education_level',
                    $employee->education_level
                ) === 'فوق دیپلم'
            )
        >
            فوق دیپلم
        </option>

        <option
            value="لیسانس"
            @selected(
                old(
                    'education_level',
                    $employee->education_level
                ) === 'لیسانس'
            )
        >
            لیسانس
        </option>

        <option
            value="فوق لیسانس"
            @selected(
                old(
                    'education_level',
                    $employee->education_level
                ) === 'فوق لیسانس'
            )
        >
            فوق لیسانس
        </option>

        <option
            value="دکتری"
            @selected(
                old(
                    'education_level',
                    $employee->education_level
                ) === 'دکتری'
            )
        >
            دکتری
        </option>

    </select>

</div>


<div class="form-group">

    <label class="form-label">
        رشته تحصیلی
    </label>

    <input
        type="text"
        name="education_field"
        class="form-control"
        value="{{ old('education_field', $employee->education_field) }}"
    >

</div>





    {{-- =====================================================
         CONTACT INFORMATION
    ====================================================== --}}

    <div class="card section-card">

        <div class="card-header">

            <div style="
                display:flex;
                align-items:center;
                gap:10px;
            ">

                <div class="section-number">
                    ۳
                </div>

                <div class="card-heading">

                    <h2>
                        اطلاعات تماس
                    </h2>

                    <p>
                        شماره تماس و آدرس
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body">

            <div class="form-grid">


                <div class="form-group">

                    <label class="form-label">
                        شماره موبایل
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="mobile"
                        class="form-control"
                        value="{{ old('mobile', $employee->mobile) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        موبایل پشتیبان
                    </label>

                    <input
                        type="text"
                        name="backup_mobile"
                        class="form-control"
                        value="{{ old('backup_mobile', $employee->backup_mobile) }}"
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        تلفن منزل
                    </label>

                    <input
                        type="text"
                        name="home_phone"
                        class="form-control"
                        value="{{ old('home_phone', $employee->home_phone) }}"
                    >

                </div>


                <div class="form-group"
                     style="grid-column:1/-1;">

                    <label class="form-label">
                        آدرس منزل
                    </label>

                    <textarea
                        name="home_address"
                        class="form-control"
                        rows="3"
                    >{{ old('home_address', $employee->home_address) }}</textarea>

                </div>


                <div class="form-group"
                     style="grid-column:1/-1;">

                    <label class="form-label">
                        خلاصه سوابق خدمتی
                    </label>

                    <textarea
                        name="service_summary"
                        class="form-control"
                        rows="4"
                    >{{ old('service_summary', $employee->service_summary) }}</textarea>

                </div>


            </div>

        </div>

    </div>


    {{-- =====================================================
         PERSONNEL IDENTIFIERS
    ====================================================== --}}

    <div class="card section-card">

        <div class="card-header">

            <div style="
                display:flex;
                align-items:center;
                gap:10px;
            ">

                <div class="section-number">
                    ۴
                </div>

                <div class="card-heading">

                    <h2>
                        اطلاعات پرسنلی
                    </h2>

                    <p>
                        شناسه‌های اصلی پرسنل
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body">

            <div class="form-grid">

                <div class="form-group">

                    <label class="form-label">
                        شماره پرسنلی
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="personnel_number"
                        class="form-control"
                        value="{{ old('personnel_number', $employee->personnel_number) }}"
                        required
                    >

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         FORM ACTIONS
    ====================================================== --}}

    <div class="card">

        <div class="card-body">

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                gap:15px;
                flex-wrap:wrap;
            ">

                <div>

                    <div style="
                        font-size:11px;
                        font-weight:800;
                    ">
                        ذخیره تغییرات
                    </div>

                    <div style="
                        margin-top:5px;
                        color:var(--gray-500);
                        font-size:8px;
                    ">
                        پس از ذخیره، اطلاعات پرسنل به‌روزرسانی می‌شود.
                    </div>

                </div>


                <div style="
                    display:flex;
                    gap:8px;
                ">

                    <a
                        href="{{ route('employees.show', $employee) }}"
                        class="btn btn-secondary"
                    >
                        انصراف
                    </a>


                    <button
                        type="submit"
                        class="btn btn-gold"
                    >
                        ✓ ذخیره تغییرات
                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection
