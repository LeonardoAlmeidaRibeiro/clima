<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enviado_por_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('revisado_por_id')->nullable()->constrained('usuarios')->restrictOnDelete();
            $table->string('storage_key');
            $table->string('nome_original');
            $table->string('mime_type');
            $table->unsignedBigInteger('tamanho_bytes');
            $table->string('status_revisao')->default('pendente');
            $table->timestamps();
            $table->unique(['storage_key'], 'arquivos_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};
