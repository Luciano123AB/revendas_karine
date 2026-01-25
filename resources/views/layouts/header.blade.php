<nav class="navbar bg-warning shadow-lg mb-5">
    <div class="container-fluid">
        <a href="{{ route("inicial") }}" class="navbar-brand text-decoration-none text-light fs-2 fw-bold"><i class="bi bi-card-image fs-1"></i> <span>{{ env("APP_NAME") }}</span></a>

        <div class="opcoes gap-2">
            <a href="{{ route("login") }}" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Entrar</a>
            <a href="{{ route("register") }}" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Criar Conta</a>
        </div>
    </div>
</nav>