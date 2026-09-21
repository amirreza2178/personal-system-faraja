<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\LeaveBalance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'first_name',
        'last_name',
        'rank',
        'father_name',
        'personnel_number',
        'national_code',
        'birth_certificate_number',
        'marital_status',
        'mobile',
        'backup_mobile',
        'home_phone',
        'home_address',
        'birth_date',
        'promotion_date',
        'education_field',
        'job',
        'position',
        'service_branch',
        'service_summary',
        'department_id',
        'education_level',
        'status',


    ];

    protected $casts = [

        'birth_date' => 'date',
        'promotion_date' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Department Relationship
    |--------------------------------------------------------------------------
    */

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    /**
 * Employee attendances.
 */
public function attendances()
{
    return $this->hasMany(
        Attendance::class
    );
}


public function leaveRequests()
{
    return $this->hasMany(LeaveRequest::class);
}

/**
 * سهمیه‌های مرخصی پرسنل
 */
/**
 * موجودی مرخصی پرسنل
 */
public function leaveBalances(): HasMany
{
    return $this->hasMany(
        LeaveBalance::class
    );
}

}
