@extends('layouts.app')

@section('title', 'Votações em Aberto')

@section('navbar')
<x-sindico_navbar currentPage="votacoes" />
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="section-title mb-0">Votações em Aberto</h3>
        <a href="{{ route('sindico.votacoes.create') }}" class="btn-add">
            <i class="fas fa-plus"></i>
            Criar nova Votação
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- <div class="mb-4">
        <a href="{{ route('sindico.votacoes.create') }}" class="btn btn-primary">Criar nova votação</a>
    </div> -->

    @forelse($votacoesAtivas as $votacao)
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">{{ $votacao->titulo }}</h5>
                    <span class="text-muted">Total de votos: <strong>{{ $votacao->total_votos_geral }}</strong></span>
                </div>
                
                @if($votacao->descricao)
                    <p class="card-text mb-3">{{ $votacao->descricao }}</p>
                @endif

                <div class="mb-3">
                    <small class="text-muted">
                        <i class="fas fa-building"></i> {{ $votacao->nome_condominio }} | 
                        <i class="fas fa-calendar"></i> Encerra em: {{ \Carbon\Carbon::parse($votacao->data_fim)->format('d/m/Y H:i') }}
                    </small>
                </div>

                @foreach($votacao->resultados as $resultado)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <p class="mb-0 me-2">{{ $resultado->descricao }}</p>
                            <div class="d-flex align-items-center">
                                <span class="me-2 text-end" style="min-width: 45px;"><strong>{{ $resultado->porcentagem }}%</strong></span>
                                <span class="text-muted text-end" style="min-width: 50px;">{{ $resultado->total_votos }} votos</span>
                            </div>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-primary" 
                                 role="progressbar" 
                                 style="width: {{ $resultado->porcentagem }}%;" 
                                 aria-valuenow="{{ $resultado->porcentagem }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="d-flex justify-content-center mt-4">
                    <!-- <a href="{{ route('sindico.votacoes.show', $votacao->id_pauta) }}" class="btn btn-info me-2">
                        <i class="fas fa-eye"></i> Visualizar
                    </a> -->
                    <a href="{{ route('sindico.votacoes.edit', $votacao->id_pauta) }}" class="btn btn-edit me-3">
                        <i class="fas fa-edit"></i> Editar votação
                    </a>
                    <button type="button" 
                            class="btn btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#encerrarModal{{ $votacao->id_pauta }}">
                        <i class="fas fa-stop"></i> Encerrar votação
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal de confirmação para encerrar -->
        <div class="modal fade" id="encerrarModal{{ $votacao->id_pauta }}" tabindex="-1">
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
    @empty
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-vote-yea fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Nenhuma votação ativa</h4>
                <p class="text-muted">Você ainda não criou nenhuma votação ativa.</p>
                <a href="{{ route('sindico.votacoes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Criar Primeira Votação
                </a>
            </div>
        </div>
    @endforelse
@endsection

@push('styles')
    <style>
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .section-title {
            color: #333;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0;
            margin-top: 0;
            line-height: 1.2;
            display: flex;
            align-items: center;
        }
        
        .btn-add {
            background-color: #4338CA;
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        .btn-edit {
            background-color: #3B82F6;
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-edit:hover {
            background-color: #2563EB;
            color: white;
            transform: translateY(-1px);
        }
        
        .btn-secondary:hover {
            background-color: #5c636a;
            border-color: #565e64;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-info {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
            color: #000;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        
        .btn-info:hover {
            background-color: #31d2f2;
            border-color: #25cff2;
            color: #000;
        }
        
        .progress {
            background-color: #e9ecef;
        }
        
        .progress-bar {
            background-color: #4338CA !important;
        }
        
        .card-body .d-flex.align-items-center > span {
            white-space: nowrap;
        }

        .card {
            transition: transform 0.2s ease;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        h2 {
            color: #495057;
            font-weight: 600;
        }

        .card-title {
            color: #212529;
            font-weight: 600;
        }

        .alert {
            border: none;
            border-radius: 0.5rem;
        }
    </style>
@endpush