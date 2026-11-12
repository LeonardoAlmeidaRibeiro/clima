<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained('pessoas')->restrictOnDelete();
            $table->string('email');
            $table->string('password');
            $table->string('status')->default('ativo');
            $table->timestamps();
            $table->unique(['pessoa_id'], 'usuarios_unique_1');
            $table->unique(['email'], 'usuarios_unique_2');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
