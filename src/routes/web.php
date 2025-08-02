<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\GerenciarCondominiosController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/password/forgot', [AuthController::class, 'showForgotPassword'])->name('password.request'); // View do formulário de recuperação de senha
Route::post('/password/forgot', [AuthController::class, 'sendResetLink'])->name('password.email'); // Envio do e-mail de recuperação de senha

// Rotas de cadastro
Route::get('/cadastro', [CadastroController::class, 'index'])->name('cadastro.index');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');

// Rotas do Dashboard Administrativo
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/usuarios', [AdminDashboardController::class, 'usuarios'])->name('usuarios');
    Route::patch('/usuarios/{id}/aprovar', [AdminDashboardController::class, 'aprovarUsuario'])->name('usuarios.aprovar');
    Route::patch('/usuarios/{id}/rejeitar', [AdminDashboardController::class, 'rejeitarUsuario'])->name('usuarios.rejeitar');
    Route::delete('/usuarios/{id}', [AdminDashboardController::class, 'excluirUsuario'])->name('usuarios.excluir');
    
    // Rotas de Condomínios
    Route::get('/condominios', [GerenciarCondominiosController::class, 'index'])->name('condominios.index');
    Route::get('/condominios/create', [GerenciarCondominiosController::class, 'create'])->name('condominios.create');
    Route::post('/condominios', [GerenciarCondominiosController::class, 'store'])->name('condominios.store');
    Route::get('/condominios/{id}/edit', [GerenciarCondominiosController::class, 'edit'])->name('condominios.edit');
    Route::put('/condominios/{id}', [GerenciarCondominiosController::class, 'update'])->name('condominios.update');
    Route::delete('/condominios/{id}', [GerenciarCondominiosController::class, 'destroy'])->name('condominios.destroy');
    Route::get('/condominios/search', [GerenciarCondominiosController::class, 'search'])->name('condominios.search');
});