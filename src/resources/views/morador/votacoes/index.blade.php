@extends('layouts.app')

@section('title', 'Votações em Aberto')

@section('navbar')
    <x-morador_navbar currentPage="votacoes" />
@endsection

@section('content')
    <h2 class="mb-4">Votações em Aberto</h2>

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h5 class="card-title">Reforma da Área de Vivência</h5>
            <p class="card-text mb-3">Aprovação da construção de uma nova área de vivência com playground e academia ao ar livre.</p>

            <div class="list-group list-group-flush mb-4" data-votacao="1">
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" data-opcao="1">
                    Eu aprovo a reforma com a construção da academia e do playground.
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" data-opcao="2">
                    Eu aprovo a reforma com a construção da academia, mas não do playground.
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" data-opcao="3">
                    Eu aprovo a reforma com a construção do playground, mas não da academia.
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" data-opcao="4">
                    Eu aprovo a reforma mas sem a construção da academia e do playground.
                </a>
            </div>

            <div class="d-grid gap-2">
                <button id="btn-votar-1" class="btn btn-dark btn-votar" disabled>Votar</button>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h5 class="card-title">Aprovação de Obras na Piscina</h5>
            <p class="card-text mb-3">Votação para aprovar o orçamento e o início das obras de reconstrução da piscina.</p>

            <div class="list-group list-group-flush mb-4" data-votacao="2">
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" data-opcao="5">
                    Eu aprovo as obras de reconstrução da piscina.
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" data-opcao="6">
                    Eu não aprovo as obras de reconstrução da piscina.
                </a>
            </div>

            <div class="d-grid gap-2">
                <button id="btn-votar-2" class="btn btn-dark btn-votar" disabled>Votar</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const listGroups = document.querySelectorAll('.list-group[data-votacao]');

    listGroups.forEach(listGroup => {
        const votarButton = listGroup.closest('.card-body').querySelector('.btn-votar');

        listGroup.addEventListener('click', function(event) {
            event.preventDefault();
            const selectedOption = event.target.closest('.list-group-item');

            if (!selectedOption) return;

            // Remove a classe 'active' e os estilos de todas as opções
            listGroup.querySelectorAll('.list-group-item').forEach(item => {
                item.classList.remove('active');
            });

            // Adiciona a classe 'active' à opção clicada
            selectedOption.classList.add('active');

            // Habilita e estiliza o botão "Votar"
            votarButton.disabled = false;
            votarButton.classList.remove('btn-dark');
            votarButton.classList.add('btn-primary-custom');
        });

        votarButton.addEventListener('click', function(event) {
            const selectedOption = listGroup.querySelector('.list-group-item.active');

            if (!selectedOption) {
                alert('Por favor, selecione uma opção antes de votar.');
                return;
            }

            // Simula o registro do voto
            votarButton.textContent = 'Voto registrado com sucesso';
            votarButton.classList.remove('btn-primary-custom');
            votarButton.classList.add('btn-success');
            votarButton.disabled = true;

            // Desabilita a seleção de novas opções após o voto
            listGroup.querySelectorAll('.list-group-item').forEach(item => {
                item.style.pointerEvents = 'none'; // Desabilita o clique
            });
        });
    });
});
</script>
@endpush

@push('styles')
    <style>
        .list-group-item {
            cursor: pointer;
            border-radius: 8px;
            margin-bottom: 8px;
            padding: 1rem 1.25rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: 500;
        }
        .list-group-item.active,
        .list-group-item:focus {
            background-color: #212529; /* Cor de seleção */
            color: #fff;
            font-weight: 600;
            outline: none;
        }
        .list-group-item:hover {
            background-color: #e9ecef; /* Cor de hover */
        }
        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
            color: #fff;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, opacity 0.3s ease;
        }
        .btn-dark:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }
        .btn-primary-custom {
            background-color: #4338CA; /* Cor para o botão votar após a seleção */
            border-color: #4338CA;
            color: #fff;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-primary-custom:hover {
            background-color: #3f31b8;
            border-color: #3f31b8;
        }
        .btn-success {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: #fff;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: default !important;
        }
    </style>
@endpush