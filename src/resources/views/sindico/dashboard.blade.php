@extends('layouts.app')

@section('title', 'Dashboard Síndico - Vota Comunidade')

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
    .pauta-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: none;
        margin-bottom: 20px;
        padding: 20px;
    }
    .pauta-card h5 {
        color: #333;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .pauta-card p {
        color: #555;
        margin-bottom: 8px;
        line-height: 1.5;
    }
    .pauta-card small {
        color: #777;
        font-size: 0.875rem;
    }
    .btn-details {
        background-color: #4338CA;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-details:hover {
        background-color: #3730A3;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(67, 56, 202, 0.3);
    }
</style>
@endpush

@section('navbar')
<x-sindico_navbar currentPage="dashboard" />
@endsection

@section('content')
<h3 class="section-title">Pautas Ativas</h3>

@forelse($votacoesAtivas as $votacao)
<div class="pauta-card">
    <h5>{{ $votacao->titulo }}</h5>
    <p>{{ $votacao->descricao }}</p>
    <p><small>Condomínio: {{ $votacao->nome_condominio }}</small></p>
    <p><small>Encerra em: {{ \Carbon\Carbon::parse($votacao->data_fim)->format('d/m/Y H:i') }}</small></p>
</div>
@empty
<div class="pauta-card text-center">
    <div class="text-muted">
        <i class="fas fa-vote-yea fa-3x mb-3 opacity-50"></i>
        <h5>Nenhuma votação ativa</h5>
        <p class="mb-0">Não há pautas de votação ativas no momento.</p>
    </div>
</div>
@endforelse

<h3 class="section-title">Pautas Encerradas</h3>

@forelse($votacoesEncerradas as $votacao)
<div class="pauta-card d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-2">{{ $votacao->titulo }}</h5>
        <p class="mb-1">{{ $votacao->descricao }}</p>
        <p class="mb-1"><small>Condomínio: {{ $votacao->nome_condominio }}</small></p>
        <p class="mb-0"><small>Encerrada em: {{ \Carbon\Carbon::parse($votacao->data_fim)->format('d/m/Y H:i') }}</small></p>
    </div>
    <button class="btn-details">Detalhes</button>
</div>
@empty
<div class="pauta-card text-center">
    <div class="text-muted">
        <i class="fas fa-history fa-3x mb-3 opacity-50"></i>
        <h5>Nenhuma votação encerrada</h5>
        <p class="mb-0">Não há pautas de votação encerradas.</p>
    </div>
</div>
@endforelse
@endsection