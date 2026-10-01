@extends('layouts.app')

@section('title', 'داشبورد')

@section('content')

<div class="dashboard-page">

    <div class="page-header">
        <div>
            <div class="breadcrumb">
                <span>سامانه</span>
                <span>›</span>
                <span class="current">داشبورد</span>
            </div>

            <h1>داشبورد سیستم پرسنلی</h1>

            <p>
                نمای کلی وضعیت کارکنان، حضور و غیاب و مرخصی‌ها
            </p>
        </div>
    </div>

    <div class="stats">

        <div class="stat">
            <div class="stat-top">
                <div class="stat-icon gold">👥</div>
            </div>

            <div class="stat-label">کل کارکنان</div>

            <div class="stat-value">
                {{ $employeesCount ?? 0 }}
            </div>
        </div>

        <div class="stat">
            <div class="stat-top">
                <div class="stat-icon green">🕐</div>
            </div>

            <div class="stat-label">ثبت‌های حضور و غیاب</div>

            <div class="stat-value">
                {{ $attendancesCount ?? 0 }}
            </div>
        </div>

        <div class="stat">
            <div class="stat-top">
                <div class="stat-icon blue">📋</div>
            </div>

            <div class="stat-label">درخواست‌های مرخصی</div>

            <div class="stat-value">
                {{ $leaveRequestsCount ?? 0 }}
            </div>
        </div>

        <div class="stat">
            <div class="stat-top">
                <div class="stat-icon" style="color:#d97706;background:#fff7ed;">⏳</div>
            </div>

            <div class="stat-label">در انتظار تأیید</div>

            <div class="stat-value">
                {{ $pendingLeaveRequestsCount ?? 0 }}
            </div>
        </div>

    </div>

    <div class="card">

        <div class="card-header">

            <div class="card-heading">
                <h2>دسترسی سریع</h2>
                <p>دسترسی مستقیم به بخش‌های اصلی سامانه</p>
            </div>

        </div>

        <div class="card-body">

            <div class="row g-3 dashboard-actions">

                <div class="col-md-4">
                    <a
                        href="{{ route('employees.index') }}"
                        class="dashboard-action employees"
                    >
                        <span class="dashboard-action-icon">👥</span>
                        <span>
                            <strong>مدیریت کارکنان</strong>
                            <small>مشاهده و مدیریت پرونده پرسنلی</small>
                        </span>
                        <span class="dashboard-arrow">←</span>
                    </a>
                </div>

                <div class="col-md-4">
                    <a
                        href="{{ route('attendances.index') }}"
                        class="dashboard-action attendance"
                    >
                        <span class="dashboard-action-icon">🕐</span>
                        <span>
                            <strong>حضور و غیاب</strong>
                            <small>مدیریت ثبت‌های حضور و غیاب</small>
                        </span>
                        <span class="dashboard-arrow">←</span>
                    </a>
                </div>

                <div class="col-md-4">
                    <a
                        href="{{ route('leave-requests.index') }}"
                        class="dashboard-action leave"
                    >
                        <span class="dashboard-action-icon">📋</span>
                        <span>
                            <strong>مدیریت مرخصی‌ها</strong>
                            <small>ثبت، بررسی و مدیریت درخواست‌ها</small>
                        </span>
                        <span class="dashboard-arrow">←</span>
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')
<style>
    .dashboard-page {
        width: 100%;
    }

    .dashboard-actions {
        margin: 0;
    }

    .dashboard-action {
        min-height: 92px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        transition: var(--transition);
    }

    .dashboard-action:hover {
        transform: translateY(-2px);
        background: #fff;
        border-color: var(--gold);
        box-shadow: var(--shadow-md);
    }

    .dashboard-action-icon {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--gold-soft);
        font-size: 18px;
    }

    .dashboard-action > span:nth-child(2) {
        flex: 1;
        min-width: 0;
    }

    .dashboard-action strong {
        display: block;
        color: var(--gray-900);
        font-size: 10px;
        font-weight: 800;
    }

    .dashboard-action small {
        display: block;
        margin-top: 5px;
        color: var(--gray-500);
        font-size: 8px;
    }

    .dashboard-arrow {
        color: var(--gray-400);
        font-size: 14px;
        transition: var(--transition);
    }

    .dashboard-action:hover .dashboard-arrow {
        color: var(--gold);
        transform: translateX(-3px);
    }

    .dashboard-action.employees .dashboard-action-icon {
        background: var(--blue-soft);
    }

    .dashboard-action.attendance .dashboard-action-icon {
        background: var(--green-soft);
    }

    .dashboard-action.leave .dashboard-action-icon {
        background: var(--gold-soft);
    }

    @media (max-width: 700px) {
        .dashboard-action {
            min-height: 78px;
        }
    }
</style>
@endpush
