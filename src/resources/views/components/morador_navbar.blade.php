@props(['currentPage' => ''])

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('morador.dashboard') }}">
            Vota Comunidade
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage === 'dashboard' ? 'active' : '' }}" 
                       href="#"
                       @if($currentPage === 'dashboard') aria-current="page" @endif>
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage === 'votacoes' ? 'active' : '' }}" 
                        href="{{ route('morador.votacoes.index') }}"
                       @if($currentPage === 'votacoes') aria-current="page" @endif>
                        Votações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage === 'resultados' ? 'active' : '' }}" 
                       href="{{ route('morador.resultados.index') }}"
                       @if($currentPage === 'resultados') aria-current="page" @endif>
                        Resultados
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sair" type="submit">Sair</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
