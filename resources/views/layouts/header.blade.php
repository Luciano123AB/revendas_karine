<nav id="barra" class="navbar bg-warning shadow-lg border-5 border-bottom border-black">
    <div class="container-fluid">
        <a href="{{ route("inicial") }}" class="navbar-brand text-decoration-none text-light fs-2 fw-bold">
            <img src="{{ asset('assets/images/icons/icone.png') }}" width="70" height="70">
            <span>{{ config("app.name") }}</span>
            <span>- {{ $pagina }}</span>
        </a>

        <div class="d-flex align-items-center gap-2">
            @auth
                <div class="d-grid">
                    <span>Cliente: {{ Auth::user()->name }}</span>
                    <span>Email: {{ Auth::user()->email }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    
                    <button type="submit" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Sair</button>
                </form>
                @if ($pagina != "Home")
                    <a href="{{ route("home") }}" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Lista Completa</a>
                @endif
            @else
                <a href="{{ route("login") }}" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Entre</a>
                <a href="{{ route("register") }}" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Criar Conta</a>
            @endauth
        </div>
    </div>
</nav>