<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * اجرای Migration
     */
    public function up(): void
    {
        Schema::create('leave_balances', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Primary Key
            |--------------------------------------------------------------------------
            */

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Employee
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Year
            |--------------------------------------------------------------------------
            |
            | سال به صورت شمسی ذخیره می‌شود.
            |
            */

            $table->unsignedSmallInteger('year');


            /*
            |--------------------------------------------------------------------------
            | Leave Type
            |--------------------------------------------------------------------------
            */

            $table->enum('leave_type', [
                'entitlement',
                'encouragement',
                'sick',
                'continuity',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Annual Allowance
            |--------------------------------------------------------------------------
            |
            | سهمیه مجاز این نوع مرخصی برای این پرسنل در این سال.
            |
            */

            $table->unsignedSmallInteger('allowance')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Balance
            |--------------------------------------------------------------------------
            |
            | هر پرسنل در هر سال برای هر نوع مرخصی فقط یک سهمیه دارد.
            |
            */

            $table->unique(
                [
                    'employee_id',
                    'year',
                    'leave_type',
                ],
                'leave_balances_employee_year_type_unique'
            );

        });
    }


    /**
     * برگشت Migration
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};