<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes_acao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_id')->constrained('acoes')->restrictOnDelete();
            $table->foreignId('ocorrencia_id')->nullable()->constrained('ocorrencias')->restrictOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->string('percepcao');
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes_acao');
    }
};
