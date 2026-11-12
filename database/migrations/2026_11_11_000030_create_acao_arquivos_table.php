<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acao_arquivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_id')->constrained('acoes')->restrictOnDelete();
            $table->foreignId('arquivo_id')->constrained('arquivos')->restrictOnDelete();
            $table->string('fase');
            $table->timestamps();
            $table->unique(['acao_id', 'arquivo_id'], 'acao_arquivos_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acao_arquivos');
    }
};
