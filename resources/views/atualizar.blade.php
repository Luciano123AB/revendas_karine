@extends("layouts.main_layout")

@section("content")
    <form action="{{ route("atualizar") }}" id="formulario" class="fundo card shadow w-100" method="POST">
        @csrf

        <div class="card-header text-center">
            <h3 class="card-title">ATUALIZAR CONTA</h3>
        </div>            
        <div class="card-body d-grid gap-3">
            <div class="form-group">
                <label><i class="bi bi-envelope"></i> Email:</label>
                <input type="email" id="email" class="form-control focus-ring focus-ring-danger" name="email" placeholder="endereco@gmail.com" value="{{ $dados["email"] }}">
                @error('email')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
                @session('email')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ session("email") }}</span>
                    </div>
                @endsession
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Senha:</label>
                <div class="input-group">
                    <input type="password" id="senha" class="form-control focus-ring focus-ring-danger" name="senha" placeholder="***">
                    <button type="button" id="exibir_ocultar" class="btn btn-light border-start"><i id="botao" class="bi bi-eye"></i></button>
                </div>
                @error('senha')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Confirmar Senha:</label>
                <input type="password" class="form-control focus-ring focus-ring-danger" name="senha_confirmation" placeholder="***">
                @error('senha_confirmation')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-telephone"></i> Telefone: DDD + Número</label>
                <input type="text" id="telefone" class="form-control focus-ring focus-ring-danger" name="telefone" placeholder="(55) 99999-9999" value="{{ $dados["telefone"] }}">
                @error('telefone')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
                @session('telefone')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ session("telefone") }}</span>
                    </div>
                @endsession
            </div>
        </div>
        @error('falha')
            <div class="form-control bg-danger-subtle">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
        @session('sucesso')
            <div class="form-control bg-success-subtle">
                <span class="text-success">{{ session("sucesso") }}</span>
            </div>
        @endsession

        <div class="card-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary border border-black focus-ring focus-ring-secondary" onclick="limparCampos()">Limpar</button>
            <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Atualizar</button>
        </div>
    </form>
@endsection