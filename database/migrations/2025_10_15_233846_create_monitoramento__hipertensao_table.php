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
        Schema::create('monitoramento__hipertensao', function (Blueprint $table) {
            $table->id();
            $table->integer('pressao_sistolica');
            $table->integer('pressao_diastolica');
            $table->integer('freq_cardiaca');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoramento__hipertensaos');
    }
};
