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
        Schema::create('patient_heights', function (Blueprint $table) {
            $table->id(); // ID automatico
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // Chiave esterna
            $table->float('height'); // Altezza del paziente
            $table->timestamps(); // Timestamps per created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_heights');
    }
};
