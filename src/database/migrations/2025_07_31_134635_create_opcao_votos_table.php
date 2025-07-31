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
        Schema::create('opcao_votos', function (Blueprint $table) {
            $table->id('id_opcao');
            $table->unsignedBigInteger('id_pauta');
            $table->string('descricao', 100);
            $table->timestamps();
            
            $table->foreign('id_pauta')->references('id_pauta')->on('pautas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opcao_votos');
    }
};
