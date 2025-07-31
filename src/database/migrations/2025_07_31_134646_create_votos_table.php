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
        Schema::create('votos', function (Blueprint $table) {
            $table->id('id_voto');
            $table->unsignedBigInteger('id_morador');
            $table->unsignedBigInteger('id_pauta');
            $table->unsignedBigInteger('id_opcao');
            $table->datetime('data_hora_voto')->default(now());
            $table->timestamps();
            
            $table->foreign('id_morador')->references('id_morador')->on('moradores')->onDelete('cascade');
            $table->foreign('id_pauta')->references('id_pauta')->on('pautas')->onDelete('cascade');
            $table->foreign('id_opcao')->references('id_opcao')->on('opcao_votos')->onDelete('cascade');
            
            // Garante voto único por pauta
            $table->unique(['id_morador', 'id_pauta']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votos');
    }
};
