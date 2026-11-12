<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->id();
            $table->string('protocolo');
            $table->foreignId('local_id')->nullable()->constrained('locais')->restrictOnDelete();
            $table->foreignId('territorio_id')->constrained('territorios')->restrictOnDelete();
            $table->foreignId('categoria_id')->constrained('categorias_ocorrencia')->restrictOnDelete();
            $table->foreignId('relator_pessoa_id')->nullable()->constrained('pessoas')->restrictOnDelete();
            $table->foreignId('registrado_por_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('ocorrencia_original_id')->nullable()->constrained('ocorrencias')->restrictOnDelete();
            $table->string('titulo');
            $table->text('descricao');
            $table->dateTime('ocorrido_em');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 11, 7);
            $table->string('gravidade_informada');
            $table->string('prioridade_gestao')->nullable();
            $table->string('status_moderacao')->default('pendente');
            $table->string('status_atendimento')->default('registrada');
            $table->string('visibilidade')->default('publica');
            $table->timestamps();
            $table->unique(['protocolo'], 'ocorrencias_unique_1');
            $table->index(['territorio_id', 'ocorrido_em'], 'ocorrencias_index_1');
            $table->index(['status_moderacao', 'created_at'], 'ocorrencias_index_2');
            $table->index(['categoria_id', 'status_atendimento'], 'ocorrencias_index_3');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ocorrencias');
    }
};
