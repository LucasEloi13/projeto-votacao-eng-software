{{-- filepath: /resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.auth')

@section('title', 'Recuperar Senha - Vota Comunidade')

@section('content')
    <h2>Recuperar Senha</h2>

    <p class="mb-4">
        Para redefinir sua senha, informe o e-mail cadastrado na sua conta.<br>
        Você receberá um link com instruções para criar uma nova senha.
    </p>

    @if (session('status'))
        <div class="alert alert-success text-center" id="success-alert">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3 text-start">
            <label for="email" class="form-label">E-mail</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   placeholder="seuemail@exemplo.com"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   oninput="document.getElementById('success-alert')?.remove();">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Enviar link de redefinição</button>
            <a href="{{ route('login') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    // Esconde a mensagem de sucesso após 3 segundos
    setTimeout(function () {
        document.getElementById('success-alert')?.remove();
    }, 3000);
</script>
@endpush
