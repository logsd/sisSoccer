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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('stadium');
            $table->date('date');
            $table->time('time');
            $table->string('observation');
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'canceled'])->default('scheduled');
            $table->string('referee');
            $table->string('vocal');
            $table->tinyInteger('state')->default(1);
            $table->foreignId('team_home_id')->nullable()->constrained('teams')->onDelete('set null');
            $table->foreignId('team_away_id')->nullable()->constrained('teams')->onDelete('set null');
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
        Schema::dropIfExists('calendars');
    }
};
