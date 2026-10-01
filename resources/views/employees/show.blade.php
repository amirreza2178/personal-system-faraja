@extends('layouts.app')

@section('title', 'جزئیات پرسنل')

@section('content')

<div class="breadcrumb">
    <span>مدیریت منابع انسانی</span>
    <span>←</span>
    <span>پرسنل</span>
    <span>←</span>
    <span class="current">جزئیات پرسنل</span>
</div>


{{-- =========================================================
     PAGE HEADER
========================================================= --}}

<div class="page-header">

    <div>

        <h1>
            {{ $employee->first_name }}
            {{ $employee->last_name }}
        </h1>

        <p>
            مشاهده کامل اطلاعات پرسنلی
        </p>

    </div>

    <div class="page-actions">

        <a
            href="{{ route('employees.index') }}"
            class="btn btn-secondary"
        >
            ← بازگشت به لیست
        </a>

        <a
            href="{{ route('employees.edit', $employee) }}"
            class="btn btn-gold"
        >
            ✎ ویرایش پرسنل
        </a>

    </div>

    <a href="{{ route('employees.leave-balance', $employee) }}"
   class="btn btn-success">

    <i class="bi bi-calendar-check me-1"></i>

    سهمیه مرخصی

</a>

</div>


{{-- =========================================================
     SUCCESS MESSAGE
========================================================= --}}

@if(session('success'))

    <div class="alert alert-success">

        <span style="font-size:18px;">✓</span>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


{{-- =========================================================
     EMPLOYEE SUMMARY
========================================================= --}}

<div class="stats">

    <div class="stat-card">

        <div class="stat-icon">
            👤
        </div>

        <div>

            <div class="stat-label">
                نام و نام خانوادگی
            </div>

            <div class="stat-value">
                {{ $employee->first_name }}
                {{ $employee->last_name }}
            </div>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            ◈
        </div>

        <div>

            <div class="stat-label">
                شماره پرسنلی
            </div>

            <div class="stat-value">
                {{ $employee->personnel_number ?: '—' }}
            </div>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            ▦
        </div>

        <div>

            <div class="stat-label">
                واحد سازمانی
            </div>

            <div class="stat-value">
                {{ $employee->department?->name ?? 'بدون واحد' }}
            </div>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">
            🎓
        </div>

        <div>

            <div class="stat-label">
                مقطع تحصیلی
            </div>

            <div class="stat-value">
                {{ $employee->education_level ?: '—' }}
            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SECTION 1 - PERSONAL INFORMATION
========================================================= --}}

<div class="card section-card">

    <div class="card-header">

        <div class="section-title-wrapper">

            <div class="section-icon">
                👤
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
                </label>

                <div class="form-control">
                    {{ $employee->first_name ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    نام خانوادگی
                </label>

                <div class="form-control">
                    {{ $employee->last_name ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    نام پدر
                </label>

                <div class="form-control">
                    {{ $employee->father_name ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    کد ملی
                </label>

                <div class="form-control">
                    {{ $employee->national_code ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    شماره شناسنامه
                </label>

                <div class="form-control">
                    {{ $employee->birth_certificate_number ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    وضعیت تأهل
                </label>

                <div class="form-control">
                    {{ $employee->marital_status ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    تاریخ تولد
                </label>

                <div class="form-control">
                    {{ $employee->birth_date?->format('Y-m-d') ?? '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    تاریخ ارتقاء
                </label>

                <div class="form-control">
                    {{ $employee->promotion_date?->format('Y-m-d') ?? '—' }}
                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SECTION 2 - ORGANIZATIONAL INFORMATION
========================================================= --}}

<div class="card section-card">

    <div class="card-header">

        <div class="section-title-wrapper">

            <div class="section-icon">
                🏢
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


    <div class="card-body">

        <div class="form-grid">

            <div class="form-group">

                <label class="form-label">
                    درجه
                </label>

                <div class="form-control">
                    {{ $employee->rank ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    شغل
                </label>

                <div class="form-control">
                    {{ $employee->job ?: '—' }}
                </div>

            </div>

            <div class="form-group">

    <label class="form-label">
        وضعیت پرسنل
    </label>

    <div class="form-control">

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
                ماموریت
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

    </div>

</div>


            <div class="form-group">

                <label class="form-label">
                    سمت
                </label>

                <div class="form-control">
                    {{ $employee->position ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    رسته خدمتی
                </label>

                <div class="form-control">
                    {{ $employee->service_branch ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    واحد سازمانی
                </label>

                <div class="form-control">
                    {{ $employee->department?->name ?? 'بدون واحد سازمانی' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    مقطع تحصیلی
                </label>

                <div class="form-control">

                    @if($employee->education_level)

                        <span class="badge badge-gold">
                            🎓 {{ $employee->education_level }}
                        </span>

                    @else

                        —

                    @endif

                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    رشته تحصیلی
                </label>

                <div class="form-control">
                    {{ $employee->education_field ?: '—' }}
                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     SECTION - LEAVE BALANCE
========================================================= --}}




<div class="card employee-leave-card">

    <div class="card-header">

        <div class="card-heading">

            <h2>
                مدیریت مرخصی پرسنل
            </h2>

            <p>
                وضعیت سهمیه و مصرف مرخصی در سال {{ $year }}
            </p>

        </div>

        <a
            href="{{ route('employees.leave-balance', $employee) }}"
            class="btn btn-gold"
        >
            ⚙ مدیریت سهمیه
        </a>

    </div>

    <div class="card-body">

        <div class="leave-balance-grid">

            @php
                $leaveTypes = [
                    'entitlement' => [
                        'title' => 'استحقاقی',
                        'icon' => '📘',
                    ],
                    'encouragement' => [
                        'title' => 'تشویقی',
                        'icon' => '🎁',
                    ],
                    'sick' => [
                        'title' => 'استعلاجی',
                        'icon' => '🏥',
                    ],
                    'continuity' => [
                        'title' => 'مداومت',
                        'icon' => '🔄',
                    ],
                ];
            @endphp

            @foreach($leaveTypes as $type => $item)

                @php
                    $balance = $leaveBalances->get($type);

                    $allowance = $balance?->allowance ?? 0;
                    $used = $balance?->used_days ?? 0;
                    $remaining = $balance?->remaining_days ?? 0;
                @endphp

                <div class="leave-balance-item">

                    <div class="leave-balance-top">

                        <div class="leave-balance-title">

                            <span class="leave-balance-icon">
                                {{ $item['icon'] }}
                            </span>

                            <strong>
                                {{ $item['title'] }}
                            </strong>

                        </div>

                        <span class="leave-year">
                            {{ $year }}
                        </span>

                    </div>

                    <div class="leave-balance-numbers">

                        <div>
                            <span>
                                سهمیه
                            </span>

                            <strong>
                                {{ $allowance }}
                            </strong>
                        </div>

                        <div>
                            <span>
                                استفاده‌شده
                            </span>

                            <strong class="used-number">
                                {{ $used }}
                            </strong>
                        </div>

                        <div>
                            <span>
                                باقی‌مانده
                            </span>

                            <strong class="remaining-number">
                                {{ $remaining }}
                            </strong>
                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>






{{-- =========================================================
     SECTION 3 - CONTACT INFORMATION
========================================================= --}}

<div class="card section-card">

    <div class="card-header">

        <div class="section-title-wrapper">

            <div class="section-icon">
                📞
            </div>

            <div class="card-heading">

                <h2>
                    اطلاعات تماس
                </h2>

                <p>
                    شماره‌های تماس و آدرس
                </p>

            </div>

        </div>

    </div>


    <div class="card-body">

        <div class="form-grid">

            <div class="form-group">

                <label class="form-label">
                    شماره موبایل
                </label>

                <div class="form-control">
                    {{ $employee->mobile ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    موبایل پشتیبان
                </label>

                <div class="form-control">
                    {{ $employee->backup_mobile ?: '—' }}
                </div>

            </div>


            <div class="form-group">

                <label class="form-label">
                    تلفن منزل
                </label>

                <div class="form-control">
                    {{ $employee->home_phone ?: '—' }}
                </div>

            </div>


            <div
                class="form-group"
                style="grid-column:1/-1;"
            >

                <label class="form-label">
                    آدرس منزل
                </label>

                <div
                    class="form-control"
                    style="
                        min-height:70px;
                        padding-top:12px;
                        padding-bottom:12px;
                        white-space:normal;
                    "
                >
                    {{ $employee->home_address ?: '—' }}
                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SECTION 4 - LEAVE MANAGEMENT
========================================================= --}}

<div class="card section-card">

    <div class="card-header">

        <div class="section-title-wrapper">

            <div class="section-icon">
                🏖️
            </div>

            <div class="card-heading">

                <h2>
                    مدیریت مرخصی
                </h2>

                <p>
                    وضعیت مرخصی‌های سال {{ $year }}
                </p>

            </div>

        </div>

        <a
            href="{{ route('leave-requests.create') }}?employee_id={{ $employee->id }}"
            class="btn btn-gold"
        >
            + ثبت مرخصی
        </a>

    </div>


    <div class="card-body">

        {{-- Leave Statistics --}}

        <div class="stats">

            <div class="stat-card">

                <div class="stat-icon">
                    📋
                </div>

                <div>

                    <div class="stat-label">
                        کل درخواست‌ها
                    </div>

                    <div class="stat-value">
                        {{ $leaveStatistics['total'] }}
                    </div>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    ✓
                </div>

                <div>

                    <div class="stat-label">
                        تأیید شده
                    </div>

                    <div class="stat-value">
                        {{ $leaveStatistics['approved'] }}
                    </div>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    ⏳
                </div>

                <div>

                    <div class="stat-label">
                        در انتظار تأیید
                    </div>

                    <div class="stat-value">
                        {{ $leaveStatistics['pending'] }}
                    </div>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    📅
                </div>

                <div>

                    <div class="stat-label">
                        روز مصرف‌شده
                    </div>

                    <div class="stat-value">
                        {{ $leaveStatistics['used_days'] }}
                        روز
                    </div>

                </div>

            </div>

        </div>


        {{-- Leave Balances --}}

        <div
            style="
                display:grid;
                grid-template-columns:
                    repeat(auto-fit,minmax(210px,1fr));
                gap:15px;
                margin-top:20px;
            "
        >

            @php

                $leaveLabels = [
                    'entitlement' => [
                        'title' => 'مرخصی استحقاقی',
                        'icon' => '🌿',
                    ],

                    'encouragement' => [
                        'title' => 'مرخصی تشویقی',
                        'icon' => '🏆',
                    ],

                    'sick' => [
                        'title' => 'مرخصی استعلاجی',
                        'icon' => '🏥',
                    ],

                    'continuity' => [
                        'title' => 'مرخصی مداومت',
                        'icon' => '🔄',
                    ],
                ];

            @endphp


            @foreach($leaveLabels as $type => $label)

                @php
                    $balance = $leaveBalance[$type] ?? [
                        'allowance' => 0,
                        'used' => 0,
                        'remaining' => 0,
                    ];
                @endphp


                <div
                    style="
                        border:1px solid var(--gray-200);
                        border-radius:14px;
                        padding:18px;
                        background:#fff;
                    "
                >

                    <div
                        style="
                            display:flex;
                            justify-content:space-between;
                            align-items:center;
                            gap:10px;
                        "
                    >

                        <div>

                            <div
                                style="
                                    font-size:11px;
                                    font-weight:900;
                                "
                            >
                                {{ $label['icon'] }}
                                {{ $label['title'] }}
                            </div>

                            <div
                                style="
                                    margin-top:5px;
                                    color:var(--gray-500);
                                    font-size:9px;
                                "
                            >
                                سال {{ $year }}
                            </div>

                        </div>

                    </div>


                    <div
                        style="
                            display:grid;
                            grid-template-columns:
                                repeat(3,1fr);
                            gap:8px;
                            margin-top:18px;
                            text-align:center;
                        "
                    >

                        <div>

                            <div
                                style="
                                    font-size:8px;
                                    color:var(--gray-500);
                                "
                            >
                                سهمیه
                            </div>

                            <strong>
                                {{ $balance['allowance'] }}
                            </strong>

                            <div
                                style="
                                    font-size:8px;
                                "
                            >
                                روز
                            </div>

                        </div>


                        <div>

                            <div
                                style="
                                    font-size:8px;
                                    color:var(--gray-500);
                                "
                            >
                                مصرف
                            </div>

                            <strong>
                                {{ $balance['used'] }}
                            </strong>

                            <div
                                style="
                                    font-size:8px;
                                "
                            >
                                روز
                            </div>

                        </div>


                        <div>

                            <div
                                style="
                                    font-size:8px;
                                    color:var(--gray-500);
                                "
                            >
                                باقی‌مانده
                            </div>

                            <strong
                                style="
                                    font-size:18px;
                                "
                            >
                                {{ $balance['remaining'] }}
                            </strong>

                            <div
                                style="
                                    font-size:8px;
                                "
                            >
                                روز
                            </div>

                        </div>

                    </div>


                    @php

                        $percentage = $balance['allowance'] > 0

                            ? min(
                                100,
                                (
                                    $balance['used']
                                    /
                                    $balance['allowance']
                                ) * 100
                            )

                            : 0;

                    @endphp


                    <div
                        style="
                            margin-top:15px;
                            height:7px;
                            background:var(--gray-100);
                            border-radius:20px;
                            overflow:hidden;
                        "
                    >

                        <div
                            style="
                                width:{{ $percentage }}%;
                                height:100%;
                                background:var(--gold);
                                border-radius:20px;
                            "
                        ></div>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- Leave History --}}

        <div style="margin-top:30px;">

            <div
                style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:15px;
                "
            >

                <div>

                    <h3
                        style="
                            margin:0;
                            font-size:13px;
                        "
                    >
                        سوابق مرخصی
                    </h3>

                    <p
                        style="
                            margin:5px 0 0;
                            font-size:9px;
                            color:var(--gray-500);
                        "
                    >
                        تمامی درخواست‌های ثبت‌شده این پرسنل در سال جاری
                    </p>

                </div>


                <a
                    href="{{ route('leave-requests.index') }}?search={{ $employee->personnel_number }}"
                    class="btn btn-secondary"
                >
                    مشاهده همه
                </a>

            </div>


            @if($leaveHistory->count())

                <div style="overflow-x:auto;">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>
                                    نوع مرخصی
                                </th>

                                <th>
                                    شروع
                                </th>

                                <th>
                                    پایان
                                </th>

                                <th>
                                    مدت
                                </th>

                                <th>
                                    وضعیت
                                </th>

                                <th>
                                    عملیات
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($leaveHistory->take(10) as $leave)

                                <tr>

                                    <td>

                                       {{ $leave->leave_type?->label() ?? '—' }}
                                    </td>


                                    <td>
                                        {{ $leave->start_date?->format('Y-m-d') ?? '—' }}
                                    </td>


                                    <td>
                                        {{ $leave->end_date?->format('Y-m-d') ?? '—' }}
                                    </td>


                                    <td>
                                        {{ $leave->days }}
                                        روز
                                    </td>


                                    <td>

                                       @if($leave->status === \App\Enums\LeaveStatus::APPROVED)

    <span class="status-badge status-active">
        ✓ تأیید شده
    </span>

@elseif($leave->status === \App\Enums\LeaveStatus::PENDING)

    <span class="status-badge status-mission">
        ⏳ در انتظار
    </span>

@elseif($leave->status === \App\Enums\LeaveStatus::REJECTED)

    <span class="status-badge status-inactive">
        ✕ رد شده
    </span>

@else

    <span class="status-badge">
        لغو شده
    </span>

@endif
                                    </td>


                                    <td>

                                        <a
                                            href="{{ route('leave-requests.show', $leave) }}"
                                            class="btn btn-secondary"
                                        >
                                            مشاهده
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div
                    style="
                        padding:30px;
                        text-align:center;
                        background:var(--gray-50);
                        border-radius:12px;
                        color:var(--gray-500);
                    "
                >

                    برای این پرسنل در سال {{ $year }}
                    سابقه مرخصی ثبت نشده است.

                </div>

            @endif

        </div>

    </div>

</div>






{{-- =========================================================
     SECTION 4 - SERVICE HISTORY
========================================================= --}}

<div class="card section-card">

    <div class="card-header">

        <div class="section-title-wrapper">

            <div class="section-icon">
                📋
            </div>

            <div class="card-heading">

                <h2>
                    سوابق خدمتی
                </h2>

                <p>
                    خلاصه سوابق و توضیحات پرسنل
                </p>

            </div>

        </div>

    </div>


    <div class="card-body">

        <div
            class="form-control"
            style="
                min-height:120px;
                padding:14px;
                white-space:pre-line;
                line-height:2;
            "
        >
            {{ $employee->service_summary ?: 'برای این پرسنل سابقه‌ای ثبت نشده است.' }}
        </div>

    </div>

</div>


{{-- =========================================================
     SECTION 5 - ACTIONS
========================================================= --}}

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
                    مدیریت پرسنل
                </div>

                <div style="
                    margin-top:5px;
                    color:var(--gray-500);
                    font-size:8px;
                ">
                    اطلاعات این پرسنل را مدیریت کنید.
                </div>

            </div>


            <div style="
                display:flex;
                gap:8px;
                flex-wrap:wrap;
            ">

                <a
                    href="{{ route('employees.index') }}"
                    class="btn btn-secondary"
                >
                    ← بازگشت
                </a>


                <a
                    href="{{ route('employees.edit', $employee) }}"
                    class="btn btn-gold"
                >
                    ✎ ویرایش
                </a>


                <form
                    action="{{ route('employees.destroy', $employee) }}"
                    method="POST"
                    style="display:inline;"
                    onsubmit="return confirm('آیا از حذف این پرسنل اطمینان دارید؟');"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        🗑 حذف پرسنل
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@push('styles')

<style>

    .leave-balance-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .leave-balance-item {
        padding: 18px;
        border: 1px solid var(--gray-200);
        border-radius: 14px;
        background: var(--gray-50);
        transition: var(--transition);
    }

    .leave-balance-item:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .leave-balance-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 18px;
    }

    .leave-balance-title {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .leave-balance-title strong {
        font-size: 11px;
        font-weight: 800;
    }

    .leave-balance-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: var(--gold-soft);
        font-size: 17px;
    }

    .leave-year {
        padding: 5px 8px;
        border-radius: 7px;
        background: #fff;
        color: var(--gray-500);
        font-size: 8px;
        font-weight: 700;
    }

    .leave-balance-numbers {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .leave-balance-numbers div {
        padding: 9px 6px;
        text-align: center;
        background: #fff;
        border-radius: 9px;
        border: 1px solid var(--gray-200);
    }

    .leave-balance-numbers span {
        display: block;
        color: var(--gray-500);
        font-size: 7px;
        margin-bottom: 4px;
    }

    .leave-balance-numbers strong {
        display: block;
        font-size: 15px;
        font-weight: 900;
    }

    .used-number {
        color: var(--orange);
    }

    .remaining-number {
        color: var(--green);
    }

    @media (max-width: 1100px) {
        .leave-balance-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .leave-balance-grid {
            grid-template-columns: 1fr;
        }
    }

</style>

@endpush


@endsection
