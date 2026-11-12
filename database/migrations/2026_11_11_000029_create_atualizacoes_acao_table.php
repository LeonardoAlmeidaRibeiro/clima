<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('atualizacoes_acao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_id')->constrained('acoes')->restrictOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->string('status_anterior')->nullable();
            $table->string('status_novo');
            $table->text('descricao');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atualizacoes_acao');
    }
};
