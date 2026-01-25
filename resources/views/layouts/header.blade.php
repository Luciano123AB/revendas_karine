<nav id="barra" class="navbar bg-warning shadow-lg">
    <div class="container-fluid">
        <a href="{{ route("inicial") }}" class="navbar-brand text-decoration-none text-light fs-2 fw-bold">
            <i class="bi bi-card-image fs-1"></i>
            <span>{{ config("app.name") }}</span>
            <span>- {{ $pagina }}</span>
        </a>

        <div class="d-flex align-items-center gap-2">
            @auth
                <span>Cliente: {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    
                    <button type="submit" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Sair</button>
                </form>    
            @else
                <a href="{{ route("login") }}" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Entre</a>
                <a href="{{ route("register") }}" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Criar Conta</a>
            @endauth
        </div>
    </div>
</nav>