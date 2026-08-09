<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'departmant_id',
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
    ];

    protected $casts = [
        'birth_date' => 'date',
        'promotion_date' => 'date',
    ];

    public function department()
{
    return $this->belongsTo(Department::class);
}

}