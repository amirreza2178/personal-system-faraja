@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <div class="page-title">
            {{ $department->name }}
        </div>

        <div class="page-subtitle">
            مشاهده اطلاعات و پرسنل واحد سازمانی
        </div>
    </div>

    <div class="header-actions">

        <a
            href="{{ route('departments.edit', $department) }}"
            class="btn btn-primary"
        >
            ویرایش واحد
        </a>

        <a
            href="{{ route('departments.index') }}"
            class="btn btn-secondary"
        >
            بازگشت
        </a>

    </div>

</div>

{{-- اطلاعات اصلی --}}
<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-label">
            کد واحد
        </div>

        <div class="stat-value">
            {{ $department->code }}
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-label">
            تعداد پرسنل
        </div>

        <div class="stat-value">
            {{ $department->employees_count }}
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-label">
            مدیر واحد
        </div>

        <div class="stat-value">

            @if($department->manager)

                {{ $department->manager->first_name }}
                {{ $department->manager->last_name }}

            @else

                تعیین نشده

            @endif

        </div>

    </div>

    <div class="stat-card">

        <div class="stat-label">
            وضعیت
        </div>

        <div class="stat-value">

            @if($department->is_active)

                <span class="status-badge status-active">
                    فعال
                </span>

            @else

                <span class="status-badge status-inactive">
                    غیرفعال
                </span>

            @endif

        </div>

    </div>

</div>


{{-- توضیحات --}}
@if($department->description)

<div class="card">

    <div class="card-header">

        <div>
            <h3>توضیحات واحد</h3>
        </div>

    </div>

    <div class="card-body">

        <p class="description-text">
            {{ $department->description }}
        </p>

    </div>

</div>

@endif


{{-- مدیر --}}
<div class="card">

    <div class="card-header">

        <div>
            <h3>مدیر واحد</h3>

            <span>
                مسئول فعلی این واحد
            </span>
        </div>

    </div>

    <div class="card-body">

        @if($department->manager)

            <div class="employee-manager">

                <div class="employee-avatar">
                    {{ mb_substr($department->manager->first_name, 0, 1) }}
                </div>

                <div class="employee-manager-info">

                    <strong>
                        {{ $department->manager->first_name }}
                        {{ $department->manager->last_name }}
                    </strong>

                    <span>
                        کد پرسنلی:
                        {{ $department->manager->personnel_number ?? '---' }}
                    </span>

                </div>

                @if(Route::has('employees.show'))

                    <a
                        href="{{ route('employees.show', $department->manager) }}"
                        class="btn btn-secondary"
                    >
                        مشاهده پرونده
                    </a>

                @endif

            </div>

        @else

            <div class="empty-inline">
                مدیر برای این واحد تعیین نشده است.
            </div>

        @endif

    </div>

</div>


{{-- پرسنل --}}
<div class="card">

    <div class="card-header">

        <div>
            <h3>پرسنل واحد</h3>

            <span>
                {{ $department->employees_count }} نفر
            </span>
        </div>

        @if(Route::has('employees.create'))

            <a
                href="{{ route('employees.create') }}"
                class="btn btn-primary"
            >
                + افزودن پرسنل
            </a>

        @endif

    </div>

    <div class="table-wrapper">

        <table class="data-table">

            <thead>

                <tr>
                    <th>#</th>
                    <th>نام و نام خانوادگی</th>
                    <th>کد پرسنلی</th>
                    <th>سمت</th>
                    <th>موبایل</th>
                    <th>عملیات</th>
                </tr>

            </thead>

            <tbody>

            @forelse($department->employees as $employee)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>

                        <strong>
                            {{ $employee->first_name }}
                            {{ $employee->last_name }}
                        </strong>

                    </td>

                    <td>
                        {{ $employee->personnel_number ?? '---' }}
                    </td>

                    <td>
                        {{ $employee->position ?? '---' }}
                    </td>

                    <td>
                        {{ $employee->mobile ?? '---' }}
                    </td>

                    <td>

                        @if(Route::has('employees.show'))

                            <a
                                href="{{ route('employees.show', $employee) }}"
                                class="action-btn"
                            >
                                مشاهده پرونده
                            </a>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6">

                        <div class="empty-state">

                            <div class="empty-icon">
                                ◈
                            </div>

                            <h3>
                                این واحد هنوز پرسنلی ندارد
                            </h3>

                            <p>
                                اولین پرسنل را به این واحد اضافه کنید.
                            </p>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection