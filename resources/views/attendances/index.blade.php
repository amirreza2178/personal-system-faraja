@extends('layouts.app')

@section('title', 'مدیریت حضور و غیاب')

@section('content')

<div class="attendance-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="page-header">

        <div>

            <div class="breadcrumb">

                <span>مدیریت سیستم</span>

                <span>/</span>

                <span>حضور و غیاب</span>

            </div>

            <h1>
                مدیریت حضور و غیاب
            </h1>

            <p>
                ثبت، جستجو و مدیریت وضعیت حضور پرسنل
            </p>

        </div>


        <a
            href="{{ route('attendances.create') }}"
            class="add-attendance-btn"
        >

            <span class="plus">
                +
            </span>

            ثبت حضور جدید

        </a>

    </div>


    {{-- =========================================================
         SUCCESS
    ========================================================== --}}

    @if(session('success'))

        <div class="alert success-alert">

            <div class="alert-icon">
                ✓
            </div>

            <div>

                <strong>
                    عملیات موفق
                </strong>

                <p>
                    {{ session('success') }}
                </p>

            </div>

            <button
                type="button"
                class="close-alert"
                onclick="this.parentElement.remove()"
            >
                ×
            </button>

        </div>

    @endif


    {{-- =========================================================
         ERROR
    ========================================================== --}}

    @if(session('error'))

        <div class="alert error-alert">

            <div class="alert-icon">
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
                class="close-alert"
                onclick="this.parentElement.remove()"
            >
                ×
            </button>

        </div>

    @endif


    {{-- =========================================================
         STATISTICS
    ========================================================== --}}

    <div class="stats-grid">


        <div class="stat-card">

            <div class="stat-icon blue">
                📋
            </div>

            <div>

                <span>
                    کل رکوردها
                </span>

                <strong>
                    {{ number_format($attendancesCount) }}
                </strong>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon green">
                ✓
            </div>

            <div>

                <span>
                    حاضر
                </span>

                <strong>
                    {{ number_format($presentCount) }}
                </strong>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon red">
                ×
            </div>

            <div>

                <span>
                    غایب
                </span>

                <strong>
                    {{ number_format($absentCount) }}
                </strong>

            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon orange">
                ⏱
            </div>

            <div>

                <span>
                    تأخیر
                </span>

                <strong>
                    {{ number_format($lateCount) }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SEARCH
    ========================================================== --}}

    <div class="search-card">

        <div class="search-header">

            <div>

                <div class="search-title">

                    <span class="search-title-icon">
                        🔎
                    </span>

                    <h2>
                        جستجو و فیلتر حضور و غیاب
                    </h2>

                </div>

                <p>
                    رکوردهای حضور پرسنل را بر اساس اطلاعات مختلف پیدا کنید.
                </p>

            </div>


            @if(
                request()->filled('employee_id') ||
                request()->filled('date') ||
                request()->filled('from_date') ||
                request()->filled('to_date') ||
                request()->filled('status')
            )

                <span class="filter-active">
                    فیلتر فعال است
                </span>

            @endif

        </div>


        <form
            action="{{ route('attendances.index') }}"
            method="GET"
            class="search-form"
        >


            {{-- EMPLOYEE --}}

            <div class="search-field">

                <label for="employee_id">
                    پرسنل
                </label>

                <select
                    id="employee_id"
                    name="employee_id"
                >

                    <option value="">
                        همه پرسنل
                    </option>

                    @foreach($employees as $employee)

                        <option
                            value="{{ $employee->id }}"
                            @selected(
                                request('employee_id') == $employee->id
                            )
                        >

                            {{ $employee->first_name }}
                            {{ $employee->last_name }}

                            @if($employee->personnel_number)
                                - {{ $employee->personnel_number }}
                            @endif

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- DATE --}}

            <div class="search-field">

                <label for="date">
                    تاریخ مشخص
                </label>

                <input
                    type="date"
                    id="date"
                    name="date"
                    value="{{ request('date') }}"
                >

            </div>


            {{-- FROM DATE --}}

            <div class="search-field">

                <label for="from_date">
                    از تاریخ
                </label>

                <input
                    type="date"
                    id="from_date"
                    name="from_date"
                    value="{{ request('from_date') }}"
                >

            </div>


            {{-- TO DATE --}}

            <div class="search-field">

                <label for="to_date">
                    تا تاریخ
                </label>

                <input
                    type="date"
                    id="to_date"
                    name="to_date"
                    value="{{ request('to_date') }}"
                >

            </div>


            {{-- STATUS --}}

            <div class="search-field">

                <label for="status">
                    وضعیت
                </label>

                <select
                    id="status"
                    name="status"
                >

                    <option value="">
                        همه وضعیت‌ها
                    </option>

                    <option
                        value="present"
                        @selected(request('status') === 'present')
                    >
                        حاضر
                    </option>

                    <option
                        value="absent"
                        @selected(request('status') === 'absent')
                    >
                        غایب
                    </option>

                    <option
                        value="late"
                        @selected(request('status') === 'late')
                    >
                        تأخیر
                    </option>

                </select>

            </div>


            {{-- ACTIONS --}}

            <div class="search-actions">

                <button
                    type="submit"
                    class="search-btn"
                >
                    🔍
                    جستجو
                </button>


                <a
                    href="{{ route('attendances.index') }}"
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
        request()->filled('employee_id') ||
        request()->filled('date') ||
        request()->filled('from_date') ||
        request()->filled('to_date') ||
        request()->filled('status')
    )

        <div class="active-filters">

            <span class="active-filter-title">
                فیلترهای فعال:
            </span>


            @if(request('employee_id'))

                @php

                    $selectedEmployee = $employees->firstWhere(
                        'id',
                        request('employee_id')
                    );

                @endphp

                <span class="filter-chip">

                    پرسنل:

                    <strong>
                        {{ $selectedEmployee?->first_name }}
                        {{ $selectedEmployee?->last_name }}
                    </strong>

                </span>

            @endif


            @if(request('date'))

                <span class="filter-chip">

                    تاریخ:

                    <strong>
                        {{ request('date') }}
                    </strong>

                </span>

            @endif


            @if(request('from_date'))

                <span class="filter-chip">

                    از:

                    <strong>
                        {{ request('from_date') }}
                    </strong>

                </span>

            @endif


            @if(request('to_date'))

                <span class="filter-chip">

                    تا:

                    <strong>
                        {{ request('to_date') }}
                    </strong>

                </span>

            @endif


            @if(request('status'))

                <span class="filter-chip">

                    وضعیت:

                    <strong>

                        @switch(request('status'))

                            @case('present')
                                حاضر
                                @break

                            @case('absent')
                                غایب
                                @break

                            @case('late')
                                تأخیر
                                @break

                            @default
                                {{ request('status') }}

                        @endswitch

                    </strong>

                </span>

            @endif

        </div>

    @endif


    {{-- =========================================================
         TABLE
    ========================================================== --}}

    <div class="table-card">


        <div class="table-header">

            <div>

                <div class="table-title">

                    <span class="table-title-icon">
                        🕘
                    </span>

                    <h2>
                        فهرست حضور و غیاب
                    </h2>

                </div>

                <p>
                    آخرین رکوردهای ثبت‌شده حضور پرسنل
                </p>

            </div>


            <div class="result-count">

                {{ number_format($attendances->total()) }}

                رکورد

            </div>

        </div>


        @if($attendances->count())


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
                                تاریخ
                            </th>

                            <th>
                                ورود
                            </th>

                            <th>
                                خروج
                            </th>

                            <th>
                                وضعیت
                            </th>

                            <th>
                                توضیحات
                            </th>

                            <th>
                                عملیات
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($attendances as $attendance)

                            <tr>


                                {{-- NUMBER --}}

                                <td>

                                    <span class="row-number">

                                        {{ $attendances->firstItem() + $loop->index }}

                                    </span>

                                </td>


                                {{-- EMPLOYEE --}}

                                <td>

                                    @if($attendance->employee)

                                        <div class="employee-info">

                                            <div class="avatar">

                                                {{ mb_substr(
                                                    $attendance->employee->first_name ?? 'پ',
                                                    0,
                                                    1
                                                ) }}

                                            </div>

                                            <div>

                                                <strong>

                                                    {{ $attendance->employee->first_name }}

                                                    {{ $attendance->employee->last_name }}

                                                </strong>

                                                <small>

                                                    {{ $attendance->employee->personnel_number ?: 'بدون شماره پرسنلی' }}

                                                </small>

                                            </div>

                                        </div>

                                    @else

                                        <span class="no-data">
                                            پرسنل حذف شده
                                        </span>

                                    @endif

                                </td>


                                {{-- DATE --}}

                                <td>

                                    <span class="date-badge">

                                        {{ optional($attendance->date)->format('Y-m-d') ?? $attendance->date }}

                                    </span>

                                </td>


                                {{-- CHECK IN --}}

                                <td>

                                    <span class="time-value">

                                        {{ $attendance->check_in ?? '—' }}

                                    </span>

                                </td>


                                {{-- CHECK OUT --}}

                                <td>

                                    <span class="time-value">

                                        {{ $attendance->check_out ?? '—' }}

                                    </span>

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @switch($attendance->status)

                                        @case('present')

                                            <span class="status-badge present">
                                                <span>✓</span>
                                                حاضر
                                            </span>

                                            @break


                                        @case('absent')

                                            <span class="status-badge absent">
                                                <span>×</span>
                                                غایب
                                            </span>

                                            @break


                                        @case('late')

                                            <span class="status-badge late">
                                                <span>⏱</span>
                                                تأخیر
                                            </span>

                                            @break


                                        @default

                                            <span class="status-badge unknown">
                                                {{ $attendance->status ?: 'نامشخص' }}
                                            </span>

                                    @endswitch

                                </td>


                                {{-- NOTES --}}

                                <td>

                                    @if($attendance->notes)

                                        <span
                                            class="notes"
                                            title="{{ $attendance->notes }}"
                                        >
                                            {{ \Illuminate\Support\Str::limit(
                                                $attendance->notes,
                                                35
                                            ) }}
                                        </span>

                                    @else

                                        <span class="no-data">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}

                                <td>

                                    <div class="actions">


                                        <a
                                            href="{{ route('attendances.show', $attendance) }}"
                                            class="action-btn view"
                                            title="مشاهده"
                                        >
                                            👁
                                        </a>


                                        <a
                                            href="{{ route('attendances.edit', $attendance) }}"
                                            class="action-btn edit"
                                            title="ویرایش"
                                        >
                                            ✏
                                        </a>


                                        <form
                                            action="{{ route('attendances.destroy', $attendance) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این رکورد حضور و غیاب مطمئن هستید؟');"
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


            {{-- =====================================================
                 PAGINATION
            ====================================================== --}}

            <div class="pagination-wrapper">

                <div class="pagination-info">

                    نمایش

                    <strong>
                        {{ $attendances->firstItem() }}
                    </strong>

                    تا

                    <strong>
                        {{ $attendances->lastItem() }}
                    </strong>

                    از

                    <strong>
                        {{ $attendances->total() }}
                    </strong>

                    رکورد

                </div>


                <div class="pagination">

                    @if($attendances->onFirstPage())

                        <span class="page-btn disabled">
                            قبلی
                        </span>

                    @else

                        <a
                            href="{{ $attendances->previousPageUrl() }}"
                            class="page-btn"
                        >
                            قبلی
                        </a>

                    @endif


                    @foreach(
                        $attendances->getUrlRange(
                            max(1, $attendances->currentPage() - 2),
                            min(
                                $attendances->lastPage(),
                                $attendances->currentPage() + 2
                            )
                        ) as $page => $url
                    )

                        @if($page == $attendances->currentPage())

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


                    @if($attendances->hasMorePages())

                        <a
                            href="{{ $attendances->nextPageUrl() }}"
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


            {{-- =====================================================
                 EMPTY STATE
            ====================================================== --}}

            <div class="empty-state">

                <div class="empty-icon">
                    🕘
                </div>


                @if(
                    request()->filled('employee_id') ||
                    request()->filled('date') ||
                    request()->filled('from_date') ||
                    request()->filled('to_date') ||
                    request()->filled('status')
                )

                    <h3>
                        نتیجه‌ای پیدا نشد
                    </h3>

                    <p>
                        با فیلترهای انتخاب‌شده هیچ رکورد حضور و غیابی پیدا نشد.
                    </p>

                    <a
                        href="{{ route('attendances.index') }}"
                        class="empty-btn"
                    >
                        نمایش همه رکوردها
                    </a>

                @else

                    <h3>
                        هنوز رکورد حضور و غیابی ثبت نشده است
                    </h3>

                    <p>
                        برای شروع، اولین رکورد حضور پرسنل را ثبت کنید.
                    </p>

                    <a
                        href="{{ route('attendances.create') }}"
                        class="empty-btn"
                    >
                        ثبت اولین حضور
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>


{{-- =============================================================
     PAGE STYLE
============================================================= --}}

<style>

.attendance-page {

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

    gap: 9px;

    color: #9ca3af;

    font-size: 13px;

    margin-bottom: 9px;

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


.add-attendance-btn {

    height: 48px;

    padding: 0 20px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    border-radius: 13px;

    background: #4f46e5;

    color: white;

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

    box-shadow:
        0 10px 25px rgba(79,70,229,.22);

    transition: .2s;

}


.add-attendance-btn:hover {

    background: #4338ca;

    transform: translateY(-2px);

}


.plus {

    font-size: 21px;

}


/* =========================================================
   ALERTS
========================================================= */

.alert {

    display: flex;

    align-items: center;

    gap: 13px;

    padding: 15px 18px;

    margin-bottom: 20px;

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


.alert-icon {

    width: 37px;

    height: 37px;

    min-width: 37px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    color: white;

    font-weight: 900;

}


.success-alert .alert-icon {
    background: #16a34a;
}


.error-alert .alert-icon {
    background: #dc2626;
}


.alert p {

    margin: 4px 0 0;

    font-size: 12px;

}


.close-alert {

    margin-right: auto;

    border: 0;

    background: transparent;

    font-size: 23px;

    cursor: pointer;

}


/* =========================================================
   STATS
========================================================= */

.stats-grid {

    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 16px;

    margin-bottom: 20px;

}


.stat-card {

    display: flex;

    align-items: center;

    gap: 14px;

    padding: 20px;

    background: white;

    border: 1px solid #e8ecf2;

    border-radius: 18px;

    box-shadow:
        0 8px 25px rgba(20,30,55,.04);

}


.stat-icon {

    width: 50px;

    height: 50px;

    min-width: 50px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 15px;

    font-size: 21px;

    font-weight: 900;

}


.stat-icon.blue {
    background: #eef2ff;
}


.stat-icon.green {
    background: #ecfdf5;
    color: #16a34a;
}


.stat-icon.red {
    background: #fff1f2;
    color: #dc2626;
}


.stat-icon.orange {
    background: #fff7ed;
    color: #ea580c;
}


.stat-card span {

    display: block;

    color: #8b95a6;

    font-size: 12px;

    margin-bottom: 5px;

}


.stat-card strong {

    display: block;

    color: #202a3d;

    font-size: 22px;

}


/* =========================================================
   SEARCH
========================================================= */

.search-card {

    padding: 21px;

    margin-bottom: 16px;

    background: white;

    border: 1px solid #e8ecf2;

    border-radius: 18px;

    box-shadow:
        0 8px 25px rgba(20,30,55,.04);

}


.search-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 19px;

}


.search-title,
.table-title {

    display: flex;

    align-items: center;

    gap: 9px;

}


.search-title h2,
.table-title h2 {

    margin: 0;

    color: #202a3d;

    font-size: 17px;

}


.search-title-icon,
.table-title-icon {

    width: 35px;

    height: 35px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background: #eef2ff;

}


.search-header p,
.table-header p {

    margin: 6px 0 0;

    color: #8b95a6;

    font-size: 12px;

}


.filter-active {

    padding: 7px 11px;

    border-radius: 9px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 11px;

    font-weight: 800;

}


.search-form {

    display: grid;

    grid-template-columns:
        repeat(6, minmax(120px, 1fr));

    gap: 12px;

    align-items: end;

}


.search-field label {

    display: block;

    margin-bottom: 7px;

    color: #596579;

    font-size: 11px;

    font-weight: 800;

}


.search-field input,
.search-field select {

    width: 100%;

    height: 44px;

    padding: 0 11px;

    border: 1px solid #dfe4ec;

    border-radius: 11px;

    outline: none;

    background: #fbfcfe;

    color: #202a3d;

    font-family: inherit;

    font-size: 12px;

    transition: .2s;

}


.search-field input:focus,
.search-field select:focus {

    border-color: #6366f1;

    background: white;

    box-shadow:
        0 0 0 4px rgba(99,102,241,.08);

}


.search-actions {

    display: flex;

    gap: 7px;

}


.search-btn,
.clear-search {

    height: 44px;

    border-radius: 11px;

    font-family: inherit;

    font-size: 11px;

    font-weight: 800;

}


.search-btn {

    flex: 1;

    border: none;

    background: #4f46e5;

    color: white;

    cursor: pointer;

}


.clear-search {

    flex: 1;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    background: #f3f4f6;

    color: #596579;

    text-decoration: none;

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

    font-weight: 800;

}


.filter-chip {

    padding: 6px 10px;

    border-radius: 8px;

    background: white;

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

    background: white;

    border: 1px solid #e8ecf2;

    border-radius: 20px;

    box-shadow:
        0 8px 28px rgba(20,30,55,.045);

}


.table-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 21px 23px;

    border-bottom: 1px solid #edf0f4;

}


.result-count {

    padding: 8px 13px;

    border-radius: 10px;

    background: #f3f4f6;

    color: #596579;

    font-size: 12px;

    font-weight: 800;

}


.table-wrapper {

    width: 100%;

    overflow-x: auto;

}


table {

    width: 100%;

    min-width: 1100px;

    border-collapse: collapse;

}


th {

    padding: 14px 17px;

    background: #fafbfc;

    color: #7d8797;

    font-size: 11px;

    font-weight: 850;

    text-align: right;

    white-space: nowrap;

}


td {

    padding: 15px 17px;

    border-top: 1px solid #f0f2f5;

    color: #374151;

    font-size: 12px;

    vertical-align: middle;

}


tbody tr {

    transition: .15s;

}


tbody tr:hover {

    background: #fafbff;

}


.row-number {

    color: #9ca3af;

    font-weight: 800;

}


/* =========================================================
   EMPLOYEE
========================================================= */

.employee-info {

    display: flex;

    align-items: center;

    gap: 10px;

}


.avatar {

    width: 40px;

    height: 40px;

    min-width: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 12px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 15px;

    font-weight: 900;

}


.employee-info strong {

    display: block;

    color: #202a3d;

    font-size: 12px;

}


.employee-info small {

    display: block;

    margin-top: 4px;

    color: #9ca3af;

    font-size: 10px;

}


.date-badge {

    display: inline-flex;

    padding: 6px 9px;

    border-radius: 8px;

    background: #f8fafc;

    color: #596579;

    font-family: monospace;

    font-weight: 700;

}


.time-value {

    direction: ltr;

    display: inline-block;

    color: #374151;

    font-family: monospace;

    font-weight: 700;

}


.notes {

    display: inline-block;

    max-width: 180px;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

    color: #64748b;

}


/* =========================================================
   STATUS
========================================================= */

.status-badge {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 6px 10px;

    border-radius: 8px;

    font-size: 11px;

    font-weight: 850;

}


.status-badge.present {

    background: #ecfdf5;

    color: #15803d;

}


.status-badge.absent {

    background: #fff1f2;

    color: #be123c;

}


.status-badge.late {

    background: #fff7ed;

    color: #c2410c;

}


.status-badge.unknown {

    background: #f3f4f6;

    color: #6b7280;

}


/* =========================================================
   ACTIONS
========================================================= */

.actions {

    display: flex;

    align-items: center;

    gap: 5px;

}


.actions form {

    margin: 0;

}


.action-btn {

    width: 34px;

    height: 34px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border: none;

    border-radius: 9px;

    text-decoration: none;

    cursor: pointer;

    transition: .18s;

}


.action-btn:hover {

    transform: translateY(-2px);

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


/* =========================================================
   PAGINATION
========================================================= */

.pagination-wrapper {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 18px 22px;

    border-top: 1px solid #edf0f4;

}


.pagination-info {

    color: #8b95a6;

    font-size: 11px;

}


.pagination {

    display: flex;

    align-items: center;

    gap: 5px;

}


.page-number,
.page-btn {

    min-width: 34px;

    height: 34px;

    padding: 0 9px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #f8fafc;

    color: #596579;

    text-decoration: none;

    font-size: 11px;

    font-weight: 800;

}


.page-number.active {

    background: #4f46e5;

    color: white;

}


.page-btn.disabled {

    opacity: .45;

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

    color: white;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1250px) {

    .search-form {

        grid-template-columns:
            repeat(3, 1fr);

    }

}


@media (max-width: 1000px) {

    .stats-grid {

        grid-template-columns:
            repeat(2, 1fr);

    }


    .page-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .add-attendance-btn {

        width: 100%;

    }

}


@media (max-width: 650px) {

    .attendance-page {

        padding: 15px;

    }


    .stats-grid {

        grid-template-columns: 1fr;

    }


    .search-form {

        grid-template-columns: 1fr;

    }


    .search-actions {

        width: 100%;

    }


    .pagination-wrapper {

        flex-direction: column;

        align-items: stretch;

    }


    .pagination {

        justify-content: center;

    }

}

</style>

@endsection
