@extends("layouts.main_layout")

@section("content")
    <form action="{{ route('login') }}" id="formulario" class="fundo card shadow w-100" method="POST">
        @csrf

        <div class="card-header text-center">
            <h3 class="card-title">LOGIN</h3>
        </div>            
        <div class="card-body d-grid gap-3">
            <div class="form-group">
                <label><i class="bi bi-envelope"></i> Email:</label>
                <input type="email" class="form-control focus-ring focus-ring-danger" name="email" placeholder="endereco@gmail.com" value="{{ old('email') }}" autofocus>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Senha:</label>
                <div class="input-group">
                    <input type="password" id="senha" class="form-control focus-ring focus-ring-danger" name="password" placeholder="***">
                    <button type="button" id="exibir_ocultar" class="btn btn-light border-start"><i id="botao" class="bi bi-eye"></i></button>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary border border-black focus-ring focus-ring-secondary" onclick="limparCampos()">Limpar</button>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('password.request') }}">Esqueci minha senha!</a>
                <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Entrar</button>
            </div>
        </div>
    </form>
@endsection