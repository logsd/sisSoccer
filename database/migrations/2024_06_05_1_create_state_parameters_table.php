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
        Schema::create('state_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('process')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('vg')->default(1);
            $table->tinyInteger('state')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_parameters');
    }
};
