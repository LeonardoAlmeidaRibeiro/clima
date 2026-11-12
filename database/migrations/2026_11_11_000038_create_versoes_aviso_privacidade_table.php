<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('versoes_aviso_privacidade', function (Blueprint $table) {
            $table->id();
            $table->string('versao');
            $table->text('texto');
            $table->dateTime('publicado_em');
            $table->timestamps();
            $table->unique(['versao'], 'versoes_aviso_privacidade_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('versoes_aviso_privacidade');
    }
};
