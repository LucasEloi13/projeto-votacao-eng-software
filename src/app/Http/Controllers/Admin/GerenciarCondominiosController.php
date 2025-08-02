<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GerenciarCondominios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GerenciarCondominiosController extends Controller
{
    /**
     * Verificar se o usuário está autenticado e é administrador
     */
    private function verificarAutorizacao()
    {
        if (!Session::has('usuario')) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        $usuario = Session::get('usuario');
        if ($usuario['tipo_usuario'] !== 'administrador') {
            return redirect('/')->with('error', 'Acesso negado. Apenas administradores podem acessar esta página.');
        }

        return null;
    }

    /**
     * Exibir lista de condomínios
     */
    public function index(Request $request)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $termo = $request->input('pesquisar');
            
            if ($termo) {
                $condominios = GerenciarCondominios::pesquisar($termo);
            } else {
                $condominios = GerenciarCondominios::buscarTodos();
            }

            return view('admin.gerenciarCondominios', compact('condominios', 'termo'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Mostrar formulário para criar novo condomínio
     */
    public function create()
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $sindicos = GerenciarCondominios::buscarSindicos();
            return view('admin.condominios.create', compact('sindicos'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Armazenar novo condomínio
     */
    public function store(Request $request)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $dados = $request->only(['nome', 'endereco', 'id_sindico']);
            
            // Validar dados
            $erros = GerenciarCondominios::validarDados($dados);
            if (!empty($erros)) {
                return redirect()->back()
                    ->withErrors($erros)
                    ->withInput();
            }

            // Criar condomínio
            GerenciarCondominios::criar($dados);

            return redirect()->route('admin.condominios.index')
                ->with('success', 'Condomínio criado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Mostrar formulário para editar condomínio
     */
    public function edit($id)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $condominio = GerenciarCondominios::buscarPorId($id);
            
            if (!$condominio) {
                return redirect()->route('admin.condominios.index')
                    ->with('error', 'Condomínio não encontrado.');
            }

            $sindicos = GerenciarCondominios::buscarSindicos();
            
            return view('admin.condominios.edit', compact('condominio', 'sindicos'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Atualizar condomínio
     */
    public function update(Request $request, $id)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $dados = $request->only(['nome', 'endereco', 'id_sindico']);
            
            // Validar dados
            $erros = GerenciarCondominios::validarDados($dados);
            if (!empty($erros)) {
                return redirect()->back()
                    ->withErrors($erros)
                    ->withInput();
            }

            // Atualizar condomínio
            GerenciarCondominios::atualizar($id, $dados);

            return redirect()->route('admin.condominios.index')
                ->with('success', 'Condomínio atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Excluir condomínio
     */
    public function destroy($id)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            GerenciarCondominios::excluir($id);

            return redirect()->route('admin.condominios.index')
                ->with('success', 'Condomínio removido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Pesquisar condomínios via AJAX
     */
    public function search(Request $request)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $termo = $request->input('termo');
            $condominios = GerenciarCondominios::pesquisar($termo);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'data' => $condominios,
                    'count' => $condominios->count()
                ]);
            }

            return redirect()->route('admin.condominios.index', ['pesquisar' => $termo]);

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
