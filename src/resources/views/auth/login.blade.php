<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vota Comunidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>Faça seu login</h2>

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

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
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
                <label for="password" class="form-label">Senha</label>
                <input type="password" 
                       class="form-control" 
                       id="password" 
                       name="password" 
                       placeholder="********" 
                       required>
            </div>
            
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Manter-se conectado
                </label>
            </div>
            
            <div class="d-grid gap-3">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
            
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
            </div>
            
            <div class="register-link">
                Não tem uma conta? <a href="{{ route('cadastro.index') }}">Registre-se agora!</a>
            </div>
        </form>

        <!-- <hr class="my-4">
        
        <div class="text-muted">
            <small>Credenciais de teste:</small><br>
            <small><strong>Admin:</strong> admin@votacomunidade.com / admin123</small><br>
            <small><strong>Síndico:</strong> sindico@condominioazul.com / sindico123</small><br>
            <small><strong>Morador:</strong> morador3@condominioazul.com / morador3</small>
        </div>  -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
