<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            
            // Claus Foranes: local, visitant, estadi
            $table->foreignId('local_id')->nullable()->constrained('equips')->onDelete('set null');
            $table->foreignId('visitant_id')->nullable()->constrained('equips')->onDelete('set null');
            $table->foreignId('estadi_id')->nullable()->constrained('estadis')->onDelete('set null');

            $table->date('data');
            $table->integer('jornada')->nullable();
            
            // Gols: JSON
            $table->json('gols')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};