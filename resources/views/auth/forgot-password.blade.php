@extends("layouts.main_layout")

@section("content")
    <form action="{{ route('password.email') }}" id="formulario" class="card bg-warning shadow w-100" method="POST">
        @csrf

        <div class="card-header text-center">
            <h3 class="card-title">PEDIDO REDEFINIR</h3>
        </div>
        <div class="card-body d-grid gap-3">
            <div class="form-group">
                <label><i class="bi bi-envelope"></i> Email:</label>
                <div class="d-flex gap-2">
                    <input type="email" class="form-control" name="email" placeholder="endereco@gmail.com" autofocus required>
                    <button type="submit" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Enviar</button>
                </div>
                <div>
                    @if (session('status'))
                        <div class="form-control bg-success-subtle">
                            <span class="text-success">Um novo link de redefinição foi enviado para o seu endereço de e-mail.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection