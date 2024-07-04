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
            $table->bigInteger('ci')->unsinged()->default(0);
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->tinyInteger('sex');
            $table->tinyInteger('state')->default(1);
            $table->date('birth_date');
            $table->string('direction');
            $table->date('f_income');
            $table->date('f_exit')->nullable();
            $table->date('f_re_entry')->nullable();
            $table->string('img_url')->nullable();;
            $table->foreignId('province_id')->nullable()->constrained('provinces')->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->foreignId('civil_status_id')->nullable()->constrained('civil_statuses')->onDelete('set null');
            $table->foreignId('position_id')->nullable()->constrained('positions')->onDelete('set null');
            $table->timestamps();
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
