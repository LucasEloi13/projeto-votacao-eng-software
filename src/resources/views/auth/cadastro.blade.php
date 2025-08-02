@extends('layouts.auth')

@section('title', 'Cadastro - Vota Comunidade')

@section('content')
    <h2>Criar conta</h2>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('cadastro.store') }}">
        @csrf
        
        <div class="mb-3 text-start">
            <label for="nome" class="form-label">Nome completo</label>
            <input type="text" 
                   class="form-control" 
                   id="nome" 
                   name="nome" 
                   placeholder="Seu nome completo" 
                   value="{{ old('nome') }}" 
                   required>
        </div>
        
        <div class="mb-3 text-start">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" 
                   class="form-control" 
                   id="email" 
                   name="email" 
                   placeholder="seuemail@exemplo.com" 
                   value="{{ old('email') }}" 
                   required>
        </div>
        
        <div class="mb-3 text-start">
            <label for="telefone" class="form-label">Telefone (opcional)</label>
            <input type="text" 
                   class="form-control" 
                   id="telefone" 
                   name="telefone" 
                   placeholder="(11) 99999-9999" 
                   value="{{ old('telefone') }}">
        </div>
        
        <div class="mb-3 text-start">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" 
                   class="form-control" 
                   id="cpf" 
                   name="cpf" 
                   placeholder="000.000.000-00" 
                   value="{{ old('cpf') }}" 
                   maxlength="14"
                   required>
        </div>
        
        <!-- Campo oculto para tipo de usuário -->
        <input type="hidden" name="tipo_usuario" value="morador">
        
        <div class="mb-3 text-start">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" 
                   class="form-control" 
                   id="senha" 
                   name="senha" 
                   placeholder="Mínimo 6 caracteres" 
                   required>
        </div>
        
        <div class="mb-3 text-start">
            <label for="senha_confirmation" class="form-label">Confirmar senha</label>
            <input type="password" 
                   class="form-control" 
                   id="senha_confirmation" 
                   name="senha_confirmation" 
                   placeholder="Digite a senha novamente" 
                   required>
        </div>
        
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">
                Aceito os termos de uso e política de privacidade
            </label>
        </div>
        
        <div class="d-grid gap-3">
            <button type="submit" class="btn btn-primary">Criar conta</button>
        </div>
        
        <div class="auth-link">
            Já tem uma conta? <a href="{{ route('login') }}">Faça login!</a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    // Máscara para CPF
    document.getElementById('cpf').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    });

    // Máscara para telefone
    document.getElementById('telefone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{2})(\d)/, '($1) $2');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        e.target.value = value;
    });
</script>
@endpush
