<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Cadastro extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cpf',
        'senha_hash',
        'tipo_usuario',
        'status'
    ];

    protected $hidden = [
        'senha_hash',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Cria um novo usuário
     *
     * @param array $dados
     * @return Cadastro
     */
    public static function criarUsuario(array $dados)
    {
        // Validar se email já existe
        if (self::where('email', $dados['email'])->exists()) {
            throw new \Exception('E-mail já cadastrado no sistema.');
        }

        // Validar se CPF já existe
        if (self::where('cpf', $dados['cpf'])->exists()) {
            throw new \Exception('CPF já cadastrado no sistema.');
        }

        // Hash da senha
        $dados['senha_hash'] = Hash::make($dados['senha']);
        unset($dados['senha']);

        // Definir tipo de usuário padrão se não especificado
        if (!isset($dados['tipo_usuario'])) {
            $dados['tipo_usuario'] = 'morador';
        }

        return self::create($dados);
    }

    /**
     * Busca usuário por email
     *
     * @param string $email
     * @return Cadastro|null
     */
    public static function buscarPorEmail($email)
    {
        return self::where('email', $email)->first();
    }

    /**
     * Busca usuário por CPF
     *
     * @param string $cpf
     * @return Cadastro|null
     */
    public static function buscarPorCpf($cpf)
    {
        return self::where('cpf', $cpf)->first();
    }

    /**
     * Atualiza dados do usuário
     *
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public static function atualizarUsuario($id, array $dados)
    {
        $usuario = self::find($id);
        
        if (!$usuario) {
            throw new \Exception('Usuário não encontrado.');
        }

        // Se está atualizando a senha, fazer hash
        if (isset($dados['senha'])) {
            $dados['senha_hash'] = Hash::make($dados['senha']);
            unset($dados['senha']);
        }

        return $usuario->update($dados);
    }

    /**
     * Lista usuários com filtros opcionais
     *
     * @param array $filtros
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function listarUsuarios(array $filtros = [])
    {
        $query = self::query();

        if (isset($filtros['tipo_usuario'])) {
            $query->where('tipo_usuario', $filtros['tipo_usuario']);
        }

        if (isset($filtros['status'])) {
            $query->where('status', $filtros['status']);
        }

        if (isset($filtros['nome'])) {
            $query->where('nome', 'like', '%' . $filtros['nome'] . '%');
        }

        return $query->orderBy('nome')->get();
    }

    /**
     * Exclui usuário
     *
     * @param int $id
     * @return bool
     */
    public static function excluirUsuario($id)
    {
        $usuario = self::find($id);
        
        if (!$usuario) {
            throw new \Exception('Usuário não encontrado.');
        }

        return $usuario->delete();
    }

    /**
     * Atualiza status do usuário
     *
     * @param int $id
     * @param string $status
     * @return bool
     */
    public static function atualizarStatus($id, $status)
    {
        $usuario = self::find($id);
        
        if (!$usuario) {
            throw new \Exception('Usuário não encontrado.');
        }

        if (!in_array($status, ['pendente', 'ativo', 'rejeitado'])) {
            throw new \Exception('Status inválido.');
        }

        return $usuario->update(['status' => $status]);
    }

    /**
     * Verifica se a senha está correta
     *
     * @param string $senha
     * @return bool
     */
    public function verificarSenha($senha)
    {
        return Hash::check($senha, $this->senha_hash);
    }

    /**
     * Scope para usuários ativos
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAtivos($query)
    {
        return $query->where('status', 'ativo');
    }

    /**
     * Scope para usuários pendentes
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    /**
     * Scope por tipo de usuário
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $tipo
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_usuario', $tipo);
    }
}