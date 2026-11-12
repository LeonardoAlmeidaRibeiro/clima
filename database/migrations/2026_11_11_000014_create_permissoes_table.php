<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissoes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('descricao');
            $table->timestamps();
            $table->unique(['codigo'], 'permissoes_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissoes');
    }
};
