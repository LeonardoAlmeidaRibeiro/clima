<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ocorrencia_arquivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->constrained('ocorrencias')->restrictOnDelete();
            $table->foreignId('arquivo_id')->constrained('arquivos')->restrictOnDelete();
            $table->string('legenda')->nullable();
            $table->timestamps();
            $table->unique(['ocorrencia_id', 'arquivo_id'], 'ocorrencia_arquivos_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ocorrencia_arquivos');
    }
};
