<?php

namespace App\Http\Controllers\Morador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VotacoesController extends Controller
{
    /**
     * Exibe as votações disponíveis para o morador
     */
    public function index()
    {
        return view('morador.votacoes.index');
    }

    /**
     * Registra o voto do morador
     */
    public function store(Request $request)
    {
        // Aqui seria implementada a lógica para registrar o voto
        // Por enquanto, apenas retorna uma resposta de sucesso
        
        $request->validate([
            'votacao_id' => 'required',
            'opcao_id' => 'required'
        ]);

        // Simular registro do voto
        return response()->json([
            'success' => true,
            'message' => 'Voto registrado com sucesso!'
        ]);
    }
}
