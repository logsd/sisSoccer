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
        Schema::create('taxpayer_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->tinyInteger('a_cont')->default(1);
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
        Schema::dropIfExists('taxpayer_types');
    }
};
