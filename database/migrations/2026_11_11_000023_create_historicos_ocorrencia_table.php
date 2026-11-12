<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historicos_ocorrencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->constrained('ocorrencias')->restrictOnDelete();
            $table->foreignId('ator_usuario_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->string('evento');
            $table->string('valor_anterior')->nullable();
            $table->string('valor_novo')->nullable();
            $table->text('justificativa')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historicos_ocorrencia');
    }
};
