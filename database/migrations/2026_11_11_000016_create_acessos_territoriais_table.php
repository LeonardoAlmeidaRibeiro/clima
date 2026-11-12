<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acessos_territoriais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vinculo_id')->constrained('vinculos_organizacionais')->restrictOnDelete();
            $table->foreignId('papel_id')->constrained('papeis')->restrictOnDelete();
            $table->foreignId('territorio_id')->constrained('territorios')->restrictOnDelete();
            $table->foreignId('concedido_por_id')->constrained('usuarios')->restrictOnDelete();
            $table->boolean('inclui_descendentes')->default(false);
            $table->dateTime('expira_em')->nullable();
            $table->dateTime('revogado_em')->nullable();
            $table->timestamps();
            $table->index(['vinculo_id', 'territorio_id'], 'acessos_territoriais_index_1');
            $table->index(['territorio_id', 'revogado_em'], 'acessos_territoriais_index_2');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acessos_territoriais');
    }
};
