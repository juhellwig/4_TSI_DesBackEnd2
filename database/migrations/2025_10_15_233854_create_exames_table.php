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
        Schema::create('monitoramento__exames', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', length:100);
            $table->string('tipo_exame', length:50);
            $table->date('data_exame');
            $table->string('arquivo', length:255);
            $table->enum('tipo_arquivo', ['pdf', 'imagem']);
            $table->enum('enviado_por', ['paciente', 'profissional']);
            $table->dateTimeTz('data_envio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoramento__exames');
    }
};
