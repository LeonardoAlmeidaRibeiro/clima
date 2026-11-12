<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acao_territorios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acao_id')->constrained('acoes')->restrictOnDelete();
            $table->foreignId('territorio_id')->constrained('territorios')->restrictOnDelete();
            $table->timestamps();
            $table->unique(['acao_id', 'territorio_id'], 'acao_territorios_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acao_territorios');
    }
};
