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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nome', 100);
            $table->string('email', 100)->unique();
            $table->string('telefone', 20)->nullable();
            $table->string('cpf', 14)->unique();
            $table->string('senha_hash', 255);
            $table->enum('tipo_usuario', ['administrador', 'sindico', 'morador']);
            $table->enum('status', ['pendente', 'ativo', 'rejeitado'])->default('pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
