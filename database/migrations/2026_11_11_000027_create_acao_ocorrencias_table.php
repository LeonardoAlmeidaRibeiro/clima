<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acao_ocorrencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_id')->constrained('acoes')->restrictOnDelete();
            $table->foreignId('ocorrencia_id')->constrained('ocorrencias')->restrictOnDelete();
            $table->timestamps();
            $table->unique(['acao_id', 'ocorrencia_id'], 'acao_ocorrencias_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acao_ocorrencias');
    }
};
