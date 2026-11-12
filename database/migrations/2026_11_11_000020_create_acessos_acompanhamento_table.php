<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acessos_acompanhamento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->constrained('ocorrencias')->restrictOnDelete();
            $table->string('token_hash', 64);
            $table->dateTime('expira_em')->nullable();
            $table->timestamps();
            $table->unique(['token_hash'], 'acessos_acompanhamento_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acessos_acompanhamento');
    }
};
