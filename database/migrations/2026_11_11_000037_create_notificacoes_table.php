<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('ocorrencia_id')->nullable()->constrained('ocorrencias')->restrictOnDelete();
            $table->foreignId('acao_id')->nullable()->constrained('acoes')->restrictOnDelete();
            $table->string('titulo');
            $table->text('mensagem');
            $table->dateTime('lida_em')->nullable();
            $table->timestamps();
            $table->index(['usuario_id', 'lida_em'], 'notificacoes_index_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificacoes');
    }
};
