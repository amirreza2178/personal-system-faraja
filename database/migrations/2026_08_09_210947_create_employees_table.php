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
        Schema::create('employees', function (Blueprint $table) {
    $table->id();

    $table->string('first_name');
    $table->string('last_name');

    $table->string('rank');
    $table->string('father_name');

    $table->string('personnel_number')->unique();
    $table->string('national_code')->unique();
    $table->string('birth_certificate_number');

    $table->string('marital_status');

    $table->string('mobile');
    $table->string('backup_mobile')->nullable();
    $table->string('home_phone')->nullable();

    $table->text('home_address')->nullable();

    $table->date('birth_date');
    $table->date('promotion_date')->nullable();

    $table->string('education_field')->nullable();

    $table->string('job');

    $table->string('position');

    $table->string('service_branch');

    $table->text('service_summary')->nullable();

    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
