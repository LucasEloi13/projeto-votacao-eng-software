<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Votacoes
{
    /**
     * Buscar votações ativas
     */
    public static function buscarAtivas()
    {
        return DB::table('pautas')
            ->join('condominios', 'pautas.id_condominio', '=', 'condominios.id_condominio')
            ->where('pautas.status', 'ativa')
            ->where('pautas.data_fim', '>=', now())
            ->select(
                'pautas.*',
                'condominios.nome as nome_condominio'
            )
            ->orderBy('pautas.data_fim', 'asc')
            ->get();
    }

    /**
     * Buscar votações encerradas
     */
    public static function buscarEncerradas()
    {
        return DB::table('pautas')
            ->join('condominios', 'pautas.id_condominio', '=', 'condominios.id_condominio')
            ->where(function ($query) {
                $query->where('pautas.status', 'encerrada')
                      ->orWhere('pautas.data_fim', '<', now());
            })
            ->select(
                'pautas.*',
                'condominios.nome as nome_condominio'
            )
            ->orderBy('pautas.data_fim', 'desc')
            ->get();
    }

    /**
     * Buscar votações por síndico
     */
    public static function buscarPorSindico($idSindico)
    {
        return DB::table('pautas')
            ->join('condominios', 'pautas.id_condominio', '=', 'condominios.id_condominio')
            ->where('pautas.id_sindico', $idSindico)
            ->select(
                'pautas.*',
                'condominios.nome as nome_condominio'
            )
            ->orderBy('pautas.created_at', 'desc')
            ->get();
    }

    /**
     * Buscar votações ativas por síndico
     */
    public static function buscarAtivasPorSindico($idSindico)
    {
        return DB::table('pautas')
            ->join('condominios', 'pautas.id_condominio', '=', 'condominios.id_condominio')
            ->where('pautas.id_sindico', $idSindico)
            ->where('pautas.status', 'ativa')
            ->where('pautas.data_fim', '>=', now())
            ->select(
                'pautas.*',
                'condominios.nome as nome_condominio'
            )
            ->orderBy('pautas.data_fim', 'asc')
            ->get();
    }

    /**
     * Buscar votações encerradas por síndico
     */
    public static function buscarEncerradasPorSindico($idSindico)
    {
        return DB::table('pautas')
            ->join('condominios', 'pautas.id_condominio', '=', 'condominios.id_condominio')
            ->where('pautas.id_sindico', $idSindico)
            ->where(function ($query) {
                $query->where('pautas.status', 'encerrada')
                      ->orWhere('pautas.data_fim', '<', now());
            })
            ->select(
                'pautas.*',
                'condominios.nome as nome_condominio'
            )
            ->orderBy('pautas.data_fim', 'desc')
            ->get();
    }

    /**
     * Contar votações ativas por síndico
     */
    public static function contarAtivasPorSindico($idSindico)
    {
        return DB::table('pautas')
            ->where('pautas.id_sindico', $idSindico)
            ->where('pautas.status', 'ativa')
            ->where('pautas.data_fim', '>=', now())
            ->count();
    }

    /**
     * Contar votações encerradas por síndico
     */
    public static function contarEncerradasPorSindico($idSindico)
    {
        return DB::table('pautas')
            ->where('pautas.id_sindico', $idSindico)
            ->where(function ($query) {
                $query->where('pautas.status', 'encerrada')
                      ->orWhere('pautas.data_fim', '<', now());
            })
            ->count();
    }

    /**
     * Buscar uma votação específica por ID
     */
    public static function buscarPorId($idPauta)
    {
        return DB::table('pautas')
            ->join('condominios', 'pautas.id_condominio', '=', 'condominios.id_condominio')
            ->where('pautas.id_pauta', $idPauta)
            ->select(
                'pautas.*',
                'condominios.nome as nome_condominio'
            )
            ->first();
    }

    /**
     * Criar nova votação
     */
    public static function criar($dados)
    {
        return DB::table('pautas')->insertGetId([
            'id_condominio' => $dados['id_condominio'],
            'id_sindico' => $dados['id_sindico'],
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'] ?? null,
            'data_inicio' => $dados['data_inicio'],
            'data_fim' => $dados['data_fim'],
            'status' => 'ativa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Atualizar votação
     */
    public static function atualizar($idPauta, $dados)
    {
        return DB::table('pautas')
            ->where('id_pauta', $idPauta)
            ->update([
                'titulo' => $dados['titulo'],
                'descricao' => $dados['descricao'] ?? null,
                'data_inicio' => $dados['data_inicio'],
                'data_fim' => $dados['data_fim'],
                'updated_at' => now()
            ]);
    }

    /**
     * Encerrar votação
     */
    public static function encerrar($idPauta)
    {
        return DB::table('pautas')
            ->where('id_pauta', $idPauta)
            ->update([
                'status' => 'encerrada',
                'updated_at' => now()
            ]);
    }

    /**
     * Deletar votação
     */
    public static function deletar($idPauta)
    {
        return DB::table('pautas')
            ->where('id_pauta', $idPauta)
            ->delete();
    }

    /**
     * Buscar opções de voto de uma pauta
     */
    public static function buscarOpcoes($idPauta)
    {
        return DB::table('opcao_votos')
            ->where('id_pauta', $idPauta)
            ->orderBy('id_opcao')
            ->get();
    }

    /**
     * Criar opção de voto
     */
    public static function criarOpcao($idPauta, $descricao)
    {
        return DB::table('opcao_votos')->insert([
            'id_pauta' => $idPauta,
            'descricao' => $descricao,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Deletar todas as opções de uma pauta
     */
    public static function deletarOpcoes($idPauta)
    {
        return DB::table('opcao_votos')
            ->where('id_pauta', $idPauta)
            ->delete();
    }

    /**
     * Buscar resultados de votação com contagem de votos
     */
    public static function buscarResultados($idPauta)
    {
        return DB::table('opcao_votos')
            ->leftJoin('votos', 'opcao_votos.id_opcao', '=', 'votos.id_opcao')
            ->where('opcao_votos.id_pauta', $idPauta)
            ->select(
                'opcao_votos.id_opcao',
                'opcao_votos.descricao',
                DB::raw('COUNT(votos.id_voto) as total_votos')
            )
            ->groupBy('opcao_votos.id_opcao', 'opcao_votos.descricao')
            ->orderBy('opcao_votos.id_opcao')
            ->get();
    }

    /**
     * Contar total de votos de uma pauta
     */
    public static function contarTotalVotos($idPauta)
    {
        return DB::table('votos')
            ->where('id_pauta', $idPauta)
            ->count();
    }

    /**
     * Buscar condominios do síndico
     */
    public static function buscarCondominiosSindico($idSindico)
    {
        return DB::table('condominios')
            ->join('sindicos', 'condominios.id_condominio', '=', 'sindicos.id_condominio')
            ->where('sindicos.id_sindico', $idSindico)
            ->select('condominios.id_condominio', 'condominios.nome')
            ->get();
    }
}