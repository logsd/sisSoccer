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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dni')->unsinged()->default(0);
            $table->string('name');
            $table->string('last_name');
            $table->tinyInteger('sexo')->nullable();
            $table->tinyInteger('state')->default(1);
            $table->date('birthday');
            $table->bigInteger('position');
            $table->string('direction');
            $table->tinyInteger('eneabled')->default(1);
            $table->tinyInteger('own')->nullable();
            $table->tinyInteger('booster')->nullable();
            $table->tinyInteger('youth')->nullable();
            $table->tinyInteger('certified')->nullable();
            $table->string('observation')->nullable();
            $table->date('f_from');
            $table->date('f_until')->nullable();
            $table->foreignId('province_id')->nullable()->constrained('provinces')->onDelete('set null');
            $table->foreignId('league_id')->nullable()->constrained('leagues')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('loan_id')->nullable()->constrained('loans')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
