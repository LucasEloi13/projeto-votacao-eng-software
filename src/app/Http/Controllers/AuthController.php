<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Buscar usuário no banco
        $usuario = DB::table('usuarios')
            ->where('email', $request->email)
            ->where('status', 'ativo')
            ->first();

        if ($usuario && Hash::check($request->password, $usuario->senha_hash)) {
            // Login bem-sucedido
            Session::put('usuario', [
                'id_usuario' => $usuario->id_usuario,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'tipo_usuario' => $usuario->tipo_usuario,
                'cpf' => $usuario->cpf
            ]);

            // Redirecionar baseado no tipo de usuário
            switch ($usuario->tipo_usuario) {
                case 'administrador':
                    return redirect()->route('admin.dashboard')->with('success', 'Login realizado com sucesso!');
                case 'sindico':
                    return redirect('/')->with('success', 'Login realizado com sucesso! Bem-vindo, Síndico!');
                case 'morador':
                    return redirect('/')->with('success', 'Login realizado com sucesso! Bem-vindo, Morador!');
                default:
                    return redirect('/')->with('success', 'Login realizado com sucesso!');
            }
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não conferem com nossos registros.',
        ])->withInput();
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('message', 'Logout realizado com sucesso!');
    }
}
