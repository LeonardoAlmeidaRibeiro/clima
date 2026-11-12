<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizacao_territorios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizacao_id')->constrained('organizacoes')->restrictOnDelete();
            $table->foreignId('territorio_id')->constrained('territorios')->restrictOnDelete();
            $table->boolean('inclui_descendentes')->default(false);
            $table->timestamps();
            $table->unique(['organizacao_id', 'territorio_id'], 'organizacao_territorios_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizacao_territorios');
    }
};
