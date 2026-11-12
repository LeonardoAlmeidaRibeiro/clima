<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vinculos_organizacionais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('organizacao_id')->constrained('organizacoes')->restrictOnDelete();
            $table->string('cargo')->nullable();
            $table->dateTime('iniciado_em');
            $table->dateTime('encerrado_em')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vinculos_organizacionais');
    }
};
