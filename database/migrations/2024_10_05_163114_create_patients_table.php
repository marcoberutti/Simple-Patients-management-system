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
        Schema::create('patients', function (Blueprint $table) {
            $table->id(); // ID automatico
            $table->string('name'); // Nome del paziente
            $table->integer('age'); // Età del paziente
            $table->timestamps(); // Timestamps per created_at e updated_at
        });

        Schema::create('patient_weights', function (Blueprint $table) {
            $table->id(); // ID automatico
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // Chiave esterna
            $table->float('weight'); // Peso del paziente
            $table->timestamps(); // Timestamps per created_at e updated_at
        });

        Schema::create('patient_medical_histories', function (Blueprint $table) {
            $table->id(); // ID automatico
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // Chiave esterna
            $table->text('medical_history'); // Storia clinica del paziente
            $table->timestamps(); // Timestamps per created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
