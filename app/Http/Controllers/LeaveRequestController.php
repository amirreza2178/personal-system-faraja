<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Services\LeaveRequestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaveRequestController extends Controller
{
    public function __construct(
        private LeaveRequestService $leaveRequestService
    ) {
    }

    /**
     * نمایش لیست درخواست‌های مرخصی
     */
    public function index(Request $request): View
    {
        $query = LeaveRequest::query()
            ->with('employee')
            ->latest();

        // فیلتر پرسنل
        if ($request->filled('employee_id')) {
            $query->where(
                'employee_id',
                $request->integer('employee_id')
            );
        }

        // فیلتر نوع مرخصی
        if ($request->filled('leave_type')) {
            $query->where(
                'leave_type',
                $request->input('leave_type')
            );
        }

        // فیلتر وضعیت
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->input('status')
            );
        }

        // فیلتر سال
        if ($request->filled('year')) {
            $query->where(
                'year',
                $request->integer('year')
            );
        }

        $leaveRequests = $query
            ->paginate(15)
            ->withQueryString();

        // آمار
        $totalCount = LeaveRequest::query()->count();

        $pendingCount = LeaveRequest::query()
            ->where('status', 'pending')
            ->count();

        $approvedCount = LeaveRequest::query()
            ->where('status', 'approved')
            ->count();

        $rejectedCount = LeaveRequest::query()
            ->where('status', 'rejected')
            ->count();

        // پرسنل
        // فعلاً چون Employee ستون is_active ندارد،
        // همه پرسنل را می‌گیریم.
        $employees = Employee::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        // سال‌های موجود
        $years = LeaveRequest::query()
            ->whereNotNull('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        return view('leave_requests.index', compact(
            'leaveRequests',
            'totalCount',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'employees',
            'years'
        ));
    }


    /**
     * فرم ثبت درخواست جدید
     */
    public function create(): View
    {
        $employees = Employee::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view(
            'leave_requests.create',
            compact('employees')
        );
    }


    /**
     * ذخیره درخواست
     */
    public function store(
        StoreLeaveRequest $request
    ): RedirectResponse {
        $this->leaveRequestService->create(
            $request->validated()
        );

        return redirect()
            ->route('leave-requests.index')
            ->with(
                'success',
                'درخواست مرخصی با موفقیت ثبت شد و در انتظار بررسی قرار گرفت.'
            );
    }


    /**
     * نمایش جزئیات
     */
    public function show(
        LeaveRequest $leaveRequest
    ): View {
        $leaveRequest->load('employee');

        return view(
            'leave_requests.show',
            compact('leaveRequest')
        );
    }


    /**
     * فرم ویرایش
     */
    public function edit(
        LeaveRequest $leaveRequest
    ): View {
        $employees = Employee::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        $leaveRequest->load('employee');

        return view(
            'leave_requests.edit',
            compact(
                'leaveRequest',
                'employees'
            )
        );
    }


    /**
     * بروزرسانی
     */
    public function update(
        UpdateLeaveRequest $request,
        LeaveRequest $leaveRequest
    ): RedirectResponse {
        $this->leaveRequestService->update(
            $leaveRequest,
            $request->validated()
        );

        return redirect()
            ->route('leave-requests.index')
            ->with(
                'success',
                'درخواست مرخصی با موفقیت ویرایش شد.'
            );
    }


    /**
     * حذف
     */
    public function destroy(
        LeaveRequest $leaveRequest
    ): RedirectResponse {
        $leaveRequest->delete();

        return redirect()
            ->route('leave-requests.index')
            ->with(
                'success',
                'درخواست مرخصی با موفقیت حذف شد.'
            );
    }


    /**
     * تأیید
     */
    public function approve(
        LeaveRequest $leaveRequest
    ): RedirectResponse {
        $this->leaveRequestService->approve(
            $leaveRequest
        );

        return redirect()
            ->route('leave-requests.index')
            ->with(
                'success',
                'درخواست مرخصی با موفقیت تأیید شد.'
            );
    }


    /**
     * رد
     */
    public function reject(
        Request $request,
        LeaveRequest $leaveRequest
    ): RedirectResponse {
        $validated = $request->validate(
            [
                'rejection_reason' => [
                    'nullable',
                    'string',
                    'max:2000',
                ],
            ],
            [
                'rejection_reason.max' =>
                    'علت رد نمی‌تواند بیشتر از ۲۰۰۰ کاراکتر باشد.',
            ]
        );

        $this->leaveRequestService->reject(
            $leaveRequest,
            $validated['rejection_reason'] ?? null
        );

        return redirect()
            ->route('leave-requests.index')
            ->with(
                'success',
                'درخواست مرخصی رد شد.'
            );
    }


    /**
     * لغو
     */
public function cancel(LeaveRequest $leaveRequest): RedirectResponse
{
    $status = $leaveRequest->status instanceof \BackedEnum
        ? (string) $leaveRequest->status->value
        : (string) $leaveRequest->status;

    if ($status !== 'pending') {
        return redirect()
            ->route('leave-requests.index')
            ->with('error', 'فقط درخواست‌های در انتظار بررسی قابل لغو هستند.');
    }

    $leaveRequest->update([
        'status' => 'cancelled',
    ]);

    return redirect()
        ->route('leave-requests.index')
        ->with('success', 'درخواست مرخصی با موفقیت لغو شد.');
}

}