@extends('layouts.app')

@section('title', 'Criar Nova Votação')

@section('navbar')
    <x-sindico_navbar current-page="votacoes" />
@endsection

@section('content')
    <div class="content-header">
        <h1 class="mb-4">Criar Nova Votação</h1>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('sindico.votacoes.index') }}">Votações</a>
                </li>
                <li class="breadcrumb-item active">Criar Nova</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle"></i> Nova Votação
                    </h5>
                </div>
                        
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('sindico.votacoes.store') }}" method="POST">
                                @csrf
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="titulo" class="form-label">Título da Votação *</label>
                                        <input type="text" 
                                               class="form-control @error('titulo') is-invalid @enderror" 
                                               id="titulo" 
                                               name="titulo" 
                                               value="{{ old('titulo') }}" 
                                               maxlength="150"
                                               required>
                                        @error('titulo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="id_condominio" class="form-label">Condomínio *</label>
                                        <select class="form-select @error('id_condominio') is-invalid @enderror" 
                                                id="id_condominio" 
                                                name="id_condominio" 
                                                required>
                                            <option value="">Selecione um condomínio</option>
                                            @foreach($condominios as $condominio)
                                                <option value="{{ $condominio->id_condominio }}" 
                                                        {{ old('id_condominio') == $condominio->id_condominio ? 'selected' : '' }}>
                                                    {{ $condominio->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_condominio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                              id="descricao" 
                                              name="descricao" 
                                              rows="3"
                                              placeholder="Descreva os detalhes da votação...">{{ old('descricao') }}</textarea>
                                    @error('descricao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="data_inicio" class="form-label">Data e Hora de Início *</label>
                                        <input type="datetime-local" 
                                               class="form-control @error('data_inicio') is-invalid @enderror" 
                                               id="data_inicio" 
                                               name="data_inicio" 
                                               value="{{ old('data_inicio') }}" 
                                               required>
                                        @error('data_inicio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="data_fim" class="form-label">Data e Hora de Encerramento *</label>
                                        <input type="datetime-local" 
                                               class="form-control @error('data_fim') is-invalid @enderror" 
                                               id="data_fim" 
                                               name="data_fim" 
                                               value="{{ old('data_fim') }}" 
                                               required>
                                        @error('data_fim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Opções de Voto *</label>
                                    <div id="opcoes-container">
                                        <div class="input-group mb-2">
                                            <input type="text" 
                                                   class="form-control @error('opcoes.0') is-invalid @enderror" 
                                                   name="opcoes[]" 
                                                   placeholder="Digite a primeira opção" 
                                                   maxlength="100"
                                                   value="{{ old('opcoes.0') }}"
                                                   required>
                                            @error('opcoes.0')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="input-group mb-2">
                                            <input type="text" 
                                                   class="form-control @error('opcoes.1') is-invalid @enderror" 
                                                   name="opcoes[]" 
                                                   placeholder="Digite a segunda opção" 
                                                   maxlength="100"
                                                   value="{{ old('opcoes.1') }}"
                                                   required>
                                            @error('opcoes.1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="add-opcao">
                                        <i class="fas fa-plus"></i> Adicionar Opção
                                    </button>
                                    <small class="text-muted d-block mt-1">Mínimo 2 opções</small>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('sindico.votacoes.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Criar Votação
                                    </button>
                                </div>
                            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let opcaoCount = 2;
    
    document.getElementById('add-opcao').addEventListener('click', function() {
        if (opcaoCount < 10) { // Limite máximo de opções
            const container = document.getElementById('opcoes-container');
            const newOpcao = document.createElement('div');
            newOpcao.className = 'input-group mb-2';
            newOpcao.innerHTML = `
                <input type="text" 
                       class="form-control" 
                       name="opcoes[]" 
                       placeholder="Digite a opção ${opcaoCount + 1}" 
                       maxlength="100">
                <button type="button" class="btn btn-outline-danger remove-opcao">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(newOpcao);
            opcaoCount++;
            
            // Adicionar evento de remoção
            newOpcao.querySelector('.remove-opcao').addEventListener('click', function() {
                newOpcao.remove();
                opcaoCount--;
            });
        }
    });
    
    // Definir data mínima como agora
    const now = new Date();
    const nowString = now.toISOString().slice(0, 16);
    document.getElementById('data_inicio').min = nowString;
    document.getElementById('data_fim').min = nowString;
    
    // Atualizar data fim quando data início mudar
    document.getElementById('data_inicio').addEventListener('change', function() {
        document.getElementById('data_fim').min = this.value;
    });
});
</script>
@endpush
</script>

@push('styles')
<style>
.content-header {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 1rem;
    margin-bottom: 2rem;
}

.remove-opcao {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
</style>
@endpush
