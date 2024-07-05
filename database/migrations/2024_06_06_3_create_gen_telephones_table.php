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
        Schema::create('gen_telephones', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('description');
            $table->tinyInteger('state')->default(1);
            $table->foreignId('league_executive_id')->nullable()->constrained('league_executives')->onDelete('set null');
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gen_telephones');
    }
};
