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
        Schema::create('general_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_parameters_id')->constrained('state_parameters')->onDelete('cascade');
            $table->foreignId('civil_status_id')->constrained('civil_statuses')->onDelete('cascade');
            $table->foreignId('phone_operator_id')->constrained('phone_operators')->onDelete('cascade');
            $table->foreignId('taxpayer_types_id')->constrained('taxpayer_types')->onDelete('cascade');
            $table->foreignId('type_parameters_id')->constrained('type_parameters')->onDelete('cascade');
            $table->foreignId('type_sanctions_id')->constrained('type_sanctions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_parameters');
    }
};
