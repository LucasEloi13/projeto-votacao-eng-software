<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vota Comunidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            /* Cor de fundo roxa escura: #4338CA */
            background-color: #4338CA;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Garante que o corpo ocupe 100% da altura da viewport */
            margin: 0;
            font-family: 'Inter', sans-serif; /* Fonte Inter */
        }

        .login-container {
            background-color: #fff; /* Fundo branco para o formulário de login */
            padding: 40px;
            border-radius: 12px; /* Cantos arredondados */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra */
            width: 100%;
            max-width: 450px; /* Largura máxima para o container */
            text-align: center;
        }

        h2 {
            color: #333; /* Cor do título */
            margin-bottom: 30px;
            font-weight: 600; /* Negrito para o título */
        }

        .form-label {
            color: #555; /* Cor para os rótulos dos campos */
            text-align: left;
            display: block; /* Garante que o rótulo ocupe sua própria linha */
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            border-radius: 8px; /* Cantos arredondados para os inputs */
            padding: 12px 15px;
            border: 1px solid #ddd; /* Borda sutil */
            box-shadow: none; /* Remove a sombra padrão */
        }

        .form-control:focus {
            border-color: #4338CA; /* Cor da borda ao focar */
            box-shadow: none; /* Remove o contorno/sombra ao focar */
        }

        .btn-primary {
            background-color: #4338CA; /* Roxo principal para o botão */
            border-color: #4338CA;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 500;
            font-size: 16px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #3c31b5; /* Tom um pouco mais escuro no hover */
            border-color: #3c31b5;
        }

        .btn-primary:focus {
            background-color: #3c31b5;
            border-color: #3c31b5;
            box-shadow: 0 0 0 0.2rem rgba(67, 56, 202, 0.25); /* Sombra de foco com a cor roxa */
        }

        .form-check-label {
            color: #666; /* Cor para o texto do checkbox */
            font-size: 14px;
            float: left; /* Alinha o texto do checkbox à esquerda */
        }

        .form-check-input:checked {
            background-color: #4338CA; /* Cor de fundo quando marcado */
            border-color: #4338CA; /* Cor da borda quando marcado */
        }

        .form-check-input:focus {
            border-color: #4338CA;
            box-shadow: 0 0 0 0.2rem rgba(67, 56, 202, 0.25);
        }

        .forgot-password {
            margin-top: 20px;
            text-align: center;
        }

        .forgot-password a {
            color: #4338CA; /* Cor roxa para o link */
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .register-link {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .register-link a {
            color: #4338CA; /* Cor roxa para o link de registro */
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Estilização para as credenciais de teste */
        .text-muted {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }

        .text-muted small {
            display: block;
            margin-bottom: 2px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .login-container {
                margin: 20px;
                padding: 30px 25px;
            }
            
            h2 {
                font-size: 24px;
                margin-bottom: 25px;
            }
        }
    </style>
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
                <a href="#">Esqueceu sua senha?</a>
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
        </div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
