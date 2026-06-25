@extends("layouts.main_layout")

@section("content")
    <div class="d-grid gap-3 w-100">
        <form action="{{ route("atualizar") }}" id="formulario" class="fundo card shadow" method="POST">
            @csrf

            <div class="card-header text-center">
                <h3 class="card-title">EDITAR CONTA</h3>
            </div>            
            <div class="card-body d-grid gap-3">
                <div class="form-group">
                    <label><i class="bi bi-envelope"></i> Email:</label>
                    <input type="email" id="email" class="form-control focus-ring focus-ring-danger" name="email" placeholder="endereco@gmail.com" value="{{ $dados["email"] }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @session('email')
                        <div class="form-control bg-danger-subtle">
                            <span class="text-danger">{{ session("email") }}</span>
                        </div>
                    @endsession
                </div>

                <div class="form-group">
                    <label><i class="bi bi-telephone"></i> Telefone: DDD + Número</label>
                    <input type="text" id="telefone" class="form-control focus-ring focus-ring-danger" name="telefone" placeholder="(55) 99999-9999" value="{{ $dados["telefone"] }}">
                    @error('telefone')
                        <span class="text-danger">{{ $message }}</span>
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

        <div class="fundo card shadow">
            <div class="card-body">
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route("redefinir.senha") }}" class="btn btn-warning border border-black focus-ring focus-ring-warning">Redefinir Senha</a>
                    <a href="{{ route("confirmar.deletar") }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">Deletar Conta</a>
                </div>
            </div>

            @session('sucesso_redefinir')
                <div class="form-control bg-success-subtle">
                    <span class="text-success">{{ session("sucesso_redefinir") }}</span>
                </div>
            @endsession
        </div>
    </div>
@endsection