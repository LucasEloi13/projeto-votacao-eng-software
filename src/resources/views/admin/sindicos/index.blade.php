@extends('layouts.app')

@section('title', 'Gerenciar Síndicos')

@section('navbar')
   <x-admin_navbar current-page="sindicos" />
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciar Síndicos</h2>
        <a href="#" class="btn btn-primary">Adicionar Síndico</a>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Pesquisar síndicos">
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">NOME</th>
                            <th scope="col">CONDOMÍNIO</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Emilly Gomes</td>
                            <td>Vila da Nuvem</td>
                            <td><span class="badge bg-warning text-dark">Pendente</span></td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm me-2">Editar</button>
                                <button class="btn btn-outline-danger btn-sm me-2">Rejeitar</button>
                                <button class="btn btn-outline-success btn-sm">Aprovar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Pedro Sales</td>
                            <td>Vila da Rocha</td>
                            <td><span class="badge bg-danger">Rejeitado</span></td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm me-2">Editar</button>
                                <button class="btn btn-outline-danger btn-sm">Remover</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Maria Souza</td>
                            <td>Vila da Folha</td>
                            <td><span class="badge bg-success">Ativo</span></td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm me-2">Editar</button>
                                <button class="btn btn-outline-danger btn-sm">Remover</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Carlos Mariano</td>
                            <td>Vila da Cortina</td>
                            <td><span class="badge bg-success">Ativo</span></td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm me-2">Editar</button>
                                <button class="btn btn-outline-danger btn-sm">Remover</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .btn-primary {
            background-color: #0d6efd; /* Exemplo de cor para o botão "Adicionar Síndico" */
            border-color: #0d6efd;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        .input-group-text {
            background-color: #e9ecef;
            border-right: 0;
            border-radius: .25rem 0 0 .25rem;
        }
        .form-control {
            border-left: 0;
            border-radius: 0 .25rem .25rem 0;
        }
        .table thead th {
            background-color: #e9ecef; /* Cor de fundo para o cabeçalho da tabela */
            font-weight: 600;
        }
        .badge.bg-warning.text-dark {
            color: #212529 !important;
        }
    </style>
@endpush