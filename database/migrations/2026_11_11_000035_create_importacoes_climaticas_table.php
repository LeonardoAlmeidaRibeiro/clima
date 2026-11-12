<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('importacoes_climaticas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fonte_id')->constrained('fontes_climaticas')->restrictOnDelete();
            $table->string('status')->default('pendente');
            $table->dateTime('iniciada_em')->nullable();
            $table->dateTime('finalizada_em')->nullable();
            $table->unsignedInteger('quantidade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('importacoes_climaticas');
    }
};
