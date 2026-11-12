<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('territorio_id')->constrained('territorios')->restrictOnDelete();
            $table->foreignId('tipo_local_id')->constrained('tipos_local')->restrictOnDelete();
            $table->foreignId('local_pai_id')->nullable()->constrained('locais')->restrictOnDelete();
            $table->string('nome');
            $table->string('logradouro');
            $table->string('numero');
            $table->string('complemento');
            $table->string('codigo_postal');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 11, 7);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locais');
    }
};
