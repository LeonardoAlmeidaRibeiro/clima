<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('territorios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pai_id')->nullable()->constrained('territorios')->restrictOnDelete();
            $table->string('nome');
            $table->string('tipo');
            $table->string('codigo_oficial')->nullable();
            $table->timestamps();
            $table->unique(['codigo_oficial'], 'territorios_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('territorios');
    }
};
