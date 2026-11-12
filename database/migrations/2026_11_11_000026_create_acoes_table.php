<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizacao_id')->constrained('organizacoes')->restrictOnDelete();
            $table->foreignId('responsavel_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('criado_por_id')->constrained('usuarios')->restrictOnDelete();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('status')->default('planejada');
            $table->dateTime('prazo')->nullable();
            $table->dateTime('iniciada_em')->nullable();
            $table->dateTime('concluida_em')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acoes');
    }
};
