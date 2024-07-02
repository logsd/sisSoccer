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
        Schema::create('league_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->tinyInteger('state')->default(1);
            $table->foreignId('league_phase_id')->nullable()->constrained('league_phases')->onDelete('set null');
            $table->foreignId('championship_id')->nullable()->constrained('championships')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('league_groups');
    }
};
