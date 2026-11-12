<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pontos_monitoramento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fonte_id')->constrained('fontes_climaticas')->restrictOnDelete();
            $table->foreignId('territorio_id')->constrained('territorios')->restrictOnDelete();
            $table->string('codigo_externo');
            $table->string('nome');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 11, 7);
            $table->timestamps();
            $table->unique(['fonte_id', 'codigo_externo'], 'pontos_monitoramento_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pontos_monitoramento');
    }
};
