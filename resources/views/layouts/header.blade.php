<nav id="barra" class="navbar bg-warning shadow-lg border-5 border-bottom border-black">
    <div class="container-fluid">
        <a href="{{ route("inicio") }}" class="navbar-brand text-decoration-none text-light fs-2 fw-bold">
            <img src="{{ asset('assets/images/icons/icone.png') }}" width="70" height="70">
            <span>{{ config("app.name") }}</span>
            <span id="pagina">- {{ $pagina }}</span>
        </a>

        <div class="d-flex align-items-center gap-2">
            @auth                
                <div class="btn-group">
                    <div class="d-grid btn bg-danger">
                        <span>Cliente: {{ Auth::user()->email }}</span>
                    </div>
                    <button type="button" class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end bg-warning">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                
                                <button type="submit" class="dropdown-item btn btn-outline-danger border-top border-bottom border-danger focus-ring focus-ring-danger">Sair</button>
                            </form>
                        </li>
                        <li>
                            <a href="{{ route("historico") }}" class="dropdown-item btn btn-outline-danger border-bottom border-danger focus-ring focus-ring-danger">Histórico</a>
                        </li>
                    </ul>
                </div>                
                @if ($pagina != "Lista")
                    <a href="{{ route("home") }}" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Lista Completa</a>
                @else
                    <a href="{{ route("inicio") }}" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Início</a>
                @endif
            @else
                <a href="{{ route("login") }}" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Entre</a>
                <a href="{{ route("register") }}" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Criar Conta</a>
            @endauth
        </div>
    </div>
</nav>