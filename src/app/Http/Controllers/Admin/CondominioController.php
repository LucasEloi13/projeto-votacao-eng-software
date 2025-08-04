<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GerenciarCondominios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CondominioController extends Controller
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
     * Display a listing of the resource.
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

            return view('admin.condominio.index', compact('condominios', 'termo'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        return view('admin.condominio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $request->validate([
                'nome' => 'required|string|max:150',
                'endereco' => 'required|string|max:200',
                'cep' => 'required|string|size:8|regex:/^\d{8}$/',
                'total_unidades' => 'required|integer|min:1',
                'id_sindico' => 'nullable|integer|exists:sindicos,id_sindico'
            ], [
                'nome.required' => 'O nome do condomínio é obrigatório.',
                'endereco.required' => 'O endereço é obrigatório.',
                'cep.required' => 'O CEP é obrigatório.',
                'cep.size' => 'O CEP deve ter exatamente 8 dígitos.',
                'cep.regex' => 'O CEP deve conter apenas números.',
                'total_unidades.required' => 'O total de unidades é obrigatório.',
                'total_unidades.min' => 'O total de unidades deve ser pelo menos 1.',
                'id_sindico.exists' => 'Síndico selecionado não existe.'
            ]);

            $dados = [
                'nome' => $request->nome,
                'endereco' => $request->endereco,
                'cep' => $request->cep,
                'total_unidades' => $request->total_unidades,
                'id_sindico' => $request->id_sindico,
                'ativo' => 1
            ];

            GerenciarCondominios::criar($dados);

            return redirect()->route('admin.condominio.index')
                ->with('success', 'Condomínio cadastrado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $condominio = GerenciarCondominios::buscarPorId($id);
            
            if (!$condominio) {
                return redirect()->route('admin.condominio.index')
                    ->with('error', 'Condomínio não encontrado.');
            }

            return view('admin.condominio.show', compact('condominio'));

        } catch (\Exception $e) {
            return redirect()->route('admin.condominio.index')
                ->with('error', 'Erro ao buscar condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $condominio = GerenciarCondominios::buscarPorId($id);
            
            if (!$condominio) {
                return redirect()->route('admin.condominio.index')
                    ->with('error', 'Condomínio não encontrado.');
            }

            $sindicos = GerenciarCondominios::buscarSindicosDisponiveis();

            return view('admin.condominio.edit', compact('condominio', 'sindicos'));

        } catch (\Exception $e) {
            return redirect()->route('admin.condominio.index')
                ->with('error', 'Erro ao buscar condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $request->validate([
                'nome' => 'required|string|max:150',
                'endereco' => 'required|string|max:200',
                'cep' => 'required|string|size:8|regex:/^\d{8}$/',
                'total_unidades' => 'required|integer|min:1',
                'id_sindico' => 'nullable|integer|exists:sindicos,id_sindico'
            ], [
                'nome.required' => 'O nome do condomínio é obrigatório.',
                'endereco.required' => 'O endereço é obrigatório.',
                'cep.required' => 'O CEP é obrigatório.',
                'cep.size' => 'O CEP deve ter exatamente 8 dígitos.',
                'cep.regex' => 'O CEP deve conter apenas números.',
                'total_unidades.required' => 'O total de unidades é obrigatório.',
                'total_unidades.min' => 'O total de unidades deve ser pelo menos 1.',
                'id_sindico.exists' => 'Síndico selecionado não existe.'
            ]);

            $dados = [
                'nome' => $request->nome,
                'endereco' => $request->endereco,
                'cep' => $request->cep,
                'total_unidades' => $request->total_unidades,
                'id_sindico' => $request->id_sindico
            ];

            $atualizado = GerenciarCondominios::atualizar($id, $dados);

            if (!$atualizado) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Condomínio não encontrado.');
            }

            return redirect()->route('admin.condominio.index')
                ->with('success', 'Condomínio atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return $authCheck;

        try {
            $deletado = GerenciarCondominios::deletar($id);

            if (!$deletado) {
                return redirect()->route('admin.condominio.index')
                    ->with('error', 'Condomínio não encontrado.');
            }

            return redirect()->route('admin.condominio.index')
                ->with('success', 'Condomínio removido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('admin.condominio.index')
                ->with('error', 'Erro ao remover condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Pesquisar condomínios via AJAX
     */
    public function search(Request $request)
    {
        $authCheck = $this->verificarAutorizacao();
        if ($authCheck) return response()->json(['error' => 'Não autorizado'], 401);

        try {
            $termo = $request->input('termo');
            
            if (empty($termo)) {
                return response()->json(['condominios' => []]);
            }

            $condominios = GerenciarCondominios::pesquisar($termo);

            return response()->json(['condominios' => $condominios]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
