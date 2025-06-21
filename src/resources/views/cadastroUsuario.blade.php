<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Voz da Comunidade</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        .high-contrast {
            filter: contrast(150%) brightness(90%);
        }
        
        .high-contrast .bg-white {
            background-color: #ffffff !important;
            border-color: #000000 !important;
        }
        
        .high-contrast .text-gray-600 {
            color: #000000 !important;
        }
        
        .high-contrast .border-gray-200,
        .high-contrast .border-gray-300 {
            border-color: #000000 !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
        }

        .input-focus:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl border-2 border-gray-200 shadow-lg p-8 w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="mx-auto w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                <i data-lucide="vote" class="text-white" size="24"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Voz da Comunidade
            </h1>
            <p class="text-gray-600">
                Entre na sua conta para participar
            </p>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="bg-green-50 border-2 border-green-200 text-green-800 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <i data-lucide="check-circle" class="mr-2" size="20"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border-2 border-red-200 text-red-800 rounded-lg p-4 mb-6">
                <div class="flex items-center mb-2">
                    <i data-lucide="alert-circle" class="mr-2" size="20"></i>
                    <span class="font-medium">Erro no login</span>
                </div>
                <ul class="list-none space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário -->
        
            @csrf
            
            <!-- Email/CPF -->
            <div>
                <label for="email" class="block text-lg font-medium text-gray-900 mb-2">
                    Email ou CPF
                </label>
                <input
                    id="email"
                    name="email"
                    type="text"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-4 border-2 border-gray-300 rounded-lg input-focus transition-colors text-base"
                    placeholder="Digite seu email ou CPF"
                    aria-describedby="email-help"
                    required
                >
                <p id="email-help" class="text-gray-500 mt-1 text-sm">
                    Use o mesmo email ou CPF do seu cadastro
                </p>
            </div>

            <!-- Senha -->
            <div>
                <label for="password" class="block text-lg font-medium text-gray-900 mb-2">
                    Senha
                </label>
                <div class="relative">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full px-4 py-4 pr-12 border-2 border-gray-300 rounded-lg input-focus transition-colors text-base"
                        placeholder="Digite sua senha"
                        required
                    >
                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded p-1"
                        aria-label="Mostrar/Ocultar senha"
                    >
                        <i data-lucide="eye" id="eye-icon" size="20"></i>
                    </button>
                </div>
            </div>

            <!-- Lembrar de mim -->
            <div class="flex items-center">
                <input
                    id="remember"
                    name="remember"
                    type="checkbox"
                    class="w-4 h-4 text-blue-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                >
                <label for="remember" class="ml-3 text-gray-700 font-medium">
                    Lembrar de mim
                </label>
            </div>

            <!-- Botão de Login -->
            <button
                type="submit"
                class="w-full py-4 px-6 btn-primary text-white rounded-lg font-bold focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Entrar
            </button>
        

        <!-- Links adicionais -->
        <div class="text-center space-y-3 mt-6">
            <a
                href=""
                class="block text-blue-600 hover:text-blue-700 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 rounded py-1"
            >
                Esqueci minha senha
            </a>
            
            <div class="border-t border-gray-200 pt-4">
                <p class="text-gray-600">
                    Não tem conta?
                    <a
                        href=""
                        class="text-blue-600 hover:text-blue-700 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 rounded ml-1"
                    >
                        Cadastre-se aqui
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Inicializar ícones Lucide
        lucide.createIcons();

        // Toggle de mostrar/ocultar senha
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            
            // Recriar ícones após mudança
            lucide.createIcons();
        }

        // Toggle de alto contraste
        function toggleHighContrast() {
            document.body.classList.toggle('high-contrast');
            
            // Salvar preferência no localStorage
            const isHighContrast = document.body.classList.contains('high-contrast');
            localStorage.setItem('highContrast', isHighContrast);
        }

        // Carregar preferência de alto contraste
        document.addEventListener('DOMContentLoaded', function() {
            const savedHighContrast = localStorage.getItem('highContrast');
            if (savedHighContrast === 'true') {
                document.body.classList.add('high-contrast');
            }
        });

        // Validação de formulário em tempo real
        document.getElementById('email').addEventListener('input', function() {
            this.classList.remove('border-red-500');
        });

        document.getElementById('password').addEventListener('input', function() {
            this.classList.remove('border-red-500');
        });
    </script>
</body>
</html>