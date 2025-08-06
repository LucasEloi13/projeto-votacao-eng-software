@extends('layouts.app')

@section('title', 'Resultados das Votações')

@section('navbar')
    <x-admin_navbar current-page="resultados" />
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Resultados das Votações</h2>
        <div class="d-flex align-items-center">
            <p class="mb-0 me-2">Condomínio:</p>
            <select class="form-select" style="min-width: 200px;">
                <option selected>Condomínio Vila da Folha</option>
                <option value="1">Condomínio Vila da Cortina</option>
                <option value="2">Condomínio Vila da Cerâmica</option>
            </select>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Definir Cores da Fachada</h5>
                <span>Total de votos: <strong>245</strong></span>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text mb-3">Escolha das cores que serão utilizadas na nova pintura da fachada do condomínio.</p>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Amarelo</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>49.0%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">120 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 49%;" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Verde</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>32.7%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">80 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 32.7%;" aria-valuenow="32.7" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Azul</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>18.3%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">45 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 18.3%;" aria-valuenow="18.3" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Manutenção da Área de Lazer</h5>
                <span>Total de votos: <strong>300</strong></span>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text mb-3">Decisão sobre a realização de serviços de manutenção nos equipamentos e espaços da área de lazer.</p>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Aprovo a manutenção</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>60.0%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">180 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Reprovo a manutenção.</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>40.0%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">120 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Eleição do Novo Síndico</h5>
                <span>Total de votos: <strong>378</strong></span>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text mb-3"></p>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Mário de Souza Eduardo Pinheiro</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>100.0%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">378 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .form-select {
            border-radius: 8px;
            font-weight: 500;
        }
        .card-header {
            background-color: #4338CA !important; /* Cor de fundo do card-header, combinando com a navbar */
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            font-weight: 600;
            padding: 1rem 1.25rem;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
        .card-header h5 {
            font-weight: 700;
            color: #fff;
        }
        .card-header span {
            color: #fff;
            font-weight: 500;
        }
        .progress-bar {
            background-color: #4338CA !important; /* Cor da barra de progresso, combinando com a navbar */
        }
        /* Ajuste para alinhar o texto dentro do card com os votos */
        .card-body .d-flex.align-items-center > span {
            white-space: nowrap; /* Impede que o texto de porcentagem/votos quebre a linha */
        }
    </style>
@endpush