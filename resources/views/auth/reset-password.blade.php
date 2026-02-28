@extends("layouts.main_layout")

@section("content")
    <form action="{{ route('password.update') }}" id="formulario" class="fundo card shadow w-100" method="POST">
        @csrf

        <div class="card-header text-center">
            <h3 class="card-title">REDEFINIR</h3>
        </div>            
        <div class="card-body d-grid gap-3">
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">

            <div class="form-group">
                <label><i class="bi bi-key"></i> Nova Senha:</label>
                <div class="input-group">
                    <input type="password" id="senha" class="form-control focus-ring focus-ring-danger" name="password" placeholder="***">
                    <button type="button" id="exibir_ocultar" class="btn btn-light border-start focus-ring focus-ring-danger"><i id="botao" class="bi bi-eye"></i></button>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Confirmar Nova Senha:</label>
                <input type="password" class="form-control focus-ring focus-ring-danger" name="password_confirmation" placeholder="***">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('login') }}">Lembrei minha senha!</a>
                <button type="button" class="btn btn-secondary border border-black focus-ring focus-ring-secondary" onclick="limparCampos()">Limpar</button>
            </div>
            <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Confirmar</button>
        </div>
    </form>
@endsection