<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Verificar se o usuário está logado e é administrador
        if (!Session::has('usuario')) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        $usuario = Session::get('usuario');
        if ($usuario['tipo_usuario'] !== 'administrador') {
            return redirect('/')->with('error', 'Acesso negado. Apenas administradores podem acessar esta página.');
        }

        try {
            // Buscar estatísticas reais do sistema
            $totalUsuarios = DB::table('usuarios')->count();
            
            // Para demonstração, definimos votações ativas como 0
            // Em um sistema real seria: DB::table('pautas')->where('status', 'ativa')->count();
            $votacoesAtivas = 0;
                
            // Para demonstração, definimos condomínios como 0
            // Em um sistema real seria: DB::table('condominios')->count();
            $totalCondominios = 0;
            
            // Buscar atividades recentes dos usuários
            $atividadesRecentes = DB::table('usuarios')
                ->select(
                    DB::raw("CONCAT('Novo usuário registrado: ', nome) as descricao"),
                    'created_at'
                )
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $dados = [
                'totalUsuarios' => $totalUsuarios,
                'votacoesAtivas' => $votacoesAtivas,
                'totalCondominios' => $totalCondominios,
                'atividadesRecentes' => $atividadesRecentes
            ];

            return view('dashboard.admin', $dados);

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Erro ao carregar o dashboard: ' . $e->getMessage());
        }
    }

    public function usuarios()
    {
        // Verificar autenticação e autorização
        if (!Session::has('usuario')) {
            return redirect()->route('login');
        }

        $usuario = Session::get('usuario');
        if ($usuario['tipo_usuario'] !== 'administrador') {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        try {
            $usuarios = DB::table('usuarios')
                ->select('id_usuario', 'nome', 'email', 'cpf', 'tipo_usuario', 'status', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.usuarios.index', compact('usuarios'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao carregar usuários: ' . $e->getMessage());
        }
    }

    public function aprovarUsuario($id)
    {
        // Verificar autenticação e autorização
        if (!Session::has('usuario')) {
            return redirect()->route('login');
        }

        $usuario = Session::get('usuario');
        if ($usuario['tipo_usuario'] !== 'administrador') {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        try {
            $resultado = DB::table('usuarios')
                ->where('id_usuario', $id)
                ->update(['status' => 'ativo']);

            if ($resultado) {
                return redirect()->back()->with('success', 'Usuário aprovado com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Usuário não encontrado.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao aprovar usuário: ' . $e->getMessage());
        }
    }

    public function rejeitarUsuario($id)
    {
        // Verificar autenticação e autorização
        if (!Session::has('usuario')) {
            return redirect()->route('login');
        }

        $usuario = Session::get('usuario');
        if ($usuario['tipo_usuario'] !== 'administrador') {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        try {
            $resultado = DB::table('usuarios')
                ->where('id_usuario', $id)
                ->update(['status' => 'rejeitado']);

            if ($resultado) {
                return redirect()->back()->with('success', 'Usuário rejeitado.');
            } else {
                return redirect()->back()->with('error', 'Usuário não encontrado.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao rejeitar usuário: ' . $e->getMessage());
        }
    }

    public function excluirUsuario($id)
    {
        // Verificar autenticação e autorização
        if (!Session::has('usuario')) {
            return redirect()->route('login');
        }

        $usuario = Session::get('usuario');
        if ($usuario['tipo_usuario'] !== 'administrador') {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        try {
            $resultado = DB::table('usuarios')
                ->where('id_usuario', $id)
                ->delete();

            if ($resultado) {
                return redirect()->back()->with('success', 'Usuário excluído com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Usuário não encontrado.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir usuário: ' . $e->getMessage());
        }
    }
}
