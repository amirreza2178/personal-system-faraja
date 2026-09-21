@extends('layouts.app')

@section('title', 'درخواست‌های مرخصی')

@section('content')

<style>

    /* ==============================
       Leave Requests Page
    ============================== */

    .leave-page {
        direction: rtl;
    }

    .leave-page .page-header {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
    }

    .leave-page .page-title {
        font-size: 22px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 6px;
    }

    .leave-page .page-subtitle {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
    }

    /* Statistics */

    .leave-stat {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
    }

    .leave-stat-inner {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .leave-stat-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .stat-blue {
        background: #e8f1ff;
        color: #2563eb;
    }

    .stat-orange {
        background: #fff4df;
        color: #d97706;
    }

    .stat-green {
        background: #e7f8ee;
        color: #16a34a;
    }

    .stat-red {
        background: #feecec;
        color: #dc2626;
    }

    .leave-stat-label {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .leave-stat-number {
        font-size: 25px;
        font-weight: 800;
        color: #111827;
    }


    /* Filters */

    .filter-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
    }

    .filter-title {
        font-weight: 800;
        color: #111827;
        margin-bottom: 16px;
    }

    .filter-label {
        font-size: 12px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 7px;
    }

    .filter-control {
        min-height: 42px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        background: #ffffff;
        color: #111827;
    }

    .filter-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }


    /* Table */

    .leave-table-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
    }

    .leave-table-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e5e7eb;
    }

    .leave-table-title {
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
    }

    .leave-table-subtitle {
        color: #6b7280;
        font-size: 12px;
    }

    .leave-table {
        margin: 0;
        min-width: 1000px;
    }

    .leave-table thead th {
        background: #f8fafc;
        color: #374151;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
        padding: 15px 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .leave-table tbody td {
        padding: 16px 12px;
        vertical-align: middle;
        border-color: #f1f5f9;
        color: #1f2937;
        font-size: 13px;
    }

    .leave-table tbody tr:hover {
        background: #f8fafc;
    }

    .employee-name {
        font-weight: 800;
        color: #111827;
        margin-bottom: 3px;
    }

    .employee-code {
        color: #9ca3af;
        font-size: 11px;
    }

    .date-value {
        direction: ltr;
        display: inline-block;
        white-space: nowrap;
        font-weight: 700;
        color: #374151;
    }

    .days-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #f3f4f6;
        color: #374151;
        border-radius: 8px;
        padding: 6px 9px;
        font-weight: 800;
        white-space: nowrap;
    }


    /* Leave type */
.type-entitlement {
    background: #2563eb !important;
    color: #ffffff !important;
    border: 1px solid #1d4ed8;
}

.type-encouragement {
    background: #0284c7 !important;
    color: #ffffff !important;
    border: 1px solid #0369a1;
}

.type-sick {
    background: #dc2626 !important;
    color: #ffffff !important;
    border: 1px solid #b91c1c;
}

.type-continuity {
    background: #d97706 !important;
    color: #ffffff !important;
    border: 1px solid #b45309;
}


    /* Status */

    .status-pending {
    background: #f59e0b !important;
    color: #ffffff !important;
    border: 1px solid #d97706;
}

.status-approved {
    background: #16a34a !important;
    color: #ffffff !important;
    border: 1px solid #15803d;
}

.status-rejected {
    background: #dc2626 !important;
    color: #ffffff !important;
    border: 1px solid #b91c1c;
}

.status-cancelled {
    background: #6b7280 !important;
    color: #ffffff !important;
    border: 1px solid #4b5563;
}


    /* Actions */

    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }

    .leave-action {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid transparent;
        cursor: pointer;
        transition: .2s;
        text-decoration: none;
    }

    .leave-action:hover {
        transform: translateY(-1px);
    }

    .action-show {
        background: #e8f1ff;
        color: #2563eb;
        border-color: #dbeafe;
    }

    .action-edit {
        background: #f3f4f6;
        color: #374151;
        border-color: #e5e7eb;
    }

    .action-approve {
        background: #16a34a;
        color: #ffffff;
        border-color: #16a34a;
    }

    .action-approve:hover {
        background: #15803d;
        color: #ffffff;
    }

    .action-reject {
        background: #ffffff;
        color: #dc2626;
        border-color: #fecaca;
    }

    .action-delete {
        background: #ffffff;
        color: #dc2626;
        border-color: #fecaca;
    }


    /* Empty */

    .empty-state {
        padding: 70px 20px;
        text-align: center;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 45px;
        color: #cbd5e1;
        display: block;
        margin-bottom: 15px;
    }


    /* Responsive */

    @media (max-width: 768px) {

        .leave-page .page-header {
            padding: 18px;
        }

        .leave-stat {
            padding: 16px;
        }

        .filter-card {
            padding: 16px;
        }

    }

    .action-symbol {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    width: 100%;
    height: 100%;

    font-size: 15px;
    line-height: 1;
    font-weight: 900;
}

.action-btn {
    width: 38px;
    height: 38px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    border: 1px solid transparent;

    cursor: pointer;

    text-decoration: none;

    transition:
        transform .18s ease,
        box-shadow .18s ease,
        opacity .18s ease;
}

.action-btn:hover {
    transform: translateY(-2px);
}


/* مشاهده */

.action-btn.view {
    background: #dbeafe !important;
    color: #1d4ed8 !important;
    border-color: #93c5fd !important;
}


/* ویرایش */

.action-btn.edit {
    background: #fef3c7 !important;
    color: #b45309 !important;
    border-color: #fcd34d !important;
}


/* تأیید */

.action-btn.approve {
    background: #16a34a !important;
    color: #ffffff !important;
    border-color: #15803d !important;
}


/* رد */

.action-btn.reject {
    background: #dc2626 !important;
    color: #ffffff !important;
    border-color: #b91c1c !important;
}


/* حذف */

.action-btn.delete {
    background: #fee2e2 !important;
    color: #b91c1c !important;
    border-color: #fca5a5 !important;
}


/* لغو */

.action-btn.cancel {
    background: #6b7280 !important;
    color: #ffffff !important;
    border-color: #4b5563 !important;
}


.leave-type {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 7px 12px;

    border-radius: 8px;

    font-size: 11px;

    font-weight: 900;

    white-space: nowrap;
}

.leave-type.entitlement {
    background: #2563eb !important;
    color: #ffffff !important;
}

.leave-type.encouragement {
    background: #0891b2 !important;
    color: #ffffff !important;
}

.leave-type.sick {
    background: #dc2626 !important;
    color: #ffffff !important;
}

.leave-type.continuity {
    background: #d97706 !important;
    color: #ffffff !important;
}

.status-badge {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 7px 12px;

    border-radius: 8px;

    font-size: 11px;

    font-weight: 900;

    white-space: nowrap;
}

.status-badge.pending {
    background: #f59e0b !important;
    color: #ffffff !important;
}

.status-badge.approved {
    background: #16a34a !important;
    color: #ffffff !important;
}

.status-badge.rejected {
    background: #dc2626 !important;
    color: #ffffff !important;
}

.status-badge.cancelled {
    background: #6b7280 !important;
    color: #ffffff !important;
}


</style>


<div class="container-fluid py-4 leave-page">


    {{-- =========================
         Page Header
    ========================== --}}

    <div class="page-header">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

            <div>

                <h1 class="page-title">
                    درخواست‌های مرخصی
                </h1>

                <p class="page-subtitle">
                    مدیریت، بررسی، تأیید و پیگیری درخواست‌های مرخصی پرسنل
                </p>

            </div>


            <a href="{{ route('leave-requests.create') }}"
               class="btn btn-primary px-4 py-2">

                <i class="bi bi-plus-circle me-1"></i>

                ثبت درخواست جدید

            </a>

        </div>

    </div>


    {{-- =========================
         Messages
    ========================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show mb-4"
             role="alert">

           <span class="action-symbol">✓</span>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show mb-4"
             role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger mb-4">

            <strong>
                خطا:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================
         Statistics
    ========================== --}}

    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="leave-stat">

                <div class="leave-stat-inner">

                    <div class="leave-stat-icon stat-blue">

                        <i class="bi bi-calendar3"></i>

                    </div>

                    <div>

                        <div class="leave-stat-label">
                            کل درخواست‌ها
                        </div>

                        <div class="leave-stat-number">
                            {{ $totalCount }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="leave-stat">

                <div class="leave-stat-inner">

                    <div class="leave-stat-icon stat-orange">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                    <div>

                        <div class="leave-stat-label">
                            در انتظار بررسی
                        </div>

                        <div class="leave-stat-number">
                            {{ $pendingCount }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="leave-stat">

                <div class="leave-stat-inner">

                    <div class="leave-stat-icon stat-green">

                        <i class="bi bi-check-circle-fill"></i>

                    </div>

                    <div>

                        <div class="leave-stat-label">
                            تأیید شده
                        </div>

                        <div class="leave-stat-number">
                            {{ $approvedCount }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="leave-stat">

                <div class="leave-stat-inner">

                    <div class="leave-stat-icon stat-red">

                        <i class="bi bi-x-circle-fill"></i>

                    </div>

                    <div>

                        <div class="leave-stat-label">
                            رد شده
                        </div>

                        <div class="leave-stat-number">
                            {{ $rejectedCount }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         Filters
    ========================== --}}

    <div class="filter-card">

        <div class="filter-title">

            <i class="bi bi-funnel me-1"></i>

            فیلتر درخواست‌ها

        </div>


        <form method="GET"
              action="{{ route('leave-requests.index') }}">

            <div class="row g-3">


                {{-- Employee --}}

                <div class="col-xl-3 col-md-6">

                    <label class="filter-label">
                        پرسنل
                    </label>

                    <select name="employee_id"
                            class="form-select filter-control">

                        <option value="">
                            همه پرسنل
                        </option>

                        @foreach($employees as $employee)

                            <option value="{{ $employee->id }}"
                                @selected(request('employee_id') == $employee->id)>

                                {{ $employee->first_name }}
                                {{ $employee->last_name }}

                                @if($employee->personnel_number)
                                    — {{ $employee->personnel_number }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Leave Type --}}

                <div class="col-xl-3 col-md-6">

                    <label class="filter-label">
                        نوع مرخصی
                    </label>

                    <select name="leave_type"
                            class="form-select filter-control">

                        <option value="">
                            همه انواع
                        </option>

                        <option value="entitlement"
                            @selected(request('leave_type') === 'entitlement')>
                            مرخصی استحقاقی
                        </option>

                        <option value="encouragement"
                            @selected(request('leave_type') === 'encouragement')>
                            مرخصی تشویقی
                        </option>

                        <option value="sick"
                            @selected(request('leave_type') === 'sick')>
                            مرخصی استعلاجی
                        </option>

                        <option value="continuity"
                            @selected(request('leave_type') === 'continuity')>
                            مرخصی مداومت
                        </option>

                    </select>

                </div>


                {{-- Status --}}

                <div class="col-xl-2 col-md-6">

                    <label class="filter-label">
                        وضعیت
                    </label>

                    <select name="status"
                            class="form-select filter-control">

                        <option value="">
                            همه وضعیت‌ها
                        </option>

                        <option value="pending"
                            @selected(request('status') === 'pending')>
                            در انتظار بررسی
                        </option>

                        <option value="approved"
                            @selected(request('status') === 'approved')>
                            تأیید شده
                        </option>

                        <option value="rejected"
                            @selected(request('status') === 'rejected')>
                            رد شده
                        </option>

                        <option value="cancelled"
                            @selected(request('status') === 'cancelled')>
                            لغو شده
                        </option>

                    </select>

                </div>


                {{-- Year --}}

                <div class="col-xl-2 col-md-6">

                    <label class="filter-label">
                        سال
                    </label>

                    <select name="year"
                            class="form-select filter-control">

                        <option value="">
                            همه سال‌ها
                        </option>

                        @foreach($years as $year)

                            <option value="{{ $year }}"
                                @selected(request('year') == $year)>

                                {{ $year }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Buttons --}}

                <div class="col-xl-2 col-md-12 d-flex align-items-end gap-2">

                    <button type="submit"
                            class="btn btn-primary flex-grow-1"
                            style="min-height:42px;">

                        <i class="bi bi-search me-1"></i>

                        جستجو

                    </button>


                    <a href="{{ route('leave-requests.index') }}"
                       class="btn btn-light"
                       style="min-height:42px;">

                        <i class="bi bi-arrow-counterclockwise"></i>

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================
         Table
    ========================== --}}

    <div class="leave-table-card">

        <div class="leave-table-header">

            <div class="leave-table-title">

                <i class="bi bi-list-check me-1"></i>

                لیست درخواست‌ها

            </div>

            <div class="leave-table-subtitle">

                درخواست‌های ثبت‌شده در سامانه

            </div>

        </div>


        <div class="table-responsive">

            <table class="table leave-table align-middle">

                <thead>

                <tr>

                    <th>
                        پرسنل
                    </th>

                    <th>
                        نوع مرخصی
                    </th>

                    <th>
                        تاریخ شروع
                    </th>

                    <th>
                        تاریخ پایان
                    </th>

                    <th>
                        مدت
                    </th>

                    <th>
                        وضعیت
                    </th>

                    <th class="text-center">
                        عملیات
                    </th>

                </tr>

                </thead>


                <tbody>

                @forelse($leaveRequests as $leaveRequest)

                    @php

                        $leaveType = $leaveRequest->leave_type;

                        if ($leaveType instanceof \BackedEnum) {
                            $leaveType = $leaveType->value;
                        }

                    @endphp


                    <tr>


                        {{-- Employee --}}

                        <td>

                            <div class="employee-name">

                                {{ $leaveRequest->employee?->first_name }}
                                {{ $leaveRequest->employee?->last_name }}

                            </div>

                            @if($leaveRequest->employee?->personnel_number)

                                <div class="employee-code">

                                    کد پرسنلی:
                                    {{ $leaveRequest->employee->personnel_number }}

                                </div>

                            @endif

                        </td>


                        {{-- Type --}}

                        <td>

                            @switch($leaveType)

                                @case('entitlement')

                                    <span class="leave-type-badge type-entitlement">

                                        <i class="bi bi-calendar-check"></i>

                                        استحقاقی

                                    </span>

                                    @break


                                @case('encouragement')

                                    <span class="leave-type-badge type-encouragement">

                                        <i class="bi bi-star"></i>

                                        تشویقی

                                    </span>

                                    @break


                                @case('sick')

                                    <span class="leave-type-badge type-sick">

                                        <i class="bi bi-heart-pulse"></i>

                                        استعلاجی

                                    </span>

                                    @break


                                @case('continuity')

                                    <span class="leave-type-badge type-continuity">

                                        <i class="bi bi-arrow-repeat"></i>

                                        مداومت

                                    </span>

                                    @break


                                @default

                                    <span class="leave-type-badge">
                                        {{ $leaveType }}
                                    </span>

                            @endswitch

                        </td>


                        {{-- Start --}}

                        <td>

                            <span class="date-value">
                                @jalali($leaveRequest->start_date)
                            </span>

                        </td>


                        {{-- End --}}

                        <td>

                            <span class="date-value">
                                @jalali($leaveRequest->end_date)
                            </span>

                        </td>


                        {{-- Days --}}

                        <td>

                            <span class="days-badge">

                                {{ $leaveRequest->days }}

                                <span>
                                    روز
                                </span>

                            </span>

                        </td>


                        {{-- Status --}}

                        <td>

                            @switch($leaveRequest->status)

                                @case('pending')

                                    <span class="status-badge status-pending">

                                        <i class="bi bi-hourglass-split"></i>

                                        در انتظار بررسی

                                    </span>

                                    @break


                                @case('approved')

                                    <span class="status-badge status-approved">

                                        <i class="bi bi-check-circle-fill"></i>

                                        تأیید شده

                                    </span>

                                    @break


                                @case('rejected')

                                    <span class="status-badge status-rejected">

                                        <i class="bi bi-x-circle-fill"></i>

                                        رد شده

                                    </span>

                                    @break


                                @case('cancelled')

                                    <span class="status-badge status-cancelled">

                                        <i class="bi bi-slash-circle"></i>

                                        لغو شده

                                    </span>

                                    @break


                                @default

                                    <span class="status-badge status-cancelled">
                                        {{ $leaveRequest->status }}
                                    </span>

                            @endswitch

                        </td>


                        {{-- Actions --}}

                        <td>

                            <div class="action-buttons">


                                {{-- Show --}}

                                <a href="{{ route('leave-requests.show', $leaveRequest) }}"
                                   class="leave-action action-show"
                                   title="مشاهده درخواست">

                                    <span class="action-symbol">👁</span>

                                </a>


                                {{-- Edit --}}

                                <a href="{{ route('leave-requests.edit', $leaveRequest) }}"
                                   class="leave-action action-edit"
                                   title="ویرایش درخواست">

                                    <span class="action-symbol">✎</span>

                                </a>


                                {{-- Approve --}}

                                @if($leaveRequest->status === 'pending')

                                    <form method="POST"
                                          action="{{ route('leave-requests.approve', $leaveRequest) }}"
                                          class="d-inline">

                                        @csrf

                                        <button type="submit"
                                                class="leave-action action-approve"
                                                title="تأیید درخواست"
                                                onclick="return confirm('آیا از تأیید این درخواست مطمئن هستید؟')">

                                            <span class="action-symbol">+</span>

                                        </button>

                                    </form>


                                    {{-- Reject --}}

                                    <button type="button"
                                            class="leave-action action-reject"
                                            title="رد درخواست"
                                            data-bs-toggle="modal"
                                            data-bs-target="#rejectModal{{ $leaveRequest->id }}">

                                        <span class="action-symbol">✕</span>

                                    </button>

                                @endif


                                {{-- Delete --}}

                                <form method="POST"
                                      action="{{ route('leave-requests.destroy', $leaveRequest) }}"
                                      class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="leave-action action-delete"
                                            title="حذف درخواست"
                                            onclick="return confirm('آیا از حذف این درخواست مطمئن هستید؟')">

                                       <span class="action-symbol">🗑</span>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- Reject Modal --}}

                    @if($leaveRequest->status === 'pending')

                        <div class="modal fade"
                             id="rejectModal{{ $leaveRequest->id }}"
                             tabindex="-1"
                             aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content border-0 shadow">

                                    <div class="modal-header">

                                        <h5 class="modal-title fw-bold">

                                            <i class="bi bi-x-circle text-danger me-1"></i>

                                            رد درخواست مرخصی

                                        </h5>

                                        <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"></button>

                                    </div>


                                    <form method="POST"
                                          action="{{ route('leave-requests.reject', $leaveRequest) }}">

                                        @csrf

                                        <div class="modal-body">

                                            <div class="mb-3">

                                                <div class="small text-muted mb-1">
                                                    پرسنل
                                                </div>

                                                <strong>

                                                    {{ $leaveRequest->employee?->first_name }}
                                                    {{ $leaveRequest->employee?->last_name }}

                                                </strong>

                                            </div>


                                            <label class="form-label fw-bold">

                                                علت رد درخواست

                                            </label>

                                            <textarea name="rejection_reason"
                                                      class="form-control"
                                                      rows="4"
                                                      maxlength="2000"
                                                      placeholder="در صورت نیاز علت رد درخواست را وارد کنید..."></textarea>

                                        </div>


                                        <div class="modal-footer">

                                            <button type="button"
                                                    class="btn btn-light"
                                                    data-bs-dismiss="modal">

                                                انصراف

                                            </button>

                                            <button type="submit"
                                                    class="btn btn-danger">

                                                <i class="bi bi-x-circle me-1"></i>

                                                رد درخواست

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endif


                @empty

                    <tr>

                        <td colspan="7">

                            <div class="empty-state">

                                <i class="bi bi-calendar-x"></i>

                                <div class="fw-bold mb-2">
                                    هیچ درخواست مرخصی پیدا نشد.
                                </div>

                                <div class="small">
                                    درخواست جدید ثبت کنید یا فیلترهای جستجو را تغییر دهید.
                                </div>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}

        @if($leaveRequests->hasPages())

            <div class="p-3 border-top">

                {{ $leaveRequests->links() }}

            </div>

        @endif

    </div>

</div>

@endsection