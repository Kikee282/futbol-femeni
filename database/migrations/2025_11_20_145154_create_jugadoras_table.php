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
    Schema::create('jugadoras', function (Blueprint $table) {
        $table->id();
        // Relació 1:N amb Equips
        $table->foreignId('equip_id')->constrained('equips')->onDelete('cascade');
        
        $table->string('nom');
        $table->string('cognoms');
        $table->date('data_naixement');
        $table->integer('dorsal');
        $table->string('foto')->nullable(); // Pot no tenir foto al principi
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadoras');
    }
};
