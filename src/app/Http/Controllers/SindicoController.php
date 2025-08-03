<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Votacoes;

class SindicoController extends Controller
{
    public function dashboard()
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        // Buscar votações do síndico
        $idSindico = $usuario['id_usuario'];
        $votacoesAtivas = Votacoes::buscarAtivasPorSindico($idSindico);
        $votacoesEncerradas = Votacoes::buscarEncerradasPorSindico($idSindico);

        // Dados do dashboard do síndico
        $dados = [
            'usuario' => $usuario,
            'votacoesAtivas' => $votacoesAtivas,
            'votacoesEncerradas' => $votacoesEncerradas,
            'totalVotacoesAtivas' => $votacoesAtivas->count(),
            'totalVotacoesEncerradas' => $votacoesEncerradas->count(),
        ];

        return view('dashboard.sindico', $dados);
    }
}
