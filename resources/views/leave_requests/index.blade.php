@extends('layouts.app')

@section('title', 'درخواست‌های مرخصی')

@section('content')

<style>
    .leave-page {
        direction: rtl;
    }

    .leave-page .page-header,
    .leave-page .filter-card,
    .leave-page .leave-table-card,
    .leave-page .leave-stat {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
    }

    .leave-page .page-header {
        padding: 24px;
        margin-bottom: 20px;
    }

    .page-title {
        margin: 0 0 6px;
        font-size: 22px;
        font-weight: 900;
        color: #111827;
    }

    .page-subtitle {
        margin: 0;
        color: #6b7280;
        font-size: 13px;
    }

    /* Statistics */

    .leave-stat {
        padding: 20px;
        height: 100%;
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
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .leave-stat-number {
        color: #111827;
        font-size: 25px;
        font-weight: 900;
    }

    /* Filters */

    .filter-card {
        padding: 20px;
        margin-bottom: 20px;
    }

    .filter-title {
        margin-bottom: 16px;
        color: #111827;
        font-weight: 900;
    }

    .filter-label {
        display: block;
        margin-bottom: 7px;
        color: #374151;
        font-size: 12px;
        font-weight: 800;
    }

    .filter-control {
        min-height: 42px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
    }

    .filter-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    /* Table */

    .leave-table-card {
        overflow: hidden;
    }

    .leave-table-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e5e7eb;
    }

    .leave-table-title {
        margin-bottom: 4px;
        color: #111827;
        font-weight: 900;
    }

    .leave-table-subtitle {
        color: #6b7280;
        font-size: 12px;
    }

    .leave-table {
        min-width: 1100px;
        margin: 0;
    }

    .leave-table thead th {
        padding: 15px 12px;
        background: #f8fafc;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .leave-table tbody td {
        padding: 16px 12px;
        color: #1f2937;
        border-color: #f1f5f9;
        vertical-align: middle;
        font-size: 13px;
    }

    .leave-table tbody tr:hover {
        background: #f8fafc;
    }

    .employee-name {
        margin-bottom: 3px;
        color: #111827;
        font-weight: 900;
    }

    .employee-code {
        color: #9ca3af;
        font-size: 11px;
    }

    .date-value {
        display: inline-block;
        direction: ltr;
        white-space: nowrap;
        color: #374151;
        font-weight: 800;
    }

    .days-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 9px;
        background: #f3f4f6;
        border-radius: 8px;
        color: #374151;
        font-weight: 900;
        white-space: nowrap;
    }

    /* Leave type */

    .leave-type-badge,
    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 7px 12px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 900;
        white-space: nowrap;
    }

    .type-entitlement {
        background: #2563eb !important;
        color: #fff !important;
    }

    .type-encouragement {
        background: #0891b2 !important;
        color: #fff !important;
    }

    .type-sick {
        background: #dc2626 !important;
        color: #fff !important;
    }

    .type-continuity {
        background: #d97706 !important;
        color: #fff !important;
    }

    /* Status */

    .status-pending {
        background: #f59e0b !important;
        color: #fff !important;
    }

    .status-approved {
        background: #16a34a !important;
        color: #fff !important;
    }

    .status-rejected {
        background: #dc2626 !important;
        color: #fff !important;
    }

    .status-cancelled {
        background: #64748b !important;
        color: #fff !important;
    }

    /* Actions */

    .leave-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        flex-wrap: wrap;
        min-width: 350px;
    }

    .action-form {
        display: inline-flex;
        margin: 0;
    }

    .action-btn {
        min-width: 68px;
        min-height: 38px;
        padding: 6px 9px;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;

        border: 1px solid transparent;
        border-radius: 10px;

        cursor: pointer;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;

        transition:
            transform .18s ease,
            box-shadow .18s ease,
            opacity .18s ease;
    }

    .action-btn span {
        font-size: 15px;
        line-height: 1;
    }

    .action-btn small {
        font-size: 10px;
        font-weight: 900;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(15, 23, 42, .12);
    }

    .action-btn.view {
        background: #dbeafe !important;
        color: #1d4ed8 !important;
        border-color: #93c5fd !important;
    }

    .action-btn.edit {
        background: #fef3c7 !important;
        color: #b45309 !important;
        border-color: #fcd34d !important;
    }

    .action-btn.approve {
        background: #16a34a !important;
        color: #fff !important;
        border-color: #15803d !important;
    }

    .action-btn.reject {
        background: #dc2626 !important;
        color: #fff !important;
        border-color: #b91c1c !important;
    }

    .action-btn.cancel {
        background: #64748b !important;
        color: #fff !important;
        border-color: #475569 !important;
    }

    .action-btn.delete {
        background: #fee2e2 !important;
        color: #b91c1c !important;
        border-color: #fca5a5 !important;
    }

    .empty-state {
        padding: 70px 20px;
        text-align: center;
        color: #6b7280;
    }

    .empty-state i {
        display: block;
        margin-bottom: 15px;
        color: #cbd5e1;
        font-size: 45px;
    }

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
</style>


