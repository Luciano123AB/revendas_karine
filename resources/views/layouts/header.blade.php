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
                    <div class="d-grid bg-danger btn border border-black">
                        <span class="text-white">Cliente: {{ Auth::user()->email }}</span>
                    </div>
                    <button type="button" class="dropdown-toggle btn btn-danger border border-black focus-ring focus-ring-danger" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end bg-warning">
                        @if ($pagina != "Atualizar Dados")
                            <li>
                                <a href="{{ route("editar") }}" class="dropdown-item btn btn-danger border-top border-danger focus-ring focus-ring-danger">Editar</a>
                            </li>
                        @endif
                        @if ($pagina != "Pedidos")
                            <li>
                                <a href="{{ route("pedidos") }}" class="dropdown-item btn btn-danger border-top border-danger focus-ring focus-ring-danger">Pedidos</a>
                            </li>
                        @endif
                        @if ($pagina != "Histórico")
                            <li>
                                <a href="{{ route("historico") }}" class="dropdown-item btn btn-danger border-top border-danger focus-ring focus-ring-danger">Histórico</a>
                            </li>
                        @endif
                        <li>
                            <form action="{{ route("logout") }}" method="POST">
                                @csrf
                                
                                <button type="submit" class="dropdown-item btn btn-danger border-top border-bottom border-danger focus-ring focus-ring-danger">Sair</button>
                            </form>
                        </li>
                    </ul>
                </div>                
                @if ($pagina != "Lista")
                    <a href="{{ route("home") }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">Lista Completa</a>
                @else
                    <a href="{{ route("inicio") }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">Início</a>
                @endif
            @else
                <a href="{{ route("login") }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">Entre</a>
                <a href="{{ route("register") }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">Criar Conta</a>
            @endauth
        </div>
    </div>
</nav>