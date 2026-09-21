<?php
namespace App\Models;

use App\Enums\LeaveType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'year',
        'leave_type',
        'allowance',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'allowance' => 'integer',
            'leave_type' => LeaveType::class,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
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
    | Calculated Attributes
    |--------------------------------------------------------------------------
    */

    public function getUsedDaysAttribute(): int
    {
        return LeaveRequest::query()
            ->where(
                'employee_id',
                $this->employee_id
            )
            ->where(
                'year',
                $this->year
            )
            ->where(
                'leave_type',
                $this->leave_type
            )
            ->approved()
            ->sum('days');
    }


    public function getRemainingDaysAttribute(): int
    {
        return max(
            0,
            $this->allowance - $this->used_days
        );
    }
}
