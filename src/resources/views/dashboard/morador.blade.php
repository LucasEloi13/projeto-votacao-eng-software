<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Morador - Vota Comunidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f6f6f9;
        }
        .navbar {
            background-color: #4339F2;
        }
        .navbar a, .navbar-brand {
            color: white !important;
        }
        .card-option {
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }
        .card-option:hover {
            transform: scale(1.02);
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }
        .voting-card {
            border-left: 4px solid #4339F2;
        }
        .badge-voting {
            background-color: #4339F2;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg px-4 py-3">
        <span class="navbar-brand fw-bold">Vota Comunidade</span>
        <div class="navbar-nav ms-auto">
            <a class="nav-link me-3" href="{{ route('dashboard.morador') }}">Início</a>
            <a class="nav-link me-3" href="#">Minhas Votações</a>
            <a class="nav-link me-3" href="#">Histórico</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn logout-btn">Sair</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-1">Dashboard do Morador</h2>
                <p class="text-muted">
                    Bem-vindo, {{ $usuario['nome'] }} - 
                    {{ $morador->nome_condominio }}, 
                    Bloco {{ $morador->bloco }}, 
                    Unidade {{ $morador->unidade }}
                </p>
            </div>
        </div>

        <!-- Pautas Ativas para Votação -->
        <div class="row mb-5">
            <div class="col-12">
                <h4 class="mb-3">Votações Ativas</h4>
                
                @if($pautasAtivas->count() > 0)
                    @foreach($pautasAtivas as $pauta)
                        <div class="card voting-card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="card-title">{{ $pauta->titulo }}</h5>
                                        <p class="card-text text-muted">{{ $pauta->descricao }}</p>
                                        <small class="text-muted">
                                            Encerra em: {{ \Carbon\Carbon::parse($pauta->data_fim)->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge badge-voting">Ativa</span>
                                        <div class="mt-2">
                                            <a href="#" class="btn btn-primary btn-sm">Votar Agora</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <h5 class="text-muted">Nenhuma votação ativa no momento</h5>
                            <p class="text-muted">Quando houver novas votações, elas aparecerão aqui.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Opções do Morador -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-option h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">Minhas Votações</h5>
                        <p class="card-text text-muted">
                            Visualizar todas as votações em que você participou.
                        </p>
                        <a href="#" class="btn btn-primary">Ver Histórico</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card card-option h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">Resultados</h5>
                        <p class="card-text text-muted">
                            Conferir resultados das votações finalizadas.
                        </p>
                        <a href="#" class="btn btn-primary">Ver Resultados</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card card-option h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">Meu Perfil</h5>
                        <p class="card-text text-muted">
                            Editar informações pessoais e dados de contato.
                        </p>
                        <a href="#" class="btn btn-primary">Editar Perfil</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card card-option h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">Suporte</h5>
                        <p class="card-text text-muted">
                            Entrar em contato para dúvidas ou sugestões.
                        </p>
                        <a href="#" class="btn btn-primary">Contato</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
