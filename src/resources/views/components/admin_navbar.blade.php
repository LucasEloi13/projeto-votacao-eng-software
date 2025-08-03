@props(['currentPage' => ''])

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            Vota Comunidade
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage === 'dashboard' ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}"
                       @if($currentPage === 'dashboard') aria-current="page" @endif>
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage === 'sindicos' ? 'active' : '' }}" 
                       href="#"
                       @if($currentPage === 'sindicos') aria-current="page" @endif>
                        Síndicos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage === 'moradores' ? 'active' : '' }}" 
                       href="#"
                       @if($currentPage === 'moradores') aria-current="page" @endif>
                        Moradores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage === 'condominios' ? 'active' : '' }}" 
                       href="{{ route('admin.condominios.index') }}"
                       @if($currentPage === 'condominios') aria-current="page" @endif>
                        Condomínios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage === 'resultados' ? 'active' : '' }}" 
                       href="#"
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
