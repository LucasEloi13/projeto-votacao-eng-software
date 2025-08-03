@extends('layouts.app')

@section('title', 'Gerenciar Condomínios - Vota Comunidade')

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
    .search-form {
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
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
    .btn-add:hover {
        background-color: #3730A3;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 56, 202, 0.3);
    }
    .btn-action {
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-edit {
        background-color: #3B82F6;
        color: white;
    }
    .btn-edit:hover {
        background-color: #2563EB;
        color: white;
        transform: translateY(-1px);
    }
    .btn-delete {
        background-color: #EF4444;
        color: white;
    }
    .btn-delete:hover {
        background-color: #DC2626;
        color: white;
        transform: translateY(-1px);
    }
</style>
@endpush

@section('navbar')
<x-admin_navbar current-page="condominios" />
@endsection

@section('content')
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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="section-title mb-0">Gerenciar Condomínios</h3>
        <a href="{{ route('admin.condominios.create') }}" class="btn-add">
            <i class="fas fa-plus"></i>
            Adicionar Condomínio
        </a>
    </div>

    <div class="search-form">
        <form action="{{ route('admin.condominios.index') }}" method="GET">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" 
                       class="form-control" 
                       name="pesquisar" 
                       placeholder="Pesquisar por nome, endereço ou síndico..." 
                       value="{{ $termo ?? '' }}">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                @if(!empty($termo))
                    <a href="{{ route('admin.condominios.index') }}" class="btn btn-outline-danger">Limpar</a>
                @endif
            </div>
        </form>
    </div>

    <div class="table-responsive table-recent-activities">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th scope="col">NOME</th>
                    <th scope="col">ENDEREÇO</th>
                    <th scope="col">SÍNDICO</th>
                    <th scope="col">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($condominios as $condominio)
                <tr>
                    <td><strong>{{ $condominio->nome }}</strong></td>
                    <td>{{ $condominio->endereco }}</td>
                    <td>
                        @if($condominio->sindico_nome)
                            <span class="badge bg-success">{{ $condominio->sindico_nome }}</span>
                        @else
                            <span class="badge bg-secondary">Não definido</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.condominios.edit', $condominio->id_condominio) }}" 
                           class="btn-action btn-edit me-2">
                            <i class="fas fa-edit"></i>Editar
                        </a>
                        <form action="{{ route('admin.condominios.destroy', $condominio->id_condominio) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('⚠️ Tem certeza que deseja remover este condomínio?\n\nEsta ação não pode ser desfeita.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <i class="fas fa-trash"></i>Remover
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        @if(!empty($termo))
                            Nenhum condomínio encontrado para "{{ $termo }}"
                        @else
                            Nenhum condomínio cadastrado
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($condominios->count() > 0)
        <div class="mt-3 text-muted">
            <small>Total: {{ $condominios->count() }} condomínio(s)</small>
        </div>
    @endif
@endsection