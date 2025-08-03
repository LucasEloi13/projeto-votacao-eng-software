<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\GerenciarCondominiosController;
use App\Http\Controllers\SindicoController;
use App\Http\Controllers\Sindico\VotacoesController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

// Rotas de Síndicos 
Route::prefix('sindico')->name('sindico.')->group(function () {
    Route::get('/dashboard', [SindicoController::class, 'dashboard'])->name('dashboard');
    
    // Rotas de Votações do Síndico
    Route::resource('votacoes', VotacoesController::class);
    Route::patch('/votacoes/{votacao}/encerrar', [VotacoesController::class, 'encerrar'])->name('votacoes.encerrar');
});