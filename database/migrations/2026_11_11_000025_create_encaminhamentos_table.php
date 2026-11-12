<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encaminhamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->constrained('ocorrencias')->restrictOnDelete();
            $table->foreignId('organizacao_destino_id')->constrained('organizacoes')->restrictOnDelete();
            $table->foreignId('enviado_por_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('responsavel_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->string('status')->default('pendente');
            $table->dateTime('prazo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encaminhamentos');
    }
};
