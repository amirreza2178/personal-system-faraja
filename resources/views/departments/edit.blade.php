@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <div class="page-title">
            ویرایش واحد سازمانی
        </div>

        <div class="page-subtitle">
            {{ $department->name }}
        </div>
    </div>

    <div class="header-actions">

        <a
            href="{{ route('departments.show', $department) }}"
            class="btn btn-secondary"
        >
            مشاهده واحد
        </a>

        <a
            href="{{ route('departments.index') }}"
            class="btn btn-secondary"
        >
            بازگشت
        </a>

    </div>

</div>


@if($errors->any())

    <div class="alert alert-danger">

        <strong>لطفاً خطاهای زیر را بررسی کنید:</strong>

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
                اطلاعات واحد را ویرایش کنید.
            </span>
        </div>

    </div>


    <form
        action="{{ route('departments.update', $department) }}"
        method="POST"
        class="form"
    >

        @csrf
        @method('PUT')


        <div class="form-grid">


            {{-- نام --}}
            <div class="form-group">

                <label for="name">
                    نام واحد
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $department->name) }}"
                    required
                >

            </div>


            {{-- کد --}}
            <div class="form-group">

                <label for="code">
                    کد واحد
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="code"
                    name="code"
                    value="{{ old('code', $department->code) }}"
                    required
                >

            </div>


            {{-- مدیر --}}
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
                            @selected(
                                old(
                                    'manager_id',
                                    $department->manager_id
                                ) == $employee->id
                            )
                        >
                            {{ $employee->first_name }}
                            {{ $employee->last_name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- وضعیت --}}
            <div class="form-group">

                <label>
                    وضعیت واحد
                </label>

                <label class="switch-row">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(
                            old(
                                'is_active',
                                $department->is_active
                            )
                        )
                    >

                    <span>
                        واحد فعال است
                    </span>

                </label>

            </div>


            {{-- توضیحات --}}
            <div class="form-group form-group-full">

                <label for="description">
                    توضیحات
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                >{{ old('description', $department->description) }}</textarea>

            </div>

        </div>


        <div class="form-actions">

            <a
                href="{{ route('departments.show', $department) }}"
                class="btn btn-secondary"
            >
                انصراف
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                ذخیره تغییرات
            </button>

        </div>

    </form>

</div>

@endsection