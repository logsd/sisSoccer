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
        Schema::create('direct_clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('position')->unique()->nullable(); // Posición en el club (e.g., Presidente, Vicepresidente)
            $table->string('observation');
            $table->foreignId('club_id')->nullable()->constrained('clubs')->onDelete('set null');
            $table->foreignId('championship_id')->nullable()->constrained('championships')->onDelete('set null');
            $table->tinyInteger('state')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_clubs');
    }
};
