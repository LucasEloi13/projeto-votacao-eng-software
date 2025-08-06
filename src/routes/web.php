<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\GerenciarCondominiosController;
use App\Http\Controllers\Admin\GerenciarSindicosController;
use App\Http\Controllers\Admin\GerenciarMoradoresController;
use App\Http\Controllers\Admin\GerenciarResultadosController;
use App\Http\Controllers\SindicoController;
use App\Http\Controllers\MoradorController;
use App\Http\Controllers\Sindico\VotacoesController;
use App\Http\Controllers\Sindico\MoradoresController;
use App\Http\Controllers\Sindico\ResultadosController;
use App\Http\Controllers\Morador\ResultadosController as MoradorResultadosController;
use App\Http\Controllers\Morador\VotacoesController as MoradorVotacoesController;

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
    
    // Rotas de Síndicos
    Route::get('/sindicos', [GerenciarSindicosController::class, 'index'])->name('sindicos.index');
    
    // Rotas de Moradores
    Route::get('/moradores', [GerenciarMoradoresController::class, 'index'])->name('moradores.index');
    
    // Rotas de Resultados
    Route::get('/resultados', [GerenciarResultadosController::class, 'index'])->name('resultados.index');
});

// Rotas de Síndicos 
Route::prefix('sindico')->name('sindico.')->group(function () {
    Route::get('/dashboard', [SindicoController::class, 'dashboard'])->name('dashboard');
    
    // Rotas de Votações do Síndico
    Route::resource('votacoes', VotacoesController::class);
    Route::patch('/votacoes/{votacao}/encerrar', [VotacoesController::class, 'encerrar'])->name('votacoes.encerrar');
    
    // Rotas de Moradores do Síndico
    Route::get('/moradores', [MoradoresController::class, 'index'])->name('moradores.index');
    
    // Rotas de Resultados do Síndico
    Route::get('/resultados', [ResultadosController::class, 'index'])->name('resultados.index');
});

// Rotas de Moradores
Route::prefix('morador')->name('morador.')->group(function () {
    Route::get('/dashboard', [MoradorController::class, 'dashboard'])->name('dashboard');
    Route::get('/votacoes', [MoradorVotacoesController::class, 'index'])->name('votacoes.index');
    Route::post('/votacoes', [MoradorVotacoesController::class, 'store'])->name('votacoes.store');
    Route::get('/resultados', [MoradorResultadosController::class, 'index'])->name('resultados.index');
});