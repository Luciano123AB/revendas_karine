@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <form action="{{ route('verification.send') }}" id="formulario" class="card bg-warning shadow w-100" method="POST">
                @csrf

                <div class="card-header text-center">
                    <h3 class="card-title">VERIFICAR</h3>
                </div>
                <div class="card-body d-grid gap-3">
                    <div class="form-group">
                        <label><i class="bi bi-envelope"></i> Email:</label>
                        <div class="d-flex gap-2">
                            <input type="email" class="form-control" name="email" placeholder="endereco@gmail.com" autofocus required value="{{ auth()->user()->email }}">
                            <button type="submit" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">Enviar</button>
                        </div>
                        @if (session('status') == 'verification-link-sent')
                            <div class="text-success">
                                Um novo link de verificação foi enviado para o seu endereço de e-mail.
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection