@extends('layouts.app')

@section('title', 'مدیریت پرسنل')

@section('content')

<div class="employees-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="page-header">

        <div>

            <div class="breadcrumb">

                <span>
                    مدیریت سیستم
                </span>

                <span>/</span>

                <span>
                    پرسنل
                </span>

            </div>

            <h1>
                مدیریت پرسنل
            </h1>

            <p>
                مدیریت، جستجو و مشاهده اطلاعات کارکنان سازمان
            </p>

        </div>


        <a
            href="{{ route('employees.create') }}"
            class="add-employee-btn"
        >

            <span class="plus">
                +
            </span>

            افزودن پرسنل جدید

        </a>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="success-alert">

            <div class="success-icon">
                ✓
            </div>

            <div>

                <strong>
                    عملیات با موفقیت انجام شد
                </strong>

                <p>
                    {{ session('success') }}
                </p>

            </div>

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="close-alert"
            >
                ×
            </button>

        </div>

    @endif


    {{-- =========================================================
         ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div class="error-alert">

            <div class="error-icon">
                !
            </div>

            <div>

                <strong>
                    خطا
                </strong>

                <p>
                    {{ session('error') }}
                </p>

            </div>

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="close-alert"
            >
                ×
            </button>

        </div>

    @endif


    {{-- =========================================================
         VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="error-alert">

            <div class="error-icon">
                !
            </div>

            <div>

                <strong>
                    خطا در اطلاعات
                </strong>

                <ul style="margin:5px 0 0; padding-right:18px;">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="close-alert"
            >
                ×
            </button>

        </div>

    @endif


    {{-- =========================================================
         STATISTICS
    ========================================================== --}}

    <div class="stats-grid">


        {{-- کل پرسنل --}}

        <div class="stat-card">

            <div class="stat-icon blue">
                👥
            </div>

            <div>

                <span>
                    کل پرسنل
                </span>

                <strong>
                    {{ number_format($employeesCount) }}
                </strong>

            </div>

        </div>


        {{-- واحدهای سازمانی --}}

        <div class="stat-card">

            <div class="stat-icon green">
                🏢
            </div>

            <div>

                <span>
                    واحدهای سازمانی
                </span>

                <strong>
                    {{ number_format($departmentsCount) }}
                </strong>

            </div>

        </div>


        {{-- نتیجه فعلی --}}

        <div class="stat-card">

            <div class="stat-icon purple">
                📋
            </div>

            <div>

                <span>
                    نتیجه فعلی
                </span>

                <strong>
                    {{ number_format($employees->total()) }}
                </strong>

            </div>

        </div>


        {{-- فعال --}}

        <div class="stat-card">

            <div class="stat-icon green">
                🟢
            </div>

            <div>

                <span>
                    پرسنل فعال
                </span>

                <strong>
                    {{ number_format($activeEmployeesCount) }}
                </strong>

            </div>

        </div>


        {{-- غیرفعال --}}

        <div class="stat-card">

            <div class="stat-icon red">
                🔴
            </div>

            <div>

                <span>
                    پرسنل غیرفعال
                </span>

                <strong>
                    {{ number_format($inactiveEmployeesCount) }}
                </strong>

            </div>

        </div>


        {{-- ماموریت --}}

        <div class="stat-card">

            <div class="stat-icon blue">
                🔵
            </div>

            <div>

                <span>
                    در مأموریت
                </span>

                <strong>
                    {{ number_format($missionEmployeesCount) }}
                </strong>

            </div>

        </div>


        {{-- مرخصی --}}

        <div class="stat-card">

            <div class="stat-icon orange">
                🟠
            </div>

            <div>

                <span>
                    در مرخصی
                </span>

                <strong>
                    {{ number_format($leaveEmployeesCount) }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =========================================================
         ADVANCED SEARCH
    ========================================================== --}}

    <div class="search-card">

        <div class="search-header">

            <div>

                <h2>
                    جستجو و فیلتر پرسنل
                </h2>

                <p>
                    جستجو بر اساس مشخصات فردی و سازمانی
                </p>

            </div>


            @if(
                request()->filled('first_name') ||
                request()->filled('last_name') ||
                request()->filled('rank') ||
                request()->filled('department_id') ||
                request()->filled('education_level') ||
                request()->filled('status')
            )

                <span class="filter-active">
                    فیلتر فعال است
                </span>

            @endif

        </div>


        <form
            action="{{ route('employees.index') }}"
            method="GET"
            class="search-form"
        >


            {{-- نام --}}

            <div class="search-field">

                <label for="first_name">
                    نام
                </label>

                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ request('first_name') }}"
                    placeholder="مثلاً امیر"
                >

            </div>


            {{-- نام خانوادگی --}}

            <div class="search-field">

                <label for="last_name">
                    نام خانوادگی
                </label>

                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ request('last_name') }}"
                    placeholder="مثلاً رضایی"
                >

            </div>


            {{-- درجه --}}

            <div class="search-field">

                <label for="rank">
                    درجه
                </label>

                <input
                    type="text"
                    id="rank"
                    name="rank"
                    value="{{ request('rank') }}"
                    placeholder="مثلاً ستوان"
                >

            </div>


            {{-- واحد سازمانی --}}

            <div class="search-field">

                <label for="department_id">
                    واحد سازمانی
                </label>

                <select
                    id="department_id"
                    name="department_id"
                >

                    <option value="">
                        همه واحدها
                    </option>

                    @foreach($departments as $department)

                        <option
                            value="{{ $department->id }}"
                            @selected(
                                request('department_id') == $department->id
                            )
                        >
                            {{ $department->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- مقطع تحصیلی --}}

            <div class="search-field">

                <label for="education_level">
                    مقطع تحصیلی
                </label>

                <select
                    id="education_level"
                    name="education_level"
                >

                    <option value="">
                        همه مقاطع
                    </option>

                    <option
                        value="دیپلم"
                        @selected(
                            request('education_level') === 'دیپلم'
                        )
                    >
                        دیپلم
                    </option>

                    <option
                        value="فوق دیپلم"
                        @selected(
                            request('education_level') === 'فوق دیپلم'
                        )
                    >
                        فوق دیپلم
                    </option>

                    <option
                        value="لیسانس"
                        @selected(
                            request('education_level') === 'لیسانس'
                        )
                    >
                        لیسانس
                    </option>

                    <option
                        value="فوق لیسانس"
                        @selected(
                            request('education_level') === 'فوق لیسانس'
                        )
                    >
                        فوق لیسانس
                    </option>

                    <option
                        value="دکتری"
                        @selected(
                            request('education_level') === 'دکتری'
                        )
                    >
                        دکتری
                    </option>

                </select>

            </div>


            {{-- وضعیت --}}

            <div class="search-field">

                <label for="status">
                    وضعیت پرسنل
                </label>

                <select
                    id="status"
                    name="status"
                >

                    <option value="">
                        همه وضعیت‌ها
                    </option>

                    <option
                        value="فعال"
                        @selected(
                            request('status') === 'فعال'
                        )
                    >
                        🟢 فعال
                    </option>

                    <option
                        value="غیرفعال"
                        @selected(
                            request('status') === 'غیرفعال'
                        )
                    >
                        🔴 غیرفعال
                    </option>

                    <option
                        value="ماموریت"
                        @selected(
                            request('status') === 'ماموریت'
                        )
                    >
                        🔵 مأموریت
                    </option>

                    <option
                        value="مرخصی"
                        @selected(
                            request('status') === 'مرخصی'
                        )
                    >
                        🟠 مرخصی
                    </option>

                </select>

            </div>


            {{-- BUTTONS --}}

            <div class="search-actions">

                <button
                    type="submit"
                    class="search-btn"
                >
                    🔍
                    جستجو
                </button>


                <a
                    href="{{ route('employees.index') }}"
                    class="clear-search"
                >
                    ↻
                    پاک کردن
                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
         ACTIVE FILTERS
    ========================================================== --}}

    @if(
        request()->filled('first_name') ||
        request()->filled('last_name') ||
        request()->filled('rank') ||
        request()->filled('department_id') ||
        request()->filled('education_level') ||
        request()->filled('status')
    )

        <div class="active-filters">

            <span class="active-filter-title">
                فیلترهای فعال:
            </span>


            {{-- نام --}}

            @if(request('first_name'))

                <span class="filter-chip">

                    نام:

                    <strong>
                        {{ request('first_name') }}
                    </strong>

                </span>

            @endif


            {{-- نام خانوادگی --}}

            @if(request('last_name'))

                <span class="filter-chip">

                    نام خانوادگی:

                    <strong>
                        {{ request('last_name') }}
                    </strong>

                </span>

            @endif


            {{-- درجه --}}

            @if(request('rank'))

                <span class="filter-chip">

                    درجه:

                    <strong>
                        {{ request('rank') }}
                    </strong>

                </span>

            @endif


            {{-- واحد --}}

            @if(request('department_id'))

                @php

                    $selectedDepartment = $departments->firstWhere(
                        'id',
                        request('department_id')
                    );

                @endphp

                <span class="filter-chip">

                    واحد:

                    <strong>
                        {{ $selectedDepartment?->name ?? 'نامشخص' }}
                    </strong>

                </span>

            @endif


            {{-- تحصیلات --}}

            @if(request('education_level'))

                <span class="filter-chip">

                    تحصیلات:

                    <strong>
                        {{ request('education_level') }}
                    </strong>

                </span>

            @endif


            {{-- وضعیت --}}

            @if(request('status'))

                <span class="filter-chip">

                    وضعیت:

                    <strong>
                        {{ request('status') }}
                    </strong>

                </span>

            @endif

        </div>

    @endif


    {{-- =========================================================
         TABLE CARD
    ========================================================== --}}

    <div class="table-card">


        {{-- TABLE HEADER --}}

        <div class="table-header">

            <div>

                <h2>
                    فهرست پرسنل
                </h2>

                <p>

                    @if(
                        request()->filled('first_name') ||
                        request()->filled('last_name') ||
                        request()->filled('rank') ||
                        request()->filled('department_id') ||
                        request()->filled('education_level') ||
                        request()->filled('status')
                    )

                        نتایج بر اساس فیلترهای انتخاب‌شده

                    @else

                        فهرست تمامی پرسنل ثبت‌شده

                    @endif

                </p>

            </div>


            <div class="result-count">

                {{ number_format($employees->total()) }}

                رکورد

            </div>

        </div>


        {{-- =====================================================
             TABLE
        ====================================================== --}}

        @if($employees->count())

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                پرسنل
                            </th>

                            <th>
                                شماره پرسنلی
                            </th>

                            <th>
                                درجه
                            </th>

                            <th>
                                وضعیت
                            </th>

                            <th>
                                مقطع تحصیلی
                            </th>

                            <th>
                                واحد سازمانی
                            </th>

                            <th>
                                موبایل
                            </th>

                            <th>
                                عملیات
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($employees as $employee)

                            <tr>


                                {{-- NUMBER --}}

                                <td>

                                    <span class="row-number">

                                        {{ $employees->firstItem() + $loop->index }}

                                    </span>

                                </td>


                                {{-- EMPLOYEE --}}

                                <td>

                                    <div class="employee-info">

                                        <div class="avatar">

                                            {{ mb_substr(
                                                $employee->first_name ?? 'پ',
                                                0,
                                                1
                                            ) }}

                                        </div>


                                        <div>

                                            <strong>

                                                {{ $employee->first_name }}

                                                {{ $employee->last_name }}

                                            </strong>

                                            <small>

                                                نام پدر:

                                                {{ $employee->father_name ?: 'ثبت نشده' }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- PERSONNEL NUMBER --}}

                                <td>

                                    <span class="personnel-number">

                                        {{ $employee->personnel_number ?: '—' }}

                                    </span>

                                </td>


                                {{-- RANK --}}

                                <td>

                                    @if($employee->rank)

                                        <span class="rank-badge">

                                            {{ $employee->rank }}

                                        </span>

                                    @else

                                        <span class="no-data">
                                            ثبت نشده
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($employee->status === 'فعال')

                                        <span class="status-badge status-active">

                                            <span class="status-dot"></span>

                                            فعال

                                        </span>


                                    @elseif($employee->status === 'غیرفعال')

                                        <span class="status-badge status-inactive">

                                            <span class="status-dot"></span>

                                            غیرفعال

                                        </span>


                                    @elseif($employee->status === 'ماموریت')

                                        <span class="status-badge status-mission">

                                            <span class="status-dot"></span>

                                            مأموریت

                                        </span>


                                    @elseif($employee->status === 'مرخصی')

                                        <span class="status-badge status-leave">

                                            <span class="status-dot"></span>

                                            مرخصی

                                        </span>


                                    @else

                                        <span class="no-data">
                                            ثبت نشده
                                        </span>

                                    @endif

                                </td>


                                {{-- EDUCATION --}}

                                <td>

                                    @if($employee->education_level)

                                        <span class="education-badge">

                                            {{ $employee->education_level }}

                                        </span>

                                    @else

                                        <span class="no-data">
                                            ثبت نشده
                                        </span>

                                    @endif

                                </td>


                                {{-- DEPARTMENT --}}

                                <td>

                                    @if($employee->department)

                                        <span class="department-name">

                                            {{ $employee->department->name }}

                                        </span>

                                    @else

                                        <span class="no-department">
                                            بدون واحد
                                        </span>

                                    @endif

                                </td>


                                {{-- MOBILE --}}

                                <td>

                                    @if($employee->mobile)

                                        <span class="mobile-number">

                                            {{ $employee->mobile }}

                                        </span>

                                    @else

                                        <span class="no-data">
                                            ثبت نشده
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}

                                <td>

                                    <div class="actions">


                                        {{-- SHOW --}}

                                        <a
                                            href="{{ route('employees.show', $employee) }}"
                                            class="action-btn view"
                                            title="مشاهده"
                                        >
                                            👁
                                        </a>


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route('employees.edit', $employee) }}"
                                            class="action-btn edit"
                                            title="ویرایش"
                                        >
                                            ✏
                                        </a>


                                        {{-- DELETE --}}

                                        <form
                                            action="{{ route('employees.destroy', $employee) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این پرسنل مطمئن هستید؟');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete"
                                                title="حذف"
                                            >
                                                🗑
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                 PAGINATION
            ================================================== --}}

            <div class="pagination-wrapper">

                <div class="pagination-info">

                    نمایش

                    <strong>
                        {{ $employees->firstItem() }}
                    </strong>

                    تا

                    <strong>
                        {{ $employees->lastItem() }}
                    </strong>

                    از

                    <strong>
                        {{ $employees->total() }}
                    </strong>

                    پرسنل

                </div>


                <div class="pagination">


                    {{-- PREVIOUS --}}

                    @if($employees->onFirstPage())

                        <span class="page-btn disabled">
                            قبلی
                        </span>

                    @else

                        <a
                            href="{{ $employees->previousPageUrl() }}"
                            class="page-btn"
                        >
                            قبلی
                        </a>

                    @endif


                    {{-- PAGE NUMBERS --}}

                    @foreach(
                        $employees->getUrlRange(
                            max(
                                1,
                                $employees->currentPage() - 2
                            ),
                            min(
                                $employees->lastPage(),
                                $employees->currentPage() + 2
                            )
                        ) as $page => $url
                    )

                        @if($page == $employees->currentPage())

                            <span class="page-number active">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="page-number"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    {{-- NEXT --}}

                    @if($employees->hasMorePages())

                        <a
                            href="{{ $employees->nextPageUrl() }}"
                            class="page-btn"
                        >
                            بعدی
                        </a>

                    @else

                        <span class="page-btn disabled">
                            بعدی
                        </span>

                    @endif

                </div>

            </div>


        @else


            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="empty-state">

                <div class="empty-icon">
                    👥
                </div>


                @if(
                    request()->filled('first_name') ||
                    request()->filled('last_name') ||
                    request()->filled('rank') ||
                    request()->filled('department_id') ||
                    request()->filled('education_level') ||
                    request()->filled('status')
                )

                    <h3>
                        نتیجه‌ای پیدا نشد
                    </h3>

                    <p>
                        با فیلترهای انتخاب‌شده هیچ پرسنلی پیدا نشد.
                    </p>

                    <a
                        href="{{ route('employees.index') }}"
                        class="empty-btn"
                    >
                        نمایش همه پرسنل
                    </a>

                @else

                    <h3>
                        هنوز پرسنلی ثبت نشده است
                    </h3>

                    <p>
                        برای شروع، اولین پرسنل سیستم را ثبت کنید.
                    </p>

                    <a
                        href="{{ route('employees.create') }}"
                        class="empty-btn"
                    >
                        افزودن اولین پرسنل
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>




<style>

* {
    box-sizing: border-box;
}

.employees-page {

    direction: rtl;

    width: 100%;

    max-width: 1450px;

    margin: auto;

    padding: 30px;
}


/* =========================================================
   HEADER
========================================================= */

.page-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 25px;
}


.breadcrumb {

    display: flex;

    gap: 8px;

    color: #9ca3af;

    font-size: 13px;

    margin-bottom: 9px;
}


.breadcrumb span {
    color: #c4cad4;
}


.page-header h1 {

    margin: 0;

    color: #182235;

    font-size: 29px;

    font-weight: 850;
}


.page-header p {

    margin: 7px 0 0;

    color: #8b95a6;

    font-size: 14px;
}


.add-employee-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    padding: 0 20px;

    height: 48px;

    border-radius: 13px;

    background: #4f46e5;

    color: #fff;

    text-decoration: none;

    font-size: 14px;

    font-weight: 750;

    box-shadow:
        0 9px 22px rgba(79,70,229,.22);

    transition: .2s;
}


.add-employee-btn:hover {

    background: #4338ca;

    transform: translateY(-2px);
}


.plus {

    font-size: 21px;

    line-height: 1;
}


/* =========================================================
   ALERTS
========================================================= */

.success-alert,
.error-alert {

    display: flex;

    align-items: center;

    gap: 13px;

    padding: 15px 18px;

    margin-bottom: 22px;

    border-radius: 15px;
}


.success-alert {

    background: #ecfdf5;

    border: 1px solid #bbf7d0;

    color: #166534;
}


.error-alert {

    background: #fef2f2;

    border: 1px solid #fecaca;

    color: #991b1b;
}


.success-icon,
.error-icon {

    width: 36px;

    height: 36px;

    min-width: 36px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    color: white;

    font-weight: 900;
}


.success-icon {
    background: #16a34a;
}


.error-icon {
    background: #dc2626;
}


.success-alert p,
.error-alert p {

    margin: 4px 0 0;

    font-size: 13px;
}


.close-alert {

    margin-right: auto;

    border: none;

    background: transparent;

    font-size: 23px;

    cursor: pointer;
}


/* =========================================================
   STATISTICS
========================================================= */

.stats-grid {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 17px;

    margin-bottom: 20px;
}


.stat-card {

    display: flex;

    align-items: center;

    gap: 15px;

    padding: 21px;

    background: #fff;

    border: 1px solid #e8ecf2;

    border-radius: 18px;

    box-shadow:
        0 7px 25px rgba(20,30,55,.04);
}


.stat-icon {

    width: 50px;

    height: 50px;

    min-width: 50px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 15px;

    font-size: 22px;
}


.stat-icon.blue {
    background: #eef2ff;
}


.stat-icon.green {
    background: #ecfdf5;
}


.stat-icon.purple {
    background: #f5f3ff;
}


.stat-card span {

    display: block;

    color: #8b95a6;

    font-size: 13px;

    margin-bottom: 5px;
}


.stat-card strong {

    display: block;

    color: #1f2937;

    font-size: 23px;
}


/* =========================================================
   SEARCH
========================================================= */

.search-card {

    padding: 20px;

    margin-bottom: 16px;

    background: #fff;

    border: 1px solid #e8ecf2;

    border-radius: 18px;

    box-shadow:
        0 7px 25px rgba(20,30,55,.04);
}


.search-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 18px;
}


.search-header h2 {

    margin: 0;

    color: #202a3d;

    font-size: 17px;
}


.search-header p {

    margin: 5px 0 0;

    color: #8b95a6;

    font-size: 12px;
}


.filter-active {

    padding: 7px 11px;

    border-radius: 9px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 11px;

    font-weight: 750;
}


.search-form {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(150px, 1fr));

    gap: 13px;

    align-items: end;
}


.search-field {

    min-width: 0;
}


.search-field label {

    display: block;

    margin-bottom: 7px;

    color: #596579;

    font-size: 12px;

    font-weight: 750;
}


.search-field input,
.search-field select {

    width: 100%;

    height: 45px;

    padding: 0 12px;

    border: 1px solid #dfe4ec;

    border-radius: 11px;

    outline: none;

    background: #fbfcfe;

    color: #202a3d;

    font-family: inherit;

    font-size: 13px;

    transition: .2s;
}