<div class="container-fluid py-4 leave-page">

    {{-- Header --}}
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

            <a
                href="{{ route('leave-requests.create') }}"
                class="btn btn-primary px-4 py-2"
            >
                <i class="bi bi-plus-circle me-1"></i>
                ثبت درخواست جدید
            </a>

        </div>

    </div>


    {{-- Messages --}}

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <strong>✓</strong>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif


    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <strong>!</strong>
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif


    @if($errors->any())
        <div class="alert alert-danger mb-4">

            <strong>خطا:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    {{-- Statistics --}}

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


    {{-- Filters --}}

    <div class="filter-card">

        <div class="filter-title">
            <i class="bi bi-funnel me-1"></i>
            فیلتر درخواست‌ها
        </div>

        <form
            method="GET"
            action="{{ route('leave-requests.index') }}"
        >

            <div class="row g-3">

                {{-- Employee --}}

                <div class="col-xl-3 col-md-6">

                    <label class="filter-label">
                        پرسنل
                    </label>

                    <select
                        name="employee_id"
                        class="form-select filter-control"
                    >

                        <option value="">
                            همه پرسنل
                        </option>

                        @foreach($employees as $employee)

                            <option
                                value="{{ $employee->id }}"
                                @selected(request('employee_id') == $employee->id)
                            >
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

                    <select
                        name="leave_type"
                        class="form-select filter-control"
                    >

                        <option value="">
                            همه انواع
                        </option>

                        <option
                            value="entitlement"
                            @selected(request('leave_type') === 'entitlement')
                        >
                            استحقاقی
                        </option>

                        <option
                            value="encouragement"
                            @selected(request('leave_type') === 'encouragement')
                        >
                            تشویقی
                        </option>

                        <option
                            value="sick"
                            @selected(request('leave_type') === 'sick')
                        >
                            استعلاجی
                        </option>

                        <option
                            value="continuity"
                            @selected(request('leave_type') === 'continuity')
                        >
                            مداومت
                        </option>

                    </select>

                </div>


                {{-- Status --}}

                <div class="col-xl-2 col-md-6">

                    <label class="filter-label">
                        وضعیت
                    </label>

                    <select
                        name="status"
                        class="form-select filter-control"
                    >

                        <option value="">
                            همه وضعیت‌ها
                        </option>

                        <option
                            value="pending"
                            @selected(request('status') === 'pending')
                        >
                            در انتظار بررسی
                        </option>

                        <option
                            value="approved"
                            @selected(request('status') === 'approved')
                        >
                            تأیید شده
                        </option>

                        <option
                            value="rejected"
                            @selected(request('status') === 'rejected')
                        >
                            رد شده
                        </option>

                        <option
                            value="cancelled"
                            @selected(request('status') === 'cancelled')
                        >
                            لغو شده
                        </option>

                    </select>

                </div>


                {{-- Year --}}

                <div class="col-xl-2 col-md-6">

                    <label class="filter-label">
                        سال
                    </label>

                    <select
                        name="year"
                        class="form-select filter-control"
                    >

                        <option value="">
                            همه سال‌ها
                        </option>

                        @foreach($years as $year)

                            <option
                                value="{{ $year }}"
                                @selected(request('year') == $year)
                            >
                                {{ $year }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Search --}}

                <div class="col-xl-2 col-md-12 d-flex align-items-end gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary flex-grow-1"
                        style="min-height:42px;"
                    >
                        <i class="bi bi-search me-1"></i>
                        جستجو
                    </button>

                    <a
                        href="{{ route('leave-requests.index') }}"
                        class="btn btn-light"
                        style="min-height:42px;"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Table --}}

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
                        <th>پرسنل</th>
                        <th>نوع مرخصی</th>
                        <th>تاریخ شروع</th>
                        <th>تاریخ پایان</th>
                        <th>مدت</th>
                        <th>وضعیت</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                </thead>


                <tbody>

                @forelse($leaveRequests as $leaveRequest)

                    @php
                        /*
                         * تبدیل Enum به مقدار string
                         * تا تمام شرط‌های Blade مطمئن کار کنند.
                         */

                        $leaveType = $leaveRequest->leave_type;

                        if ($leaveType instanceof \BackedEnum) {
                            $leaveType = $leaveType->value;
                        }

                        $status = $leaveRequest->status;

                        if ($status instanceof \BackedEnum) {
                            $status = $status->value;
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


                        {{-- Leave Type --}}

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


                        {{-- Start Date --}}

                        <td>
                            <span class="date-value">
                                @jalali($leaveRequest->start_date)
                            </span>
                        </td>


                        {{-- End Date --}}

                        <td>
                            <span class="date-value">
                                @jalali($leaveRequest->end_date)
                            </span>
                        </td>


                        {{-- Days --}}

                        <td>

                            <span class="days-badge">
                                {{ $leaveRequest->days }}
                                <span>روز</span>
                            </span>

                        </td>


                        {{-- Status --}}

                        <td>

                            @switch($status)

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
                                        {{ $status }}
                                    </span>

                            @endswitch

                        </td>


                        {{-- Actions --}}

                        <td>

                            <div class="leave-actions">

                                {{-- مشاهده --}}

                                <a
                                    href="{{ route('leave-requests.show', $leaveRequest) }}"
                                    class="action-btn view"
                                    title="مشاهده درخواست"
                                >
                                    <span>👁</span>
                                    <small>مشاهده</small>
                                </a>


                                {{-- ویرایش --}}

                                <a
                                    href="{{ route('leave-requests.edit', $leaveRequest) }}"
                                    class="action-btn edit"
                                    title="ویرایش درخواست"
                                >
                                    <span>✎</span>
                                    <small>ویرایش</small>
                                </a>


                                {{-- فقط Pending --}}

                                @if($status === 'pending')

                                    {{-- تأیید --}}

                                    <form
                                        action="{{ route('leave-requests.approve', $leaveRequest) }}"
                                        method="POST"
                                        class="action-form"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="action-btn approve"
                                            title="تأیید درخواست"
                                            onclick="return confirm('آیا از تأیید این درخواست مرخصی مطمئن هستید؟')"
                                        >
                                            <span>✓</span>
                                            <small>تأیید</small>
                                        </button>

                                    </form>


                                    {{-- رد --}}

                                    <form
                                        action="{{ route('leave-requests.reject', $leaveRequest) }}"
                                        method="POST"
                                        class="action-form"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="action-btn reject"
                                            title="رد درخواست"
                                            onclick="return confirm('آیا از رد این درخواست مرخصی مطمئن هستید؟')"
                                        >
                                            <span>✕</span>
                                            <small>رد</small>
                                        </button>

                                    </form>


                                    {{-- لغو --}}

                                    <form
                                        action="{{ route('leave-requests.cancel', $leaveRequest) }}"
                                        method="POST"
                                        class="action-form"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="action-btn cancel"
                                            title="لغو درخواست"
                                            onclick="return confirm('آیا از لغو این درخواست مرخصی مطمئن هستید؟')"
                                        >
                                            <span>↶</span>
                                            <small>لغو</small>
                                        </button>

                                    </form>

                                @endif


                                {{-- حذف --}}

                                <form
                                    action="{{ route('leave-requests.destroy', $leaveRequest) }}"
                                    method="POST"
                                    class="action-form"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete"
                                        title="حذف درخواست"
                                        onclick="return confirm('آیا از حذف این درخواست مرخصی مطمئن هستید؟')"
                                    >
                                        <span>🗑</span>
                                        <small>حذف</small>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

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