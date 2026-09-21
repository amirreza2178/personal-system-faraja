@extends('layouts.app')

@section('title', 'سهمیه مرخصی پرسنل')

@section('content')

<style>

    .balance-page {
        direction: rtl;
    }

    .balance-header {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
    }

    .balance-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
    }

    .balance-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
    }

    .balance-table th {
        background: #f8fafc;
        color: #374151;
        font-size: 12px;
        font-weight: 800;
        padding: 15px;
    }

    .balance-table td {
        padding: 18px 15px;
        vertical-align: middle;
    }

    .balance-number {
        font-size: 18px;
        font-weight: 800;
    }

    .allowance-box {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 8px 12px;
        font-weight: 800;
    }

    .used-box {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #fed7aa;
        border-radius: 10px;
        padding: 8px 12px;
        font-weight: 800;
    }

    .remaining-box {
        background: #16a34a;
        color: #ffffff;
        border-radius: 10px;
        padding: 8px 12px;
        font-weight: 800;
    }

    .leave-type-title {
        font-weight: 800;
        color: #111827;
    }

    .employee-info {
        color: #6b7280;
        font-size: 13px;
    }

</style>


<div class="container-fluid py-4 balance-page">


    {{-- Header --}}

    <div class="balance-header">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

            <div>

                <h1 class="fw-bold mb-2">
                    سهمیه مرخصی پرسنل
                </h1>

                <div class="employee-info">

                    <strong>
                        {{ $employee->first_name }}
                        {{ $employee->last_name }}
                    </strong>

                    @if($employee->personnel_number)

                        <span class="mx-2">|</span>

                        کد پرسنلی:
                        {{ $employee->personnel_number }}

                    @endif

                </div>

            </div>


            <div class="d-flex gap-2">

                <a href="{{ route('employees.show', $employee) }}"
                   class="btn btn-light">

                    <i class="bi bi-person me-1"></i>

                    پرونده پرسنل

                </a>

                <a href="{{ route('leave-requests.index') }}"
                   class="btn btn-light">

                    <i class="bi bi-arrow-right me-1"></i>

                    بازگشت

                </a>

            </div>

        </div>

    </div>


    {{-- Messages --}}

    @if(session('success'))

        <div class="alert alert-success">

            <i class="bi bi-check-circle-fill me-1"></i>

            {{ session('success') }}

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Balance --}}

    <div class="balance-card">

        <div class="balance-card-header">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        وضعیت سهمیه
                    </h5>

                    <small class="text-muted">
                        سال شمسی {{ $year }}
                    </small>

                </div>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table balance-table mb-0">

                <thead>

                <tr>

                    <th>
                        نوع مرخصی
                    </th>

                    <th>
                        سهمیه
                    </th>

                    <th>
                        مصرف شده
                    </th>

                    <th>
                        باقی‌مانده
                    </th>

                </tr>

                </thead>


                <tbody>


                @php

                    $leaveTypes = [
                        'entitlement' => 'مرخصی استحقاقی',
                        'encouragement' => 'مرخصی تشویقی',
                        'sick' => 'مرخصی استعلاجی',
                        'continuity' => 'مرخصی مداومت',
                    ];

                @endphp


                @foreach($leaveTypes as $type => $title)

                    @php

                        $balance = $balances->get($type);

                        $allowance = $balance?->allowance ?? 0;

                        $used = $balance?->used_days ?? 0;

                        $remaining = max(
                            0,
                            $allowance - $used
                        );

                    @endphp


                    <tr>

                        <td>

                            <div class="leave-type-title">
                                {{ $title }}
                            </div>

                        </td>


                        <td>

                            <span class="allowance-box">

                                {{ $allowance }}

                                روز

                            </span>

                        </td>


                        <td>

                            <span class="used-box">

                                {{ $used }}

                                روز

                            </span>

                        </td>


                        <td>

                            <span class="remaining-box">

                                {{ $remaining }}

                                روز

                            </span>

                        </td>

                    </tr>

                @endforeach


                </tbody>

            </table>

        </div>

    </div>


    {{-- Edit Allowances --}}

    <div class="balance-card mt-4">

        <div class="balance-card-header">

            <h5 class="fw-bold mb-1">
                تنظیم سهمیه
            </h5>

            <small class="text-muted">
                سهمیه سال {{ $year }} را تعیین کنید.
            </small>

        </div>


        <div class="p-4">

            <form method="POST"
                  action="{{ route('employees.leave-balance.update', $employee) }}">

                @csrf

                @method('PUT')


                <input type="hidden"
                       name="year"
                       value="{{ $year }}">


                <div class="row g-3">


                    @foreach($leaveTypes as $type => $title)

                        @php

                            $balance = $balances->get($type);

                            $allowance = $balance?->allowance ?? 0;

                        @endphp


                        <div class="col-md-6">

                            <label class="form-label fw-bold">

                                {{ $title }}

                            </label>

                            <div class="input-group">

                                <input type="number"
                                       name="allowance[{{ $type }}]"
                                       class="form-control"
                                       min="0"
                                       max="365"
                                       value="{{ old(
                                           "allowance.$type",
                                           $allowance
                                       ) }}">

                                <span class="input-group-text">
                                    روز
                                </span>

                            </div>

                        </div>

                    @endforeach


                </div>


                <div class="mt-4">

                    <button type="submit"
                            class="btn btn-primary px-4">

                        <i class="bi bi-check-lg me-1"></i>

                        ذخیره سهمیه‌ها

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection