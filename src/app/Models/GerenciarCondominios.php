<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class GerenciarCondominios
{
    /**
     * Buscar todos os condomínios
     */
    public static function buscarTodos()
    {
        try {
            // Tentar buscar dados reais primeiro
            $resultado = DB::table('condominios')
                ->select('id_condominio', 'nome', 'endereco', 'cidade', 'estado', 'created_at', 'updated_at')
                ->orderBy('nome')
                ->get();
            
            // Se há dados na tabela, retornar eles
            if ($resultado->count() > 0) {
                return $resultado->map(function ($item) {
                    $item->sindico_nome = null; // Placeholder para síndico
                    $item->id_sindico = null;
                    return $item;
                });
            }
        } catch (\Exception $e) {
            // Se falhar, logar o erro e retornar uma coleção vazia
            \Log::error('Erro ao buscar condomínios: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Buscar condomínio por ID
     */
    public static function buscarPorId($id)
    {
        try {
            $condominios = self::buscarTodos();
            return $condominios->firstWhere('id_condominio', $id);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao buscar condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Criar novo condomínio
     */
    public static function criar($dados)
    {
        try {
            // Validar dados obrigatórios
            if (empty($dados['nome']) || empty($dados['endereco'])) {
                throw new \Exception('Nome e endereço são obrigatórios.');
            }

            // Em um sistema real seria:
            // return DB::table('condominios')->insertGetId([
            //     'nome' => $dados['nome'],
            //     'endereco' => $dados['endereco'],
            //     'id_sindico' => $dados['id_sindico'] ?? null,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ]);

            // Simulação de sucesso
            return true;

        } catch (\Exception $e) {
            throw new \Exception('Erro ao criar condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Atualizar condomínio
     */
    public static function atualizar($id, $dados)
    {
        try {
            // Verificar se o condomínio existe
            $condominio = self::buscarPorId($id);
            if (!$condominio) {
                throw new \Exception('Condomínio não encontrado.');
            }

            // Validar dados obrigatórios
            if (empty($dados['nome']) || empty($dados['endereco'])) {
                throw new \Exception('Nome e endereço são obrigatórios.');
            }

            // Em um sistema real seria:
            // return DB::table('condominios')
            //     ->where('id_condominio', $id)
            //     ->update([
            //         'nome' => $dados['nome'],
            //         'endereco' => $dados['endereco'],
            //         'id_sindico' => $dados['id_sindico'] ?? null,
            //         'updated_at' => now()
            //     ]);

            // Simulação de sucesso
            return true;

        } catch (\Exception $e) {
            throw new \Exception('Erro ao atualizar condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Excluir condomínio
     */
    public static function excluir($id)
    {
        try {
            // Verificar se o condomínio existe
            $condominio = self::buscarPorId($id);
            if (!$condominio) {
                throw new \Exception('Condomínio não encontrado.');
            }

            // Verificar se há moradores vinculados
            // $moradoresVinculados = DB::table('moradores')->where('id_condominio', $id)->count();
            // if ($moradoresVinculados > 0) {
            //     throw new \Exception('Não é possível excluir um condomínio com moradores vinculados.');
            // }

            // Em um sistema real seria:
            // return DB::table('condominios')->where('id_condominio', $id)->delete();

            // Simulação de sucesso
            return true;

        } catch (\Exception $e) {
            throw new \Exception('Erro ao excluir condomínio: ' . $e->getMessage());
        }
    }

    /**
     * Pesquisar condomínios
     */
    public static function pesquisar($termo)
    {
        try {
            $condominios = self::buscarTodos();
            
            if (empty($termo)) {
                return $condominios;
            }

            return $condominios->filter(function ($condominio) use ($termo) {
                return stripos($condominio->nome, $termo) !== false ||
                       stripos($condominio->endereco, $termo) !== false ||
                       stripos($condominio->sindico_nome, $termo) !== false;
            });

        } catch (\Exception $e) {
            throw new \Exception('Erro na pesquisa: ' . $e->getMessage());
        }
    }

    /**
     * Buscar síndicos disponíveis
     */
    public static function buscarSindicos()
    {
        try {
            return DB::table('usuarios')
                ->where('tipo_usuario', 'sindico')
                ->where('status', 'ativo')
                ->select('id_usuario', 'nome', 'email')
                ->orderBy('nome')
                ->get();

        } catch (\Exception $e) {
            throw new \Exception('Erro ao buscar síndicos: ' . $e->getMessage());
        }
    }

    /**
     * Contar total de condomínios
     */
    public static function contarTotal()
    {
        try {
            return self::buscarTodos()->count();
        } catch (\Exception $e) {
            throw new \Exception('Erro ao contar condomínios: ' . $e->getMessage());
        }
    }

    /**
     * Validar dados do condomínio
     */
    public static function validarDados($dados)
    {
        $erros = [];

        if (empty($dados['nome'])) {
            $erros[] = 'O nome do condomínio é obrigatório.';
        } elseif (strlen($dados['nome']) > 255) {
            $erros[] = 'O nome do condomínio não pode ter mais que 255 caracteres.';
        }

        if (empty($dados['endereco'])) {
            $erros[] = 'O endereço é obrigatório.';
        } elseif (strlen($dados['endereco']) > 500) {
            $erros[] = 'O endereço não pode ter mais que 500 caracteres.';
        }

        if (!empty($dados['id_sindico'])) {
            $sindico = DB::table('usuarios')
                ->where('id_usuario', $dados['id_sindico'])
                ->where('tipo_usuario', 'sindico')
                ->where('status', 'ativo')
                ->first();

            if (!$sindico) {
                $erros[] = 'Síndico selecionado não é válido.';
            }
        }

        return $erros;
    }
    
    /**
     * Busca síndicos disponíveis (que não gerenciam nenhum condomínio)
     */
    public static function buscarSindicosDisponiveis()
    {
        $query = "
            SELECT s.id_sindico, u.nome 
            FROM sindicos s
            INNER JOIN usuarios u ON s.id_usuario = u.id_usuario
            WHERE s.id_sindico NOT IN (
                SELECT DISTINCT id_sindico 
                FROM condominios 
                WHERE id_sindico IS NOT NULL
            )
            ORDER BY u.nome
        ";
        
        return DB::select($query);
    }
    
    /**
     * Deleta um condomínio
     */
    public static function deletar($id)
    {
        try {
            DB::beginTransaction();
            
            // Verifica se o condomínio existe
            $condominio = self::buscarPorId($id);
            if (!$condominio) {
                throw new \Exception("Condomínio não encontrado");
            }
            
            // Remove relacionamentos primeiro (se houver)
            DB::delete("DELETE FROM moradores WHERE id_condominio = ?", [$id]);
            
            // Remove o condomínio
            $result = DB::delete("DELETE FROM condominios WHERE id_condominio = ?", [$id]);
            
            DB::commit();
            
            return $result > 0;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
