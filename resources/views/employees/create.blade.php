@extends('layouts.app')

@section('title', 'ثبت پرسنل جدید')

@section('content')

    {{-- =========================================================
         BREADCRUMB
    ========================================================= --}}
    <div class="breadcrumb">
        <span>مدیریت منابع انسانی</span>
        <span>←</span>
        <span class="current">ثبت پرسنل جدید</span>
    </div>


    {{-- =========================================================
         PAGE HEADER
    ========================================================= --}}
    <div class="page-header">

        <div>
            <h1>ثبت پرسنل جدید</h1>

            <p>
                اطلاعات پرسنل را با دقت وارد کنید.
            </p>
        </div>

        <div class="page-actions">

            <a href="{{ route('employees.index') }}"
               class="btn btn-secondary">

                ←
                بازگشت به لیست پرسنل

            </a>

        </div>

    </div>


    {{-- =========================================================
         VALIDATION ERRORS
    ========================================================= --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <span>!</span>

            <div>

                <strong>
                    اطلاعات وارد شده دارای خطا است.
                </strong>

                <ul style="
                    margin-top:8px;
                    padding-right:18px;
                ">

                    @foreach ($errors->all() as $error)

                        <li style="margin-bottom:4px;">
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    <form action="{{ route('employees.store') }}"
          method="POST">

        @csrf


        {{-- =====================================================
             SECTION 01
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
                            اطلاعات شناسنامه‌ای و فردی پرسنل
                        </p>

                    </div>

                </div>

            </div>


            <div class="card-body">

                <div class="form-grid">


                    {{-- FIRST NAME --}}
                    <div class="form-group">

                        <label class="form-label">
                            نام
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="first_name"
                            class="form-control"
                            value="{{ old('first_name') }}"
                            placeholder="مثلاً امیررضا"
                            required
                        >

                    </div>


                    {{-- LAST NAME --}}
                    <div class="form-group">

                        <label class="form-label">
                            نام خانوادگی
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="last_name"
                            class="form-control"
                            value="{{ old('last_name') }}"
                            placeholder="مثلاً رضایی"
                            required
                        >

                    </div>


                    {{-- FATHER NAME --}}
                    <div class="form-group">

                        <label class="form-label">
                            نام پدر
                        </label>

                        <input
                            type="text"
                            name="father_name"
                            class="form-control"
                            value="{{ old('father_name') }}"
                            placeholder="نام پدر"
                        >

                    </div>


                    {{-- NATIONAL CODE --}}
                    <div class="form-group">

                        <label class="form-label">
                            کد ملی
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="national_code"
                            class="form-control"
                            value="{{ old('national_code') }}"
                            placeholder="۱۰ رقم"
                            maxlength="10"
                            required
                        >

                    </div>


                    {{-- BIRTH CERTIFICATE --}}
                    <div class="form-group">

                        <label class="form-label">
                            شماره شناسنامه
                        </label>

                        <input
                            type="text"
                            name="birth_certificate_number"
                            class="form-control"
                            value="{{ old('birth_certificate_number') }}"
                            placeholder="شماره شناسنامه"
                        >

                    </div>


                    {{-- BIRTH DATE --}}
                    <div class="form-group">

                        <label class="form-label">
                            تاریخ تولد
                        </label>

                        <input
                            type="date"
                            name="birth_date"
                            class="form-control"
                            value="{{ old('birth_date') }}"
                        >

                    </div>


                    {{-- MARITAL STATUS --}}
                    <div class="form-group">

                        <label class="form-label">
                            وضعیت تأهل
                        </label>

                        <select
                            name="marital_status"
                            class="form-control"
                        >

                            <option value="">
                                انتخاب کنید
                            </option>

                            <option
                                value="single"
                                {{ old('marital_status') == 'single' ? 'selected' : '' }}
                            >
                                مجرد
                            </option>

                            <option
                                value="married"
                                {{ old('marital_status') == 'married' ? 'selected' : '' }}
                            >
                                متأهل
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
             SECTION 02
             SERVICE INFORMATION
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
                            اطلاعات خدمتی
                        </h2>

                        <p>
                            اطلاعات مربوط به وضعیت و سوابق خدمتی
                        </p>

                    </div>

                </div>

            </div>


            <div class="card-body">

                <div class="form-grid">


                    {{-- PERSONNEL NUMBER --}}
                    <div class="form-group">

                        <label class="form-label">
                            شماره پرسنلی
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="personnel_number"
                            class="form-control"
                            value="{{ old('personnel_number') }}"
                            placeholder="شماره پرسنلی"
                            required
                        >

                    </div>


                    {{-- RANK --}}
                    <div class="form-group">

                        <label class="form-label">
                            درجه
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="rank"
                            class="form-control"
                            value="{{ old('rank') }}"
                            placeholder="درجه پرسنل"
                            required
                        >

                    </div>


                    {{-- PROMOTION DATE --}}
                    <div class="form-group">

                        <label class="form-label">
                            تاریخ ارتقاء
                        </label>

                        <input
                            type="date"
                            name="promotion_date"
                            class="form-control"
                            value="{{ old('promotion_date') }}"
                        >

                    </div>


                    {{-- SERVICE BRANCH --}}
                    <div class="form-group">

                        <label class="form-label">
                            رسته خدمتی
                        </label>

                        <input
                            type="text"
                            name="service_branch"
                            class="form-control"
                            value="{{ old('service_branch') }}"
                            placeholder="رسته خدمتی"
                        >

                    </div>


                    {{-- JOB --}}
                    <div class="form-group">

                        <label class="form-label">
                            شغل
                        </label>

                        <input
                            type="text"
                            name="job"
                            class="form-control"
                            value="{{ old('job') }}"
                            placeholder="عنوان شغلی"
                        >

                    </div>


                    {{-- POSITION --}}
                    <div class="form-group">

                        <label class="form-label">
                            سمت
                        </label>

                        <input
                            type="text"
                            name="position"
                            class="form-control"
                            value="{{ old('position') }}"
                            placeholder="سمت سازمانی"
                        >

                    </div>


                    {{-- SERVICE SUMMARY --}}
                    <div class="form-group"
                         style="grid-column:1/-1;">

                        <label class="form-label">
                            خلاصه سوابق خدمتی
                        </label>

                        <textarea
                            name="service_summary"
                            class="form-control"
                            rows="4"
                            placeholder="خلاصه‌ای از سوابق خدمتی پرسنل..."
                        >{{ old('service_summary') }}</textarea>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
             SECTION 03
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
                        ۳
                    </div>

                    <div class="card-heading">

                        <h2>
                            اطلاعات سازمانی
                        </h2>

                        <p>
                            واحد سازمانی محل خدمت پرسنل
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
            @selected(old('status') === 'فعال')
        >
            🟢 فعال
        </option>

        <option
            value="غیرفعال"
            @selected(old('status') === 'غیرفعال')
        >
            🔴 غیرفعال
        </option>

        <option
            value="ماموریت"
            @selected(old('status') === 'ماموریت')
        >
            🔵 ماموریت
        </option>

        <option
            value="مرخصی"
            @selected(old('status') === 'مرخصی')
        >
            🟠 مرخصی
        </option>

    </select>

</div>

            <div class="card-body">

                <div class="form-grid">


                    {{-- DEPARTMENT --}}
                    <div class="form-group">

    <label for="department_id">
        واحد سازمانی
        <span>*</span>
    </label>

    <select
        id="department_id"
        name="department_id"
        required
    >

        <option value="">
            انتخاب واحد سازمانی
        </option>

        @foreach($departments as $department)

            <option
                value="{{ $department->id }}"
                @selected(
                    old('department_id') == $department->id
                )
            >
                {{ $department->name }}
            </option>

        @endforeach

    </select>

</div>



                </div>

            </div>

        </div>



        {{-- =====================================================
             SECTION 04
             EDUCATION
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
                            اطلاعات تحصیلی
                        </h2>

                        <p>
                            مقطع و رشته تحصیلی پرسنل
                        </p>

                    </div>

                </div>

            </div>


            <div class="card-body">

                <div class="form-grid">


                    {{-- EDUCATION LEVEL --}}
                    <div class="form-group">

                        <label class="form-label">
                            مقطع تحصیلی
                        </label>

                        <select
                            name="education_level"
                            class="form-control"
                        >

                            <option value="">
                                انتخاب مقطع
                            </option>

                            <option
                                value="دیپلم"
                                {{ old('education_level') == 'دیپلم' ? 'selected' : '' }}
                            >
                                دیپلم
                            </option>

                            <option
                                value="فوق دیپلم"
                                {{ old('education_level') == 'فوق دیپلم' ? 'selected' : '' }}
                            >
                                فوق دیپلم
                            </option>

                            <option
                                value="لیسانس"
                                {{ old('education_level') == 'لیسانس' ? 'selected' : '' }}
                            >
                                لیسانس
                            </option>

                            <option
                                value="فوق لیسانس"
                                {{ old('education_level') == 'فوق لیسانس' ? 'selected' : '' }}
                            >
                                فوق لیسانس
                            </option>

                            <option
                                value="دکتری"
                                {{ old('education_level') == 'دکتری' ? 'selected' : '' }}
                            >
                                دکتری
                            </option>

                        </select>

                    </div>


                    {{-- EDUCATION FIELD --}}
                    <div class="form-group">

                        <label class="form-label">
                            رشته تحصیلی
                        </label>

                        <input
                            type="text"
                            name="education_field"
                            class="form-control"
                            value="{{ old('education_field') }}"
                            placeholder="مثلاً مهندسی کامپیوتر"
                        >

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
             SECTION 05
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
                        ۵
                    </div>

                    <div class="card-heading">

                        <h2>
                            اطلاعات تماس و نشانی
                        </h2>

                        <p>
                            راه‌های ارتباطی و محل سکونت
                        </p>

                    </div>

                </div>

            </div>


            <div class="card-body">

                <div class="form-grid">


                    {{-- MOBILE --}}
                    <div class="form-group">

                        <label class="form-label">
                            موبایل
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="mobile"
                            class="form-control"
                            value="{{ old('mobile') }}"
                            placeholder="09xxxxxxxxx"
                            required
                        >

                    </div>


                    {{-- BACKUP MOBILE --}}
                    <div class="form-group">

                        <label class="form-label">
                            موبایل دوم
                        </label>

                        <input
                            type="text"
                            name="backup_mobile"
                            class="form-control"
                            value="{{ old('backup_mobile') }}"
                            placeholder="شماره تماس دوم"
                        >

                    </div>


                    {{-- HOME PHONE --}}
                    <div class="form-group">

                        <label class="form-label">
                            تلفن ثابت
                        </label>

                        <input
                            type="text"
                            name="home_phone"
                            class="form-control"
                            value="{{ old('home_phone') }}"
                            placeholder="شماره تلفن ثابت"
                        >

                    </div>


                    {{-- ADDRESS --}}
                    <div class="form-group"
                         style="grid-column:1/-1;">

                        <label class="form-label">
                            آدرس منزل
                        </label>

                        <textarea
                            name="home_address"
                            class="form-control"
                            rows="4"
                            placeholder="نشانی کامل محل سکونت..."
                        >{{ old('home_address') }}</textarea>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
             FORM ACTIONS
        ====================================================== --}}
        <div class="card">

            <div class="card-footer"
                 style="
                    justify-content:flex-start;
                    gap:10px;
                 ">

                <button
                    type="submit"
                    class="btn btn-gold"
                >

                    ✓
                    ثبت پرسنل

                </button>


                <a
                    href="{{ route('employees.index') }}"
                    class="btn btn-secondary"
                >

                    انصراف

                </a>

            </div>

        </div>

    </form>

@endsection
