<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicoes_climaticas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ponto_id')->constrained('pontos_monitoramento')->restrictOnDelete();
            $table->foreignId('indicador_id')->constrained('indicadores_climaticos')->restrictOnDelete();
            $table->foreignId('importacao_id')->nullable()->constrained('importacoes_climaticas')->restrictOnDelete();
            $table->dateTime('periodo_inicio');
            $table->dateTime('periodo_fim');
            $table->decimal('valor', 18, 6);
            $table->string('qualidade')->nullable();
            $table->timestamps();
            $table->unique(['ponto_id', 'indicador_id', 'periodo_inicio', 'periodo_fim'], 'medicoes_climaticas_unique_1');
            $table->index(['indicador_id', 'periodo_inicio'], 'medicoes_climaticas_index_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicoes_climaticas');
    }
};
