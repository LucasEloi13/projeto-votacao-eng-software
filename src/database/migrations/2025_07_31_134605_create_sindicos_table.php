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
        Schema::create('sindicos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_sindico')->primary();
            $table->unsignedBigInteger('id_condominio');
            $table->enum('status', ['ativo', 'inativo'])->default('inativo');
            $table->timestamps();
            
            $table->foreign('id_sindico')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_condominio')->references('id_condominio')->on('condominios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sindicos');
    }
};
