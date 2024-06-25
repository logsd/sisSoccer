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
        Schema::create('league_executives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dni')->unsinged()->default(0);
            $table->string('name');
            $table->string('lastname');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('img_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('league_executives');
    }
};
