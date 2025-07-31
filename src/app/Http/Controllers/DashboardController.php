<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function admin()
    {
        // Verificar se é admin
        $authController = new AuthController();
        $redirect = $authController->checkAuth('administrador');
        if ($redirect) return $redirect;

        $usuario = Session::get('usuario');
        
        // Estatísticas para o dashboard
        $stats = [
            'total_usuarios' => DB::table('usuarios')->count(),
            'total_condominios' => DB::table('condominios')->count(),
            'total_pautas_ativas' => DB::table('pautas')->where('status', 'ativa')->count(),
            'usuarios_pendentes' => DB::table('usuarios')->where('status', 'pendente')->count()
        ];

        return view('dashboard.admin', compact('usuario', 'stats'));
    }

    public function sindico()
    {
        // Verificar se é síndico
        $authController = new AuthController();
        $redirect = $authController->checkAuth('sindico');
        if ($redirect) return $redirect;

        $usuario = Session::get('usuario');
        
        // Buscar dados do síndico
        $sindico = DB::table('sindicos')
            ->join('condominios', 'sindicos.id_condominio', '=', 'condominios.id_condominio')
            ->where('sindicos.id_sindico', $usuario['id_usuario'])
            ->select('sindicos.*', 'condominios.nome as nome_condominio')
            ->first();

        if (!$sindico) {
            return redirect()->route('login')->withErrors(['error' => 'Síndico não encontrado.']);
        }

        // Estatísticas do condomínio
        $stats = [
            'total_moradores' => DB::table('moradores')->where('id_condominio', $sindico->id_condominio)->count(),
            'pautas_ativas' => DB::table('pautas')->where('id_condominio', $sindico->id_condominio)->where('status', 'ativa')->count(),
            'pautas_encerradas' => DB::table('pautas')->where('id_condominio', $sindico->id_condominio)->where('status', 'encerrada')->count()
        ];

        return view('dashboard.sindico', compact('usuario', 'sindico', 'stats'));
    }

    public function morador()
    {
        // Verificar se é morador
        $authController = new AuthController();
        $redirect = $authController->checkAuth('morador');
        if ($redirect) return $redirect;

        $usuario = Session::get('usuario');
        
        // Buscar dados do morador
        $morador = DB::table('moradores')
            ->join('condominios', 'moradores.id_condominio', '=', 'condominios.id_condominio')
            ->where('moradores.id_morador', $usuario['id_usuario'])
            ->select('moradores.*', 'condominios.nome as nome_condominio')
            ->first();

        if (!$morador) {
            return redirect()->route('login')->withErrors(['error' => 'Morador não encontrado.']);
        }

        // Pautas ativas para votação
        $pautasAtivas = DB::table('pautas')
            ->where('id_condominio', $morador->id_condominio)
            ->where('status', 'ativa')
            ->where('data_fim', '>', now())
            ->get();

        return view('dashboard.morador', compact('usuario', 'morador', 'pautasAtivas'));
    }
}
