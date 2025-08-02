<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;

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
});


// Rotas do dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', [App\Http\Controllers\DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/sindico', [App\Http\Controllers\DashboardController::class, 'sindico'])->name('dashboard.sindico');
    Route::get('/dashboard/morador', [App\Http\Controllers\DashboardController::class, 'morador'])->name('dashboard.morador');
});