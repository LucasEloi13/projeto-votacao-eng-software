    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Vota Comunidade')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" xintegrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0V4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            body {
                background-color: #f0f2f5; 
                font-family: 'Inter', sans-serif;
            }
            .navbar {
                background-color: #4338CA; 
                padding: 1rem 2rem;
            }
            .navbar-brand {
                color: #fff;
                font-weight: 700;
                font-size: 1.5rem;
            }
            .nav-link {
                color: #fff;
                font-weight: 500;
                margin: 0 0.5rem;
                padding: 0.5rem 1rem;
                border-radius: 8px; 
                transition: background-color 0.3s ease;
            }
            .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.2);
                color: #fff;
            }
            .btn-sair {
                background-color: #dc3545; 
                color: #fff;
                font-weight: 500;
                padding: 0.5rem 1.5rem;
                border-radius: 8px;
                transition: background-color 0.3s ease;
            }
            .btn-sair:hover {
                background-color: #c82333;
                border-color: #bd2130;
            }
            .container-main {
                padding: 30px;
            }
        </style>
        
        <!-- Estilos específicos de cada página -->
        @stack('styles')
    </head>
    <body>
        {{-- A seção 'navbar' será preenchida por cada view específica --}}
        @yield('navbar')

        <div class="container container-main">
            @yield('content')
        </div>

        <!-- Link para o JavaScript do Bootstrap (bundle inclui Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <!-- Scripts específicos de cada página -->
        @stack('scripts')
    </body>
    </html>