.search-field input:focus,
.search-field select:focus {

    border-color: #6366f1;

    background: #fff;

    box-shadow:
        0 0 0 4px rgba(99,102,241,.08);
}


.search-field input::placeholder {

    color: #a0a8b5;
}


.search-actions {

    display: flex;

    align-items: center;

    gap: 7px;

    min-height: 45px;
}


.search-btn {

    height: 45px;

    padding: 0 17px;

    border: none;

    border-radius: 11px;

    background: #4f46e5;

    color: #fff;

    font-family: inherit;

    font-size: 12px;

    font-weight: 750;

    cursor: pointer;

    transition: .2s;
}


.search-btn:hover {

    background: #4338ca;

    transform: translateY(-1px);
}


.clear-search {

    height: 45px;

    padding: 0 13px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: #f3f4f6;

    color: #596579;

    text-decoration: none;

    font-size: 12px;

    font-weight: 700;

    transition: .2s;
}


.clear-search:hover {

    background: #e5e7eb;
}


/* =========================================================
   ACTIVE FILTERS
========================================================= */

.active-filters {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 7px;

    margin-bottom: 16px;

    padding: 11px 14px;

    background: #f8fafc;

    border: 1px solid #e8ecf2;

    border-radius: 12px;
}


.active-filter-title {

    color: #64748b;

    font-size: 11px;

    font-weight: 700;
}


