<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pessoa_contatos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained('pessoas')->restrictOnDelete();
            $table->string('tipo');
            $table->text('valor_cifrado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pessoa_contatos');
    }
};
