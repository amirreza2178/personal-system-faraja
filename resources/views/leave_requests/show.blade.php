@extends('layouts.app')

@section('title', 'جزئیات درخواست مرخصی')

@section('content')

<div class="container-fluid py-4">

```
{{-- Header --}}
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            <i class="bi bi-calendar-check me-2"></i>
            جزئیات درخواست مرخصی
        </h3>

        <p class="text-muted mb-0">
            مشاهده کامل اطلاعات و وضعیت درخواست
        </p>

    </div>


    <div class="d-flex gap-2">

        <a
            href="{{ route('leave-requests.index') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-right me-1"></i>
            بازگشت
        </a>

        <a
            href="{{ route('leave-requests.edit', $leaveRequest) }}"
            class="btn btn-primary"
        >
            <i class="bi bi-pencil me-1"></i>
            ویرایش
        </a>

    </div>

</div>


{{-- Messages --}}
@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif


<div class="row g-4">

    {{-- Main Information --}}
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="fw-bold mb-0">
                    اطلاعات درخواست
                </h5>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- Employee --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            پرسنل
                        </div>

                        <div class="fw-bold">

                            {{ $leaveRequest->employee?->first_name }}
                            {{ $leaveRequest->employee?->last_name }}

                        </div>

                        @if($leaveRequest->employee?->personnel_number)

                            <small class="text-muted">

                                کد پرسنلی:
                                {{ $leaveRequest->employee->personnel_number }}

                            </small>

                        @endif

                    </div>


                    {{-- Leave Type --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            نوع مرخصی
                        </div>

                        @php
                            $leaveType = $leaveRequest->leave_type instanceof \BackedEnum
                                ? $leaveRequest->leave_type->value
                                : $leaveRequest->leave_type;
                        @endphp

                        @switch($leaveType)

                            @case('entitlement')

                                <span class="badge bg-primary-subtle text-primary">
                                    مرخصی استحقاقی
                                </span>

                                @break

                            @case('encouragement')

                                <span class="badge bg-success-subtle text-success">
                                    مرخصی تشویقی
                                </span>

                                @break

                            @case('sick')

                                <span class="badge bg-danger-subtle text-danger">
                                    مرخصی استعلاجی
                                </span>

                                @break

                            @case('continuity')

                                <span class="badge bg-warning-subtle text-warning-emphasis">
                                    مرخصی مداومت
                                </span>

                                @break

                            @default

                                <span class="badge bg-secondary">
                                    {{ $leaveType }}
                                </span>

                        @endswitch

                    </div>


                    {{-- Start Date --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            تاریخ شروع
                        </div>

                        <div class="fw-bold fs-5">

                            @jalali($leaveRequest->start_date)

                        </div>

                    </div>


                    {{-- End Date --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            تاریخ پایان
                        </div>

                        <div class="fw-bold fs-5">

                            @jalali($leaveRequest->end_date)

                        </div>

                    </div>


                    {{-- Days --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            تعداد روز
                        </div>

                        <div class="fw-bold fs-5">

                            {{ $leaveRequest->days }}

                            <small class="text-muted">
                                روز
                            </small>

                        </div>

                    </div>


                    {{-- Year --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            سال مرخصی
                        </div>

                        <div class="fw-bold fs-5">

                            {{ $leaveRequest->year }}

                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="col-12">

                        <div class="text-muted small mb-1">
                            توضیحات
                        </div>

                        <div class="bg-light rounded p-3">

                            @if($leaveRequest->description)

                                {!! nl2br(e($leaveRequest->description)) !!}

                            @else

                                <span class="text-muted">
                                    توضیحاتی ثبت نشده است.
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Rejection --}}
        @if($leaveRequest->status === 'rejected')

            <div class="card border-0 shadow-sm border-start border-danger border-4">

                <div class="card-body">

                    <h5 class="fw-bold text-danger mb-3">
                        <i class="bi bi-x-circle me-1"></i>
                        علت رد درخواست
                    </h5>

                    @if($leaveRequest->rejection_reason)

                        <p class="mb-0">
                            {!! nl2br(e($leaveRequest->rejection_reason)) !!}
                        </p>

                    @else

                        <span class="text-muted">
                            علتی برای رد درخواست ثبت نشده است.
                        </span>

                    @endif

                </div>

            </div>

        @endif

    </div>


    {{-- Status Sidebar --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body text-center">

                <div class="mb-3">

                    @switch($leaveRequest->status)

                        @case('pending')

                            <div class="fs-1 text-warning">
                                <i class="bi bi-hourglass-split"></i>
                            </div>

                            <h5 class="fw-bold">
                                در انتظار بررسی
                            </h5>

                            @break

                        @case('approved')

                            <div class="fs-1 text-success">
                                <i class="bi bi-check-circle"></i>
                            </div>

                            <h5 class="fw-bold text-success">
                                تأیید شده
                            </h5>

                            @break

                        @case('rejected')

                            <div class="fs-1 text-danger">
                                <i class="bi bi-x-circle"></i>
                            </div>

                            <h5 class="fw-bold text-danger">
                                رد شده
                            </h5>

                            @break

                        @default

                            <div class="fs-1 text-secondary">
                                <i class="bi bi-question-circle"></i>
                            </div>

                            <h5 class="fw-bold">
                                {{ $leaveRequest->status }}
                            </h5>

                    @endswitch

                </div>


                {{-- Approve --}}
                @if($leaveRequest->status === 'pending')

                    <form
                        action="{{ route('leave-requests.approve', $leaveRequest) }}"
                        method="POST"
                        class="mb-2"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success w-100"
                            onclick="return confirm('آیا از تأیید این درخواست اطمینان دارید؟')"
                        >
                            <i class="bi bi-check-circle me-1"></i>
                            تأیید درخواست
                        </button>

                    </form>


                    {{-- Reject --}}
                    <button
                        type="button"
                        class="btn btn-outline-danger w-100"
                        data-bs-toggle="modal"
                        data-bs-target="#rejectModal"
                    >
                        <i class="bi bi-x-circle me-1"></i>
                        رد درخواست
                    </button>

                @endif

            </div>

        </div>


        {{-- Dates History --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="fw-bold mb-3">
                    <i class="bi bi-clock-history me-1"></i>
                    اطلاعات ثبت
                </h6>


                <div class="mb-3">

                    <div class="text-muted small">
                        تاریخ ثبت درخواست
                    </div>

                    <div class="fw-semibold">
                        @jalali($leaveRequest->created_at)
                    </div>

                </div>


                @if($leaveRequest->approved_at)

                    <div class="mb-3">

                        <div class="text-muted small">
                            تاریخ بررسی
                        </div>

                        <div class="fw-semibold">
                            @jalali($leaveRequest->approved_at)
                        </div>

                    </div>

                @endif


                @if($leaveRequest->year)

                    <div>

                        <div class="text-muted small">
                            سال مالی مرخصی
                        </div>

                        <div class="fw-semibold">
                            {{ $leaveRequest->year }}
                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>
```

</div>

{{-- Reject Modal --}}
@if($leaveRequest->status === 'pending')

```
<div
    class="modal fade"
    id="rejectModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                action="{{ route('leave-requests.reject', $leaveRequest) }}"
                method="POST"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        رد درخواست مرخصی
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    <label
                        for="rejection_reason"
                        class="form-label fw-semibold"
                    >
                        علت رد درخواست
                    </label>

                    <textarea
                        name="rejection_reason"
                        id="rejection_reason"
                        rows="5"
                        maxlength="2000"
                        class="form-control"
                        placeholder="علت رد درخواست را وارد کنید..."
                    ></textarea>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        انصراف
                    </button>

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        <i class="bi bi-x-circle me-1"></i>
                        رد درخواست
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
```

@endif

@endsection
