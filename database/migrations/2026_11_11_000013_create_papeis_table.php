<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('papeis', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nome');
            $table->timestamps();
            $table->unique(['codigo'], 'papeis_unique_1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('papeis');
    }
};
