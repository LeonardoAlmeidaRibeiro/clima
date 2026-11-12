<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('papel_permissoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('papel_id')->constrained('papeis')->restrictOnDelete();
            $table->foreignId('permissao_id')->constrained('permissoes')->restrictOnDelete();
            $table->timestamps();
            $table->unique(['papel_id', 'permissao_id'], 'papel_permissoes_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('papel_permissoes');
    }
};
