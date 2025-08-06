@extends('layouts.app')

@section('title', 'Pautas de Votação')

@section('navbar')
    <x-morador_navbar currentPage="dashboard" />
@endsection

@section('content')
    <h2 class="mb-4">Pautas ativas</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-1">Reforma da Área de Vivência</h5>
                <p class="card-text mb-1">Aprovação da construção de uma nova área de vivência com playground e academia ao ar livre.</p>
                <p class="card-text mb-0"><small class="text-muted">Encerra em: 30/07/2025</small></p>
            </div>
            <a href="#" class="btn btn-primary btn-votar">Votar</a>
        </div>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-1">Aprovação de Obras na Piscina</h5>
                <p class="card-text mb-1">Votação para aprovar o orçamento e o início das obras de reconstrução da piscina.</p>
                <p class="card-text mb-0"><small class="text-muted">Encerra em: 05/08/2025</small></p>
            </div>
            <a href="#" class="btn btn-primary btn-votar">Votar</a>
        </div>
    </div>

    <h2 class="mb-4">Pautas encerradas</h2>

    <div class="card shadow-sm mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-1">Definir Cores da Fachada</h5>
                <p class="card-text mb-1">Escolha das cores que serão utilizadas na nova pintura da fachada do condomínio.</p>
                <p class="card-text mb-0"><small class="text-muted">Encerrada em: 01/07/2025</small></p>
            </div>
            <a href="#" class="btn btn-dark">Detalhes</a>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-1">Manutenção da Área de Lazer</h5>
                <p class="card-text mb-1">Decisão sobre a realização de serviços de manutenção nos equipamentos e espaços da área de lazer.</p>
                <p class="card-text mb-0"><small class="text-muted">Encerrada em: 05/07/2025</small></p>
            </div>
            <a href="#" class="btn btn-dark">Detalhes</a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-title {
            font-weight: 600;
            color: #333; /* Cor mais escura para o título do card */
        }
        .card-text {
            color: #555;
            margin-bottom: 0.5rem;
        }
        .text-muted {
            font-size: 0.875em; /* Tamanho da fonte para a data de encerramento */
        }
        .btn-votar {
            background-color: #4338CA;
            border-color: #4338CA;
            color: #fff;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-votar:hover {
            background-color: #3f31b8;
            border-color: #3f31b8;
        }
        .btn-dark {
            background-color: #343a40; /* Cor escura para o botão Detalhes */
            border-color: #343a40;
            color: #fff;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-dark:hover {
            background-color: #23272b;
            border-color: #1d2124;
        }
    </style>
@endpush