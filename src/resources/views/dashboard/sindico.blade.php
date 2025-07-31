<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Síndico - Vota Comunidade</title>
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
        .stats-card {
            background: linear-gradient(135deg, #4339F2 0%, #6366f1 100%);
            color: white;
            border-radius: 16px;
            padding: 1.5rem;
        }
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg px-4 py-3">
        <span class="navbar-brand fw-bold">Vota Comunidade</span>
        <div class="navbar-nav ms-auto">
            <a class="nav-link me-3" href="{{ route('dashboard.sindico') }}">Início</a>
            <a class="nav-link me-3" href="#">Pautas</a>
            <a class="nav-link me-3" href="#">Moradores</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn logout-btn">Sair</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-1">Dashboard do Síndico</h2>
                <p class="text-muted">Bem-vindo, {{ $usuario['nome'] }} - {{ $sindico->nome_condominio }}</p>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $stats['total_moradores'] }}</div>
                    <div>Total de Moradores</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $stats['pautas_ativas'] }}</div>
                    <div>Pautas Ativas</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $stats['pautas_encerradas'] }}</div>
                    <div>Pautas Encerradas</div>
                </div>
            </div>
        </div>

        <!-- Opções de Gerenciamento -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-option h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">Criar Nova Pauta</h5>
                        <p class="card-text text-muted">
                            Criar nova votação para os moradores do condomínio.
                        </p>
                        <a href="#" class="btn btn-primary">Criar Pauta</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card card-option h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">Gerenciar Pautas</h5>
                        <p class="card-text text-muted">
                            Visualizar, editar e encerrar pautas existentes.
                        </p>
                        <a href="#" class="btn btn-primary">Ver Pautas</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card card-option h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">Lista de Moradores</h5>
                        <p class="card-text text-muted">
                            Visualizar informações dos moradores do condomínio.
                        </p>
                        <a href="#" class="btn btn-primary">Ver Moradores</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card card-option h-100">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">Relatórios</h5>
                        <p class="card-text text-muted">
                            Gerar relatórios de votações e participação.
                        </p>
                        <a href="#" class="btn btn-primary">Ver Relatórios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
