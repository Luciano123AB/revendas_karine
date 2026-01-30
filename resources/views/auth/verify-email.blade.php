@extends("layouts.main_layout")

@section("content")
    <form action="{{ route('verification.send') }}" id="formulario" class="fundo card shadow w-100" method="POST">
        @csrf

        <div class="card-header text-center">
            <h3 class="card-title">VERIFICAR</h3>
        </div>
        <div class="card-body d-grid gap-3">
            <div class="form-group">
                <label><i class="bi bi-envelope"></i> Email:</label>
                <div class="d-flex gap-2">
                    <input type="email" class="form-control" name="email" placeholder="endereco@gmail.com" autofocus required value="{{ auth()->user()->email }}">
                    <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Enviar</button>
                </div>
                @if (session('status') == 'verification-link-sent')
                    <div class="form-control bg-success-subtle">
                        <span class="text-success">Um novo link de verificação foi enviado para o seu endereço de e-mail.</span>
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection