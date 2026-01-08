<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('posicio');
            
            // Relació 1:N amb Equips
            $table->foreignId('equip_id')
                  ->nullable()
                  ->constrained('equips')
                  ->onDelete('set null'); // Mantenir la integritat de les dades

            // Nous camps requerits
            $table->date('data_naixement')->nullable();
            $table->integer('dorsal')->nullable();
            $table->string('foto')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};