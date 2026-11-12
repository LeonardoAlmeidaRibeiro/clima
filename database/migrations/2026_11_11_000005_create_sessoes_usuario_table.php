<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessoes_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->restrictOnDelete();
            $table->string('token_hash', 64);
            $table->dateTime('expira_em')->nullable();
            $table->timestamps();
            $table->unique(['token_hash'], 'sessoes_usuario_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessoes_usuario');
    }
};
