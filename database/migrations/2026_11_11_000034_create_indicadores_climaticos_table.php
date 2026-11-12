<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicadores_climaticos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nome');
            $table->string('unidade');
            $table->string('agregacao');
            $table->timestamps();
            $table->unique(['codigo'], 'indicadores_climaticos_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicadores_climaticos');
    }
};
