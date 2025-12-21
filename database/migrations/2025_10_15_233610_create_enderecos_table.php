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
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->unique()
                    ->cascadeOnDelete();
            $table->char('cep', length: 8);
            $table->string('logradouro', length: 150);
            $table->integer('numero');
            $table->string('complemento', length: 80)->nullable();
            $table->string('bairro', length: 80);
            $table->string('cidade', length: 80);
            $table->char('estado', length: 2);
            $table->string('pais', length: 50);
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
