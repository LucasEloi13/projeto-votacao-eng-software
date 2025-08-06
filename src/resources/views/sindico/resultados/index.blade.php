@extends('layouts.app')

@section('title', 'Resultados das Votações')

@section('navbar')
    <x-sindico_navbar current-page="resultados" />
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Resultados das Votações</h2>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Reforma da Área de Lazer</h5>
                <span>Total de votos: <strong>187</strong></span>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text mb-3">Proposta para reforma e modernização da área de lazer do condomínio.</p>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Aprovo a reforma completa</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>62.5%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">117 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 62.5%;" aria-valuenow="62.5" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Apenas manutenção básica</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>24.1%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">45 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 24.1%;" aria-valuenow="24.1" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Não aprovo nenhuma reforma</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>13.4%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">25 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 13.4%;" aria-valuenow="13.4" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Horário de Funcionamento da Portaria</h5>
                <span>Total de votos: <strong>203</strong></span>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text mb-3">Definição do horário de funcionamento da portaria.</p>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">24 horas por dia</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>45.8%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">93 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 45.8%;" aria-valuenow="45.8" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Das 6h às 22h</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>54.2%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">110 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 54.2%;" aria-valuenow="54.2" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Novo Administrador Predial</h5>
                <span>Total de votos: <strong>195</strong></span>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text mb-3">Escolha do novo administrador predial.</p>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">Ana Paula Ribeiro</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>67.7%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">132 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 67.7%;" aria-valuenow="67.7" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <p class="mb-0 me-2">João Silva Santos</p>
                    <div class="d-flex align-items-center">
                        <span class="me-2 text-end" style="min-width: 45px;"><strong>32.3%</strong></span>
                        <span class="text-muted text-end" style="min-width: 50px;">63 votos</span>
                    </div>
                </div>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 32.3%;" aria-valuenow="32.3" aria-valuemin="0" aria-valuemax="100"></div>
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