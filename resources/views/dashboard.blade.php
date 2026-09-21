@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">داشبورد سیستم پرسنلی</h2>
            <p class="text-muted mb-0">
                نمای کلی وضعیت کارکنان، حضور و غیاب و مرخصی‌ها
            </p>
        </div>
    </div>

    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">کل کارکنان</div>
                    <h2 class="fw-bold mb-0">{{ $employeesCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">حضور و غیاب</div>
                    <h2 class="fw-bold mb-0">{{ $attendancesCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">درخواست‌های مرخصی</div>
                    <h2 class="fw-bold mb-0">{{ $leaveRequestsCount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">در انتظار تأیید</div>
                    <h2 class="fw-bold mb-0">{{ $pendingLeaveRequestsCount }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Quick Access --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <h5 class="fw-bold mb-4">دسترسی سریع</h5>

            <div class="row g-3">

                <div class="col-md-4">
                    <a href="{{ route('employees.index') }}"
                       class="btn btn-outline-primary w-100 py-3">
                        👥 مدیریت کارکنان
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('attendances.index') }}"
                       class="btn btn-outline-success w-100 py-3">
                        🕐 حضور و غیاب
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('leave-requests.index') }}"
                       class="btn btn-outline-warning w-100 py-3">
                        📋 مدیریت مرخصی‌ها
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection