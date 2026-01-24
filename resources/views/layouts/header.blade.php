<nav class="navbar bg-primary mb-5">
    <div class="container-fluid mx-5">
        <a href="{{ route("inicial") }}" class="navbar-brand text-decoration-none text-light fs-2 fw-bold"><i class="bi bi-card-image fs-1"></i> {{ env("APP_NAME") }}</a>

        <div>
            <a href="{{ route("login") }}" class="btn btn-info">Login</a>
            <a href="{{ route("register") }}" class="btn btn-info">Cadastro</a>
        </div>
    </div>
</nav>