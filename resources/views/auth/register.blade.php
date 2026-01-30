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
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-envelope"></i> Email:</label>
                <input type="email" class="form-control focus-ring focus-ring-danger" name="email" placeholder="endereco@gmail.com" value="{{ old('email') }}">
                @error('email')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Senha:</label>
                <input type="password" class="form-control focus-ring focus-ring-danger" name="password" placeholder="***">
                @error('password')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Confirmar Senha:</label>
                <input type="password" class="form-control focus-ring focus-ring-danger" name="password_confirmation" placeholder="***">
                @error('password_confirmation')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-telephone"></i> Telefone: DDD + Número</label>
                <input type="text" id="telefone" class="form-control focus-ring focus-ring-danger" name="telefone" placeholder="(55) 99999-9999" value="{{ old('telefone') }}">
                @error('telefone')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary border border-black focus-ring focus-ring-secondary" onclick="limparCampos()">Limpar</button>
            <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Cadastrar</button>
        </div>
    </form>
@endsection