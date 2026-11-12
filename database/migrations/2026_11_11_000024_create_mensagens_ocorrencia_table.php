<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensagens_ocorrencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->constrained('ocorrencias')->restrictOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->string('autor_tipo');
            $table->text('mensagem');
            $table->boolean('publica')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensagens_ocorrencia');
    }
};
