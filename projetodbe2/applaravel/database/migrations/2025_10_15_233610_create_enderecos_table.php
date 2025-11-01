<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->char('cep', length: 8);
            $table->string('logradouro', length: 100);
            $table->integer('numero');
            $table->string('complemento', length: 50);
            $table->string('bairro', length: 50);
            $table->string('cidade', length: 50);
            $table->char('estado', length: 2);
            $table->string('pais', length: 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
