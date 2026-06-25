@extends("layouts.main_layout")

@section("content")
    <form action="{{ route('register') }}" id="formulario" class="fundo card shadow w-100" method="POST">
        @csrf

        <div class="card-header text-center">
            <h3 class="card-title">CRIAR CONTA</h3>
        </div>            
        <div class="card-body d-grid gap-3">
            <div class="form-group">
                <label><i class="bi bi-person"></i> Usuário:</label>
                <input type="text" class="form-control focus-ring focus-ring-danger" name="name" placeholder="..." value="{{ old('name') }}" autofocus>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-envelope"></i> Email:</label>
                <input type="email" class="form-control focus-ring focus-ring-danger" name="email" placeholder="endereco@gmail.com" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Senha:</label>
                <div class="input-group">
                    <input type="password" id="senha" class="form-control focus-ring focus-ring-danger" name="password" placeholder="@Example123">
                    <button type="button" id="exibir_ocultar" class="btn btn-light border-start focus-ring focus-ring-danger"><i id="botao" class="bi bi-eye"></i></button>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Confirmar Senha:</label>
                <div class="input-group">
                    <input type="password" id="senha_confirmacao" class="form-control focus-ring focus-ring-danger" name="password_confirmation" placeholder="***">
                    <button type="button" id="exibir_ocultar_confirmacao" class="btn btn-light border-start focus-ring focus-ring-danger"><i id="botao_confirmacao" class="bi bi-eye"></i></button>
                </div>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-telephone"></i> Telefone: DDD + Número</label>
                <input type="text" id="telefone" class="form-control focus-ring focus-ring-danger" name="telefone" placeholder="(55) 99999-9999" value="{{ old('telefone') }}">
                @error('telefone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary border border-black focus-ring focus-ring-secondary" onclick="limparCampos()">Limpar</button>
            <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Cadastrar</button>
        </div>
    </form>
@endsection