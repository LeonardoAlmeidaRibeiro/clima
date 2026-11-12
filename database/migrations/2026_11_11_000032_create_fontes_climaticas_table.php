<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fontes_climaticas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('codigo');
            $table->string('url')->nullable();
            $table->timestamps();
            $table->unique(['codigo'], 'fontes_climaticas_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fontes_climaticas');
    }
};
