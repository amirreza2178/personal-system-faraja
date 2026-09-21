<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::query()
            ->with('manager')
            ->withCount('employees')
            ->latest()
            ->paginate(10);

        return view('departments.index', compact('departments'));
    }

    public function create(): View
    {
        $employees = Employee::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('departments.create', compact('employees'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:departments,name',
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                'unique:departments,code',
            ],

            'manager_id' => [
                'nullable',
                'integer',
                'exists:employees,id',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Department::create($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', 'واحد سازمانی با موفقیت ایجاد شد.');
    }

    public function show(Department $department): View
{
    $department->load([
        'manager',
        'employees' => fn ($query) => $query
            ->orderBy('first_name')
            ->orderBy('last_name'),
    ]);

    $department->loadCount('employees');

    return view('departments.show', compact('department'));
}

    public function edit(Department $department): View
    {
        $employees = Employee::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view(
            'departments.edit',
            compact('department', 'employees')
        );
    }

    public function update(
        Request $request,
        Department $department
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')
                    ->ignore($department->id),
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('departments', 'code')
                    ->ignore($department->id),
            ],

            'manager_id' => [
                'nullable',
                'integer',
                'exists:employees,id',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $department->update($validated);

        return redirect()
            ->route('departments.index')
            ->with('success', 'واحد سازمانی با موفقیت ویرایش شد.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        if ($department->employees()->exists()) {
            return back()->with(
                'error',
                'این واحد دارای پرسنل است و فعلاً قابل حذف نیست.'
            );
        }

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'واحد سازمانی حذف شد.');
    }
}