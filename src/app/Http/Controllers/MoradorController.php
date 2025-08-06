<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MoradorController extends Controller
{
    /**
     * Verificar se o usuário está autenticado e é morador
     */
    private function verificarAutorizacao()
    {
        if (!Session::has('usuario')) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        $usuario = Session::get('usuario');
        if ($usuario['tipo_usuario'] !== 'morador') {
            return redirect('/')->with('error', 'Acesso negado. Apenas moradores podem acessar esta página.');
        }

        return null;
    }

    /**
     * Display the morador dashboard.
     */
    public function dashboard()
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        return view('morador.dashboard');
    }
}
