@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">واحدهای سازمانی</div>
        <div class="page-subtitle">
            مدیریت ساختار سازمانی و واحدهای سیستم
        </div>
    </div>

    <a href="{{ route('departments.create') }}" class="btn btn-primary">
        + افزودن واحد سازمانی
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card">

    <div class="card-header">
        <div>
            <h3>لیست واحدها</h3>
            <span>
                {{ $departments->total() }} واحد سازمانی
            </span>
        </div>
    </div>

    <div class="table-wrapper">

        <table class="data-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>نام واحد</th>
                    <th>کد</th>
                    <th>مدیر</th>
                    <th>تعداد پرسنل</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>

            <tbody>

            @forelse($departments as $department)

                <tr>

                    <td>
                        {{ $departments->firstItem() + $loop->index }}
                    </td>

                    <td>
                        <strong>
                            {{ $department->name }}
                        </strong>
                    </td>

                    <td>
                        <span class="code-badge">
                            {{ $department->code }}
                        </span>
                    </td>

                    <td>
                        @if($department->manager)
                            {{ $department->manager->first_name }}
                            {{ $department->manager->last_name }}
                        @else
                            <span class="muted">
                                تعیین نشده
                            </span>
                        @endif
                    </td>

                    <td>
                        {{ $department->employees_count }} نفر
                    </td>

                    <td>

                        @if($department->is_active)

                            <span class="status-badge status-active">
                                فعال
                            </span>

                        @else

                            <span class="status-badge status-inactive">
                                غیرفعال
                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="action-group">

                            <a
                                href="{{ route('departments.show', $department) }}"
                                class="action-btn"
                            >
                                مشاهده
                            </a>

                            <a
                                href="{{ route('departments.edit', $department) }}"
                                class="action-btn"
                            >
                                ویرایش
                            </a>

                            <form
                                action="{{ route('departments.destroy', $department) }}"
                                method="POST"
                                onsubmit="return confirm('آیا از حذف این واحد مطمئن هستید؟')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-btn action-danger"
                                >
                                    حذف
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7">

                        <div class="empty-state">

                            <div class="empty-icon">
                                ◈
                            </div>

                            <h3>
                                هنوز واحدی ثبت نشده
                            </h3>

                            <p>
                                اولین واحد سازمانی سیستم را ایجاد کنید.
                            </p>

                            <a
                                href="{{ route('departments.create') }}"
                                class="btn btn-primary"
                            >
                                افزودن اولین واحد
                            </a>

                        </div>

                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    @if($departments->hasPages())
        <div class="pagination-wrapper">
            {{ $departments->links() }}
        </div>
    @endif

</div>

@endsection