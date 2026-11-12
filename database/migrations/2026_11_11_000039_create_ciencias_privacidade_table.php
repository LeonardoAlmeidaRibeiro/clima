<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ciencias_privacidade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aviso_id')->constrained('versoes_aviso_privacidade')->restrictOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('ocorrencia_id')->nullable()->constrained('ocorrencias')->restrictOnDelete();
            $table->dateTime('registrado_em');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ciencias_privacidade');
    }
};
