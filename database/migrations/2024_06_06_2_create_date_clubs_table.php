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
            $table->bigInteger('phone_number')->unsigned();
            $table->string('description');
            $table->string('operator');
            $table->tinyInteger('current');
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
