@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <div class="page-title">
            افزودن واحد سازمانی
        </div>

        <div class="page-subtitle">
            ایجاد یک واحد جدید در ساختار سازمان
        </div>
    </div>

    <a
        href="{{ route('departments.index') }}"
        class="btn btn-secondary"
    >
        بازگشت
    </a>

</div>

@if($errors->any())

    <div class="alert alert-danger">

        <strong>
            لطفاً خطاهای زیر را بررسی کنید:
        </strong>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif

<div class="card form-card">

    <div class="card-header">

        <div>
            <h3>اطلاعات واحد سازمانی</h3>

            <span>
                اطلاعات پایه واحد را وارد کنید.
            </span>
        </div>

    </div>

    <form
        action="{{ route('departments.store') }}"
        method="POST"
        class="form"
    >

        @csrf

        <div class="form-grid">

            <div class="form-group">

                <label for="name">
                    نام واحد
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="مثلاً واحد عقیدتی سیاسی"
                    required
                >

            </div>

            <div class="form-group">

                <label for="code">
                    کد واحد
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="code"
                    name="code"
                    value="{{ old('code') }}"
                    placeholder="مثلاً AQ-001"
                    required
                >

            </div>

            <div class="form-group">

                <label for="manager_id">
                    مدیر واحد
                </label>

                <select
                    id="manager_id"
                    name="manager_id"
                >

                    <option value="">
                        بدون مدیر
                    </option>

                    @foreach($employees as $employee)

                        <option
                            value="{{ $employee->id }}"
                            @selected(old('manager_id') == $employee->id)
                        >
                            {{ $employee->first_name }}
                            {{ $employee->last_name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label>
                    وضعیت واحد
                </label>

                <label class="switch-row">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(old('is_active', true))
                    >

                    <span>
                        واحد فعال است
                    </span>

                </label>

            </div>

            <div class="form-group form-group-full">

                <label for="description">
                    توضیحات
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="توضیحات مربوط به واحد..."
                >{{ old('description') }}</textarea>

            </div>

        </div>

        <div class="form-actions">

            <a
                href="{{ route('departments.index') }}"
                class="btn btn-secondary"
            >
                انصراف
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                ثبت واحد سازمانی
            </button>

        </div>

    </form>

</div>

@endsection