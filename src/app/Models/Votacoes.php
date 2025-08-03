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
}