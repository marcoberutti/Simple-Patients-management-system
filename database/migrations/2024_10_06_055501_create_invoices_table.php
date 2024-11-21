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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('item');
            $table->integer('quantity')->default(1);
            $table->decimal('amount', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('deposit', 8, 2)->default(0);
            $table->decimal('total', 8, 2);
            $table->timestamps();
            
            // Aggiungere una relazione con la tabella pazienti (se presente)
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
