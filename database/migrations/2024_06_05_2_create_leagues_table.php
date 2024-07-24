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
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trade_name');
            $table->string('business_name');
            $table->bigInteger('ruc')->unique()->unsinged();
            $table->string('direction');
            $table->string('email')->unique();
            $table->date('constitution_date');
            $table->string('direction_web');
            $table->string('slogan');
            $table->string('url_logo');
            $table->string('description');
            $table->string('url_sello');
            $table->tinyInteger('state')->default(1);
            $table->foreignId('taxpayer_id')->nullable()->constrained('taxpayer_types')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leagues');
    }
};
