<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('territorio_id')->nullable()->constrained('territorios')->restrictOnDelete();
            $table->string('evento');
            $table->string('entidade');
            $table->unsignedBigInteger('entidade_id');
            $table->timestamps();
            $table->index(['entidade', 'entidade_id'], 'auditorias_index_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auditorias');
    }
};
