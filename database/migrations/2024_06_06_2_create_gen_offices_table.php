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
        Schema::create('gen_offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name');
            $table->string('address');
            $table->foreignId('report_id')->nullable()->constrained('gen_reports')->onDelete('set null');
            $table->foreignId('commission_league_id')->nullable()->constrained('commission_leagues')->onDelete('set null');
            $table->foreignId('charge_id')->nullable()->constrained('gen_charges')->onDelete('set null');
            $table->foreignId('club_id')->nullable()->constrained('clubs')->onDelete('set null');
            $table->tinyInteger('state')->default(1);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gen_offices');
    }
};
