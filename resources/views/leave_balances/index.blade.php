@extends('layouts.app')

@section('title', 'موجودی مرخصی پرسنل')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                موجودی مرخصی پرسنل
            </h4>

            <div class="text-muted">

                {{ $employee->first_name }}
                {{ $employee->last_name }}

                <span class="mx-2">|</span>

                شماره پرسنلی:
                {{ $employee->personnel_number }}

            </div>

        </div>

        <a
            href="{{ route('employees.show', $employee) }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-right"></i>
            بازگشت به پرونده پرسنل
        </a>

    </div>


    {{-- Year Filter --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route(
                    'employees.leave-balances.index',
                    $employee
                ) }}"
                class="row g-3 align-items-end"
            >

                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        سال
                    </label>

                    <input
                        type="number"
                        name="year"
                        value="{{ $year }}"
                        class="form-control"
                        min="1400"
                        max="2100"
                    >

                </div>

                <div class="col-md-auto">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-search"></i>
                        نمایش
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- Messages --}}

    @if(session('success'))

        <div class="alert alert-success">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle me-1"></i>
            {{ session('error') }}
        </div>

    @endif


    {{-- Balance Cards --}}

    <div class="row g-4">

        @foreach(\App\Enums\LeaveType::cases() as $type)

            @php

                $item =
                    $balance[$type->value]
                    ?? [
                        'allowance' => 0,
                        'used' => 0,
                        'remaining' => 0,
                    ];

                $percentage =
                    $item['allowance'] > 0
                    ? min(
                        100,
                        round(
                            ($item['used'] /
                            $item['allowance']) * 100
                        )
                    )
                    : 0;

            @endphp


            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start mb-3">

                            <div>

                                <h6 class="fw-bold mb-1">
                                    {{ $type->label() }}
                                </h6>

                                <small class="text-muted">
                                    سال {{ $year }}
                                </small>

                            </div>

                            <span class="badge bg-light text-dark">
                                {{ $percentage }}٪ مصرف
                            </span>

                        </div>


                        <div class="row text-center mb-3">

                            <div class="col-4">

                                <div class="fw-bold text-primary fs-5">
                                    {{ $item['allowance'] }}
                                </div>

                                <small class="text-muted">
                                    سهمیه
                                </small>

                            </div>


                            <div class="col-4">

                                <div class="fw-bold text-warning fs-5">
                                    {{ $item['used'] }}
                                </div>

                                <small class="text-muted">
                                    مصرف
                                </small>

                            </div>


                            <div class="col-4">

                                <div class="fw-bold text-success fs-5">
                                    {{ $item['remaining'] }}
                                </div>

                                <small class="text-muted">
                                    باقی‌مانده
                                </small>

                            </div>

                        </div>


                        <div class="progress mb-4" style="height: 8px;">

                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: {{ $percentage }}%"
                            ></div>

                        </div>


                        {{-- Update Form --}}

                        <form
                            method="POST"
                            action="{{ route(
                                'employees.leave-balances.update',
                                $employee
                            ) }}"
                        >

                            @csrf
                            @method('PUT')


                            <input
                                type="hidden"
                                name="year"
                                value="{{ $year }}"
                            >

                            <input
                                type="hidden"
                                name="leave_type"
                                value="{{ $type->value }}"
                            >


                            <div class="input-group">

                                <input
                                    type="number"
                                    name="allowance"
                                    value="{{ $item['allowance'] }}"
                                    min="{{ $item['used'] }}"
                                    max="365"
                                    class="form-control"
                                >

                                <button
                                    class="btn btn-outline-primary"
                                    type="submit"
                                >
                                    ذخیره
                                </button>

                            </div>

                            @error('allowance')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection