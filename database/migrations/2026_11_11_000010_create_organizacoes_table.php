<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizacao_pai_id')->nullable()->constrained('organizacoes')->restrictOnDelete();
            $table->foreignId('territorio_sede_id')->constrained('territorios')->restrictOnDelete();
            $table->string('nome');
            $table->string('sigla')->nullable();
            $table->string('tipo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizacoes');
    }
};
