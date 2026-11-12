<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('territorio_hierarquia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ancestral_id')->constrained('territorios')->restrictOnDelete();
            $table->foreignId('descendente_id')->constrained('territorios')->restrictOnDelete();
            $table->unsignedInteger('profundidade');
            $table->timestamps();
            $table->unique(['ancestral_id', 'descendente_id'], 'territorio_hierarquia_unique_1');
            $table->index(['descendente_id', 'profundidade'], 'territorio_hierarquia_index_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('territorio_hierarquia');
    }
};
