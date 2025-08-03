<?php

namespace App\Http\Controllers\Sindico;

use App\Http\Controllers\Controller;
use App\Models\Votacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VotacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        $idSindico = $usuario['id_usuario'];
        $votacoesAtivas = Votacoes::buscarAtivasPorSindico($idSindico);
        
        // Buscar resultados para cada votação ativa
        foreach ($votacoesAtivas as $votacao) {
            $resultados = Votacoes::buscarResultados($votacao->id_pauta);
            $totalVotos = Votacoes::contarTotalVotos($votacao->id_pauta);
            
            // Calcular porcentagens
            foreach ($resultados as $resultado) {
                $resultado->porcentagem = $totalVotos > 0 ? round(($resultado->total_votos / $totalVotos) * 100, 1) : 0;
            }
            
            $votacao->resultados = $resultados;
            $votacao->total_votos_geral = $totalVotos;
        }

        return view('sindico.votacoes.index', compact('votacoesAtivas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        $idSindico = $usuario['id_usuario'];
        $condominios = Votacoes::buscarCondominiosSindico($idSindico);

        return view('sindico.votacoes.create', compact('condominios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        $idSindico = $usuario['id_usuario'];

        $request->validate([
            'titulo' => 'required|string|max:150',
            'descricao' => 'nullable|string',
            'id_condominio' => 'required|integer',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'opcoes' => 'required|array|min:2',
            'opcoes.*' => 'required|string|max:100'
        ]);

        $dados = [
            'id_condominio' => $request->id_condominio,
            'id_sindico' => $idSindico,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim
        ];

        $idPauta = Votacoes::criar($dados);

        // Criar opções de voto
        foreach ($request->opcoes as $opcao) {
            if (trim($opcao)) {
                Votacoes::criarOpcao($idPauta, trim($opcao));
            }
        }

        return redirect()->route('sindico.votacoes.index')
            ->with('success', 'Votação criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        $idSindico = $usuario['id_usuario'];
        $votacao = Votacoes::buscarPorId($id);
        
        if (!$votacao || $votacao->id_sindico != $idSindico) {
            return redirect()->route('sindico.votacoes.index')
                ->with('error', 'Votação não encontrada');
        }

        $resultados = Votacoes::buscarResultados($id);
        $totalVotos = Votacoes::contarTotalVotos($id);
        
        // Calcular porcentagens
        foreach ($resultados as $resultado) {
            $resultado->porcentagem = $totalVotos > 0 ? round(($resultado->total_votos / $totalVotos) * 100, 1) : 0;
        }

        return view('sindico.votacoes.show', compact('votacao', 'resultados', 'totalVotos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        $idSindico = $usuario['id_usuario'];
        $votacao = Votacoes::buscarPorId($id);
        
        if (!$votacao || $votacao->id_sindico != $idSindico) {
            return redirect()->route('sindico.votacoes.index')
                ->with('error', 'Votação não encontrada');
        }

        // Não permitir edição de votações encerradas
        if ($votacao->status === 'encerrada') {
            return redirect()->route('sindico.votacoes.index')
                ->with('error', 'Não é possível editar votações encerradas');
        }

        $condominios = Votacoes::buscarCondominiosSindico($idSindico);
        $opcoes = Votacoes::buscarOpcoes($id);

        return view('sindico.votacoes.edit', compact('votacao', 'condominios', 'opcoes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        $idSindico = $usuario['id_usuario'];
        $votacao = Votacoes::buscarPorId($id);
        
        if (!$votacao || $votacao->id_sindico != $idSindico) {
            return redirect()->route('sindico.votacoes.index')
                ->with('error', 'Votação não encontrada');
        }

        // Não permitir edição de votações encerradas
        if ($votacao->status === 'encerrada') {
            return redirect()->route('sindico.votacoes.index')
                ->with('error', 'Não é possível editar votações encerradas');
        }

        $request->validate([
            'titulo' => 'required|string|max:150',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'opcoes' => 'required|array|min:2',
            'opcoes.*' => 'required|string|max:100'
        ]);

        $dados = [
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim
        ];

        Votacoes::atualizar($id, $dados);

        // Atualizar opções - deletar existentes e recriar
        Votacoes::deletarOpcoes($id);
        foreach ($request->opcoes as $opcao) {
            if (trim($opcao)) {
                Votacoes::criarOpcao($id, trim($opcao));
            }
        }

        return redirect()->route('sindico.votacoes.index')
            ->with('success', 'Votação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        $idSindico = $usuario['id_usuario'];
        $votacao = Votacoes::buscarPorId($id);
        
        if (!$votacao || $votacao->id_sindico != $idSindico) {
            return redirect()->route('sindico.votacoes.index')
                ->with('error', 'Votação não encontrada');
        }

        Votacoes::deletar($id);

        return redirect()->route('sindico.votacoes.index')
            ->with('success', 'Votação excluída com sucesso!');
    }

    /**
     * Encerrar votação
     */
    public function encerrar(string $id)
    {
        // Verificar se o usuário está logado e é síndico
        $usuario = Session::get('usuario');
        
        if (!$usuario || $usuario['tipo_usuario'] !== 'sindico') {
            return redirect()->route('login')->with('error', 'Acesso negado.');
        }

        $idSindico = $usuario['id_usuario'];
        $votacao = Votacoes::buscarPorId($id);
        
        if (!$votacao || $votacao->id_sindico != $idSindico) {
            return redirect()->route('sindico.votacoes.index')
                ->with('error', 'Votação não encontrada');
        }

        if ($votacao->status === 'encerrada') {
            return redirect()->route('sindico.votacoes.index')
                ->with('error', 'Votação já está encerrada');
        }

        Votacoes::encerrar($id);

        return redirect()->route('sindico.votacoes.index')
            ->with('success', 'Votação encerrada com sucesso!');
    }
}
