<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroUsuario;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cadastro', [CadastroUsuario::class, 'index']);
Route::post('/cadastro', [CadastroUsuario::class, 'store']);
