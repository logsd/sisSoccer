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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trade_name')->nullable();
            $table->string('reason_social')->nullable();
            $table->bigInteger('ruc')->unsinged()->default(0);
            $table->string('direction')->nullable();
            $table->string('email')->unique();
            $table->date('date_constion')->nullable();
            $table->string('direction_web')->nullable();
            $table->string('slogan')->nullable();
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->string('parish')->nullable();
            $table->tinyInteger('state')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
