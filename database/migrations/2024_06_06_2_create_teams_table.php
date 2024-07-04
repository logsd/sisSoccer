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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('gender');
            $table->tinyInteger('state')->default(1);
            $table->string('cluster');
            $table->bigInteger('points')->nullable();
            $table->bigInteger('player_number')->nullable();
            $table->string('gol_afa')->nullable();
            $table->string('gol_enc')->nullable();
            $table->string('description');
            $table->foreignId('championship_id')->nullable()->constrained('championships')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('club_id')->nullable()->constrained('clubs')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
