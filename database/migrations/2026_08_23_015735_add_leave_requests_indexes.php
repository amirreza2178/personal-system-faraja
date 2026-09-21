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
        Schema::table('leave_requests', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Filtering Indexes
            |--------------------------------------------------------------------------
            */

            $table->index(
                'status',
                'leave_requests_status_index'
            );

            $table->index(
                'leave_type',
                'leave_requests_leave_type_index'
            );

            $table->index(
                'start_date',
                'leave_requests_start_date_index'
            );

            $table->index(
                'end_date',
                'leave_requests_end_date_index'
            );


            /*
            |--------------------------------------------------------------------------
            | Composite Indexes
            |--------------------------------------------------------------------------
            */

            $table->index(
                ['employee_id', 'status'],
                'leave_requests_employee_status_index'
            );

            $table->index(
                ['status', 'start_date'],
                'leave_requests_status_start_date_index'
            );

            $table->index(
                ['leave_type', 'status'],
                'leave_requests_type_status_index'
            );

        });
    }


    /**
     * برگشت Migration
     */
    public function down(): void
    {
        Schema::table('leave_requests', function (Blueprint $table) {

            $table->dropIndex(
                'leave_requests_status_index'
            );

            $table->dropIndex(
                'leave_requests_leave_type_index'
            );

            $table->dropIndex(
                'leave_requests_start_date_index'
            );

            $table->dropIndex(
                'leave_requests_end_date_index'
            );

            $table->dropIndex(
                'leave_requests_employee_status_index'
            );

            $table->dropIndex(
                'leave_requests_status_start_date_index'
            );

            $table->dropIndex(
                'leave_requests_type_status_index'
            );

        });
    }
};