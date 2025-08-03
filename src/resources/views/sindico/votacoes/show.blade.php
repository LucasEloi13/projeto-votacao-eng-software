@extends('layouts.app')

@section('title', 'Detalhes da Votação')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <x-sindico_navbar currentPage="votacoes" />
        </div>
        
        <div class="col-md-10 main-content">
            <div class="content-header">
                <h1 class="mb-4">Detalhes da Votação</h1>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('sindico.votacoes.index') }}">Votações</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $votacao->titulo }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-poll"></i> {{ $votacao->titulo }}
                            </h5>
                        </div>
                        
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Condomínio:</strong></div>
                                <div class="col-sm-9">{{ $votacao->nome_condominio }}</div>
                            </div>
                            
                            @if($votacao->descricao)
                                <div class="row mb-3">
                                    <div class="col-sm-3"><strong>Descrição:</strong></div>
                                    <div class="col-sm-9">{{ $votacao->descricao }}</div>
                                </div>
                            @endif
                            
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Status:</strong></div>
                                <div class="col-sm-9">
                                    <span class="badge {{ $votacao->status === 'ativa' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($votacao->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Período:</strong></div>
                                <div class="col-sm-9">
                                    De {{ \Carbon\Carbon::parse($votacao->data_inicio)->format('d/m/Y H:i') }}
                                    até {{ \Carbon\Carbon::parse($votacao->data_fim)->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Total de Votos:</strong></div>
                                <div class="col-sm-9">
                                    <span class="badge bg-primary fs-6">{{ $totalVotos }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-bar"></i> Resultados da Votação
                            </h5>
                        </div>
                        
                        <div class="card-body">
                            @if($totalVotos > 0)
                                @foreach($resultados as $resultado)
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0">{{ $resultado->descricao }}</h6>
                                            <div class="text-end">
                                                <span class="badge bg-info">{{ $resultado->total_votos }} votos</span>
                                                <span class="badge bg-success">{{ $resultado->porcentagem }}%</span>
                                            </div>
                                        </div>
                                        
                                        <div class="progress" style="height: 30px;">
                                            <div class="progress-bar bg-gradient" 
                                                 role="progressbar" 
                                                 style="width: {{ $resultado->porcentagem }}%"
                                                 aria-valuenow="{{ $resultado->porcentagem }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <span class="d-flex justify-content-between align-items-center w-100 px-3">
                                                    <span>{{ $resultado->descricao }}</span>
                                                    <span class="fw-bold">{{ $resultado->total_votos }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-vote-yea fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Nenhum voto registrado</h5>
                                    <p class="text-muted">Esta votação ainda não recebeu votos.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0">
                                <i class="fas fa-cogs"></i> Ações
                            </h6>
                        </div>
                        
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                @if($votacao->status === 'ativa')
                                    <a href="{{ route('sindico.votacoes.edit', $votacao->id_pauta) }}" 
                                       class="btn btn-outline-warning">
                                        <i class="fas fa-edit"></i> Editar Votação
                                    </a>
                                    
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#encerrarModal">
                                        <i class="fas fa-stop"></i> Encerrar Votação
                                    </button>
                                @endif
                                
                                <a href="{{ route('sindico.votacoes.index') }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left"></i> Voltar à Lista
                                </a>
                                
                                @if($votacao->status === 'encerrada')
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal">
                                        <i class="fas fa-trash"></i> Excluir Votação
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-info-circle"></i> Informações
                            </h6>
                        </div>
                        
                        <div class="card-body">
                            <small class="text-muted">
                                <div class="mb-2">
                                    <i class="fas fa-calendar-plus"></i> 
                                    Criada em: {{ \Carbon\Carbon::parse($votacao->created_at)->format('d/m/Y H:i') }}
                                </div>
                                
                                @if($votacao->updated_at != $votacao->created_at)
                                    <div class="mb-2">
                                        <i class="fas fa-calendar-edit"></i> 
                                        Atualizada em: {{ \Carbon\Carbon::parse($votacao->updated_at)->format('d/m/Y H:i') }}
                                    </div>
                                @endif
                                
                                @if($votacao->status === 'ativa')
                                    <div class="mb-2">
                                        <i class="fas fa-clock"></i> 
                                        Tempo restante: 
                                        @php
                                            $tempoRestante = \Carbon\Carbon::now()->diffInHours(\Carbon\Carbon::parse($votacao->data_fim), false);
                                        @endphp
                                        @if($tempoRestante > 0)
                                            {{ round($tempoRestante) }} horas
                                        @else
                                            <span class="text-danger">Expirada</span>
                                        @endif
                                    </div>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação para encerrar -->
@if($votacao->status === 'ativa')
    <div class="modal fade" id="encerrarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Encerramento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja encerrar a votação "<strong>{{ $votacao->titulo }}</strong>"?</p>
                    <p class="text-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Esta ação não pode ser desfeita e impedirá novos votos.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('sindico.votacoes.encerrar', $votacao->id_pauta) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Encerrar Votação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Modal de confirmação para excluir -->
@if($votacao->status === 'encerrada')
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir permanentemente a votação "<strong>{{ $votacao->titulo }}</strong>"?</p>
                    <p class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Esta ação não pode ser desfeita e todos os votos serão perdidos.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('sindico.votacoes.destroy', $votacao->id_pauta) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir Votação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
.sidebar {
    min-height: 100vh;
    background-color: #f8f9fa;
}

.main-content {
    padding: 2rem;
}

.content-header {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 1rem;
    margin-bottom: 2rem;
}

.progress-bar {
    min-width: 100%;
    position: relative;
    overflow: visible;
}

.progress-bar span {
    color: white;
    font-weight: 500;
}

.progress {
    background-color: #e9ecef;
    border-radius: 0.375rem;
}

.bg-gradient {
    background: linear-gradient(45deg, #007bff, #0056b3);
}
</style>
@endsection
