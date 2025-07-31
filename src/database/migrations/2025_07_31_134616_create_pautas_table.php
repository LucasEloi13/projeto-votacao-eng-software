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
        Schema::create('pautas', function (Blueprint $table) {
            $table->id('id_pauta');
            $table->unsignedBigInteger('id_condominio');
            $table->unsignedBigInteger('id_sindico')->nullable();
            $table->string('titulo', 150);
            $table->text('descricao')->nullable();
            $table->datetime('data_inicio');
            $table->datetime('data_fim');
            $table->enum('status', ['ativa', 'encerrada'])->default('ativa');
            $table->timestamps();
            
            $table->foreign('id_condominio')->references('id_condominio')->on('condominios')->onDelete('cascade');
            $table->foreign('id_sindico')->references('id_sindico')->on('sindicos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pautas');
    }
};
