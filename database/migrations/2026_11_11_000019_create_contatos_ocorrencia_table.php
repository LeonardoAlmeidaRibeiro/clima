<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contatos_ocorrencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->constrained('ocorrencias')->restrictOnDelete();
            $table->text('nome_cifrado')->nullable();
            $table->text('email_cifrado')->nullable();
            $table->text('telefone_cifrado')->nullable();
            $table->timestamps();
            $table->unique(['ocorrencia_id'], 'contatos_ocorrencia_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contatos_ocorrencia');
    }
};
