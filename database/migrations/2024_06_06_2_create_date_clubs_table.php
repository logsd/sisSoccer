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
        Schema::create('date_clubs', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('operator')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('state')->default(1);
            $table->foreignId('club_id')->nullable()->constrained('clubs')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('date_clubs');
    }
};