.filter-chip {

    padding: 6px 10px;

    border-radius: 8px;

    background: #fff;

    border: 1px solid #e2e8f0;

    color: #64748b;

    font-size: 11px;
}


.filter-chip strong {

    color: #4f46e5;
}


/* =========================================================
   TABLE
========================================================= */

.table-card {

    overflow: hidden;

    background: #fff;

    border: 1px solid #e8ecf2;

    border-radius: 20px;

    box-shadow:
        0 8px 28px rgba(20,30,55,.045);
}


.table-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 22px 24px;

    border-bottom: 1px solid #edf0f4;
}


.table-header h2 {

    margin: 0;

    color: #202a3d;

    font-size: 18px;
}


.table-header p {

    margin: 5px 0 0;

    color: #8b95a6;

    font-size: 13px;
}


.result-count {

    padding: 8px 13px;

    border-radius: 10px;

    background: #f3f4f6;

    color: #596579;

    font-size: 13px;

    font-weight: 700;
}


.table-wrapper {

    width: 100%;

    overflow-x: auto;
}


table {

    width: 100%;

    border-collapse: collapse;

    min-width: 1200px;
}


th {

    padding: 15px 18px;

    background: #fafbfc;

    color: #7d8797;

    font-size: 12px;

    font-weight: 800;

    text-align: right;

    white-space: nowrap;
}


td {

    padding: 16px 18px;

    border-top: 1px solid #f0f2f5;

    color: #374151;

    font-size: 13px;

    vertical-align: middle;
}


tbody tr {

    transition: background .15s;
}


tbody tr:hover {

    background: #fafbff;
}


.row-number {

    color: #9ca3af;

    font-weight: 700;
}


/* =========================================================
   EMPLOYEE
========================================================= */

.employee-info {

    display: flex;

    align-items: center;

    gap: 11px;
}


.avatar {

    width: 42px;

    height: 42px;

    min-width: 42px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 12px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 16px;

    font-weight: 900;
}


.employee-info strong {

    display: block;

    color: #202a3d;

    font-size: 13px;
}


.employee-info small {

    display: block;

    margin-top: 4px;

    color: #9ca3af;

    font-size: 11px;
}


.personnel-number,
.national-code {

    font-family: monospace;

    color: #4b5563;

    font-weight: 700;

    direction: ltr;

    display: inline-block;
}


/* =========================================================
   BADGES
========================================================= */

.rank-badge {

    display: inline-flex;

    padding: 6px 10px;

    border-radius: 8px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 11px;

    font-weight: 750;
}


.education-badge {

    display: inline-flex;

    padding: 6px 10px;

    border-radius: 8px;

    background: #f5f3ff;

    color: #6d28d9;

    font-size: 11px;

    font-weight: 750;
}


.department-name {

    color: #374151;

    font-weight: 650;
}


.no-department,
.no-data {

    color: #9ca3af;

    font-size: 12px;
}


.mobile-number {

    direction: ltr;

    display: inline-block;

    color: #596579;
}


/* =========================================================
   ACTIONS
========================================================= */

.actions {

    display: flex;

    align-items: center;

    gap: 6px;
}


.actions form {

    margin: 0;

    padding: 0;
}


