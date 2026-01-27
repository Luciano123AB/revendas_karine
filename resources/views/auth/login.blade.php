@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <form action="{{ route('login') }}" id="formulario" class="card bg-warning shadow w-100" method="POST">
                @csrf

                <div class="card-header text-center">
                    <h3 class="card-title">LOGIN</h3>
                </div>            
                <div class="card-body d-grid gap-3">
                    <div class="form-group">
                        <label><i class="bi bi-envelope"></i> Email:</label>
                        <input type="email" class="form-control focus-ring focus-ring-danger" name="email" placeholder="endereco@gmail.com" value="{{ old('email') }}" autofocus>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-key"></i> Senha:</label>
                        <input type="password" class="form-control focus-ring focus-ring-danger" name="password" placeholder="***" value="{{ old('password') }}">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger" onclick="limparCampos()">Limpar</button>
                    <button type="submit" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Entrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection