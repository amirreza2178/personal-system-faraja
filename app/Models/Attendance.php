<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [

        'employee_id',

        'attendance_date',

        'check_in',

        'check_out',

        'status',

        'description',

    ];


    protected $casts = [

        'attendance_date' => 'date',

    ];


    /*
    |--------------------------------------------------------------------------
    | Employee Relationship
    |--------------------------------------------------------------------------
    */

    public function employee()
    {
        return $this->belongsTo(
            Employee::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeForDate(
        Builder $query,
        $date
    ) {
        return $query->where(
            'attendance_date',
            $date
        );
    }


    public function scopeForEmployee(
        Builder $query,
        $employeeId
    ) {
        return $query->where(
            'employee_id',
            $employeeId
        );
    }


    public function scopePresent(
        Builder $query
    ) {
        return $query->where(
            'status',
            'present'
        );
    }


    public function scopeAbsent(
        Builder $query
    ) {
        return $query->where(
            'status',
            'absent'
        );
    }


    public function scopeLate(
        Builder $query
    ) {
        return $query->where(
            'status',
            'late'
        );
    }
}
