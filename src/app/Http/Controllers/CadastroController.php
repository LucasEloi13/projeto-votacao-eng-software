<?php

namespace App\Http\Controllers;

use App\Models\Cadastro;
use App\Http\Requests\CadastroRequest;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    /**
     * Exibe o formulário de cadastro
     */
    public function index()
    {
        return view('auth.cadastro');
    }

    /**
     * Processa o cadastro do usuário
     */
    public function store(CadastroRequest $request)
    {
        try {
            // Criar o usuário com dados validados
            $usuario = Cadastro::criarUsuario($request->validated());

            return redirect()->route('login')
                ->with('message', 'Cadastro realizado com sucesso! Aguarde aprovação do administrador.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }
}
