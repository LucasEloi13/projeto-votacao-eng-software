<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroUsuario;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas de dashboard por tipo de usuário
Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
Route::get('/dashboard/sindico', [DashboardController::class, 'sindico'])->name('dashboard.sindico');
Route::get('/dashboard/morador', [DashboardController::class, 'morador'])->name('dashboard.morador');

// Rotas existentes de cadastro
Route::get('/cadastro', [CadastroUsuario::class, 'index'])->name('cadastro.index');
Route::post('/cadastro', [CadastroUsuario::class, 'store'])->name('cadastro.store');
