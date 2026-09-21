<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('employees', 'education_level')) {
            Schema::table('employees', function (Blueprint $table) {
                $table->string('education_level')->nullable()->after('education_field');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('employees', 'education_level')) {
            Schema::table('employees', function (Blueprint $table) {
                $table->dropColumn('education_level');
            });
        }
    }
};
