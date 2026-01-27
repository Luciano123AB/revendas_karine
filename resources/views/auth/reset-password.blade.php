@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <form action="{{ route('password.update') }}" id="formulario" class="card bg-warning shadow w-100" method="POST">
                @csrf

                <div class="card-header text-center">
                    <h3 class="card-title">REDEFINIR</h3>
                </div>            
                <div class="card-body d-grid gap-3">
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <input type="hidden" name="email" value="{{ request('email') }}">

                    <div class="form-group">
                        <label><i class="bi bi-key"></i> Senha:</label>
                        <input type="password" class="form-control focus-ring focus-ring-danger" name="password" placeholder="***">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-key"></i> Confirmar Senha:</label>
                        <input type="password" class="form-control focus-ring focus-ring-danger" name="password_confirmation" placeholder="***">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger" onclick="limparCampos()">Limpar</button>
                    <button type="submit" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
@endsection