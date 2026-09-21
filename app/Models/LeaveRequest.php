<?php

namespace App\Models;

use App\Enums\LeaveStatus;
use App\Enums\LeaveType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'leave_type',
        'status',
        'start_date',
        'end_date',
        'days',
        'year',
        'description',
        'approved_by',
        'approved_at',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [

            'start_date' => 'date',

            'end_date' => 'date',

            'approved_at' => 'datetime',

            'leave_type' => LeaveType::class,

            'status' => LeaveStatus::class,

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * پرسنل صاحب درخواست
     */
    public function employee()
    {
        return $this->belongsTo(
            Employee::class
        );
    }


    /**
     * مدیر تأییدکننده
     */
    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * فقط مرخصی‌های تأیید شده
     */
    public function scopeApproved($query)
    {
        return $query->where(
            'status',
            LeaveStatus::APPROVED
        );
    }


    /**
     * فقط مرخصی‌های در انتظار
     */
    public function scopePending($query)
    {
        return $query->where(
            'status',
            LeaveStatus::PENDING
        );
    }


    /**
     * فیلتر بر اساس نوع مرخصی
     */
    public function scopeOfType(
        $query,
        LeaveType $type
    ) {
        return $query->where(
            'leave_type',
            $type
        );
    }


    /**
     * مرخصی‌های یک سال
     */
    public function scopeForYear(
        $query,
        int $year
    ) {
        return $query->where(
            'year',
            $year
        );
    }
}