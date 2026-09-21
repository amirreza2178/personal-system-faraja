<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->enum('education_level', [
                'دیپلم',
                'فوق دیپلم',
                'لیسانس',
                'فوق لیسانس',
                'دکتری',
            ])->nullable()->after('education_field');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('education_level');
        });
    }
};