.action-btn {

    width: 35px;

    height: 35px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border: none;

    border-radius: 9px;

    text-decoration: none;

    cursor: pointer;

    transition: .18s;

    font-size: 14px;
}


.action-btn.view {
    background: #eff6ff;
}


.action-btn.edit {
    background: #fffbeb;
}


.action-btn.delete {
    background: #fff1f2;
}


.action-btn:hover {

    transform: translateY(-2px);
}


/* =========================================================
   PAGINATION
========================================================= */

.pagination-wrapper {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 19px 23px;

    border-top: 1px solid #edf0f4;
}


.pagination-info {

    color: #8b95a6;

    font-size: 12px;
}


.pagination {

    display: flex;

    align-items: center;

    gap: 5px;
}


.page-number,
.page-btn {

    min-width: 35px;

    height: 35px;

    padding: 0 10px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    color: #596579;

    background: #f8fafc;

    text-decoration: none;

    font-size: 12px;

    font-weight: 700;
}


.page-number.active {

    background: #4f46e5;

    color: white;
}


.page-btn.disabled {

    opacity: .45;

    cursor: not-allowed;
}


.page-number:hover,
.page-btn:not(.disabled):hover {

    background: #e9e7ff;

    color: #4f46e5;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-state {

    text-align: center;

    padding: 70px 20px;
}


.empty-icon {

    width: 80px;

    height: 80px;

    margin: 0 auto 18px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 25px;

    background: #eef2ff;

    font-size: 32px;
}


.empty-state h3 {

    margin: 0;

    color: #202a3d;

    font-size: 18px;
}


.empty-state p {

    margin: 9px 0 20px;

    color: #8b95a6;

    font-size: 13px;
}


.empty-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    height: 43px;

    padding: 0 19px;

    border-radius: 11px;

    background: #4f46e5;

    color: #fff;

    text-decoration: none;

    font-size: 13px;

    font-weight: 750;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1200px) {

    .search-form {

        grid-template-columns:
            repeat(3, minmax(150px, 1fr));

    }

}


@media (max-width: 900px) {

    .employees-page {

        padding: 20px;

    }


    .stats-grid {

        grid-template-columns: 1fr;

    }


    .page-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .add-employee-btn {

        width: 100%;

    }


    .search-form {

        grid-template-columns: 1fr 1fr;

    }


    .search-actions {

        grid-column: span 2;

    }


    .pagination-wrapper {

        flex-direction: column;

        align-items: stretch;

    }


    .pagination {

        justify-content: center;

    }

}


@media (max-width: 600px) {

    .employees-page {

        padding: 13px;

    }


    .page-header h1 {

        font-size: 23px;

    }


    .search-form {

        grid-template-columns: 1fr;

    }


    .search-actions {

        grid-column: auto;

        width: 100%;

    }


    .search-btn,
    .clear-search {

        flex: 1;

    }


    .search-header {

        align-items: flex-start;

        flex-direction: column;

    }

    /* =========================================================
   STATUS BADGES
========================================================= */

.status-badge {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 6px 10px;

    border-radius: 8px;

    font-size: 11px;

    font-weight: 800;

    white-space: nowrap;
}


.status-active {

    background: #ecfdf5;

    color: #15803d;

}


.status-inactive {

    background: #fef2f2;

    color: #dc2626;

}


.status-mission {

    background: #eff6ff;

    color: #2563eb;

}


.status-leave {

    background: #fffbeb;

    color: #d97706;

}

.status-badge {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 7px 12px;

    border-radius: 10px;

    font-size: 11px;

    font-weight: 850;

}


.status-dot {

    width: 7px;

    height: 7px;

    border-radius: 50%;

    display: inline-block;

}


.status-active {

    background: #ecfdf5;

    color: #15803d;

}

.status-active .status-dot {
    background: #22c55e;
}


.status-inactive {

    background: #fef2f2;

    color: #dc2626;

}

.status-inactive .status-dot {
    background: #ef4444;
}


.status-mission {

    background: #eff6ff;

    color: #2563eb;

}

.status-mission .status-dot {
    background: #3b82f6;
}


.status-leave {

    background: #fffbeb;

    color: #d97706;

}

.status-leave .status-dot {
    background: #f59e0b;
}

.stat-icon.red {
    background: #fef2f2;
}

.stat-icon.orange {
    background: #fff7ed;
}

}

</style>

@endsection
