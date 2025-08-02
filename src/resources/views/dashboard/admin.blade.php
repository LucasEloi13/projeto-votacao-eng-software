@extends('layouts.app')

@section('title', 'Dashboard Administrativo - Vota Comunidade')

@push('styles')
<style>
    .card-statistic {
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        text-align: left;
        height: 100%;
    }
    .card-statistic h5 {
        color: #555;
        font-size: 1rem;
        margin-bottom: 10px;
    }
    .card-statistic p {
        color: #333;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0;
    }
    .section-title {
        color: #333;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 25px;
        margin-top: 35px;
    }
    .admin-button {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #333;
    }
    .admin-button:hover {
        background-color: #e9ecef;
        border-color: #c0c0c0;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        color: #333;
    }
    .admin-button i {
        font-size: 2.5rem;
        color: #4338CA;
        margin-bottom: 10px;
    }
    .admin-button span {
        font-weight: 500;
        font-size: 1.1rem;
    }
    .table-recent-activities {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    .table-recent-activities th {
        background-color: #f8f9fa;
        color: #555;
        font-weight: 600;
        padding: 15px;
    }
    .table-recent-activities td {
        padding: 15px;
        color: #333;
    }
    .table-recent-activities tbody tr:last-child td {
        border-bottom: none;
    }
</style>
@endpush

@section('navbar')
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fas fa-vote-yea me-2"></i>Vota Comunidade
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Síndicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Moradores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Condomínios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Resultados</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sair" type="submit">Sair</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
<h3 class="section-title">Estatísticas</h3>
<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    <div class="col">
        <div class="card-statistic">
            <h5>Total de Usuários</h5>
            <p>{{ $totalUsuarios }}</p>
        </div>
    </div>
    <div class="col">
        <div class="card-statistic">
            <h5>Votações Ativas</h5>
            <p>{{ $votacoesAtivas }}</p>
        </div>
    </div>
    <div class="col">
        <div class="card-statistic">
            <h5>Total de Condomínios</h5>
            <p>{{ $totalCondominios }}</p>
        </div>
    </div>
</div>

<h3 class="section-title">Dashboard do Administrador</h3>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mb-5">
    <div class="col">
        <a href="{{ route('admin.usuarios') }}" class="admin-button">
            <i class="fas fa-users"></i>
            <span>Gerenciar Usuários</span>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('admin.condominios.index') }}" class="admin-button">
            <i class="fas fa-building"></i>
            <span>Gerenciar Condomínios</span>
        </a>
    </div>
    <div class="col">
        <a href="#" class="admin-button">
            <i class="fas fa-user-tie"></i>
            <span>Gerenciar Síndicos</span>
        </a>
    </div>
    <div class="col">
        <a href="#" class="admin-button">
            <i class="fas fa-chart-bar"></i>
            <span>Visualizar Resultados</span>
        </a>
    </div>
</div>

<h3 class="section-title">Ações Recentes</h3>
<div class="table-responsive table-recent-activities">
    <table class="table table-striped mb-0">
        <thead>
            <tr>
                <th scope="col">Atividade</th>
                <th scope="col">Data/Hora</th>
            </tr>
        </thead>
        <tbody>
            @forelse($atividadesRecentes as $atividade)
            <tr>
                <td>{{ $atividade->descricao }}</td>
                <td>{{ \Carbon\Carbon::parse($atividade->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center text-muted">Nenhuma atividade recente</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    // Atualizar estatísticas a cada 30 segundos
    setInterval(function() {
        // Implementar chamada AJAX para atualizar estatísticas se necessário
        console.log('Verificando atualizações...');
    }, 30000);
</script>
@endpush