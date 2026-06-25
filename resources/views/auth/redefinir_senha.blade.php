@extends("layouts.main_layout")

@section("content")
    <form action="{{ route('redefinir') }}" id="formulario" class="fundo card shadow w-100" method="POST">
        @csrf

        <div class="card-header text-center">
            <h3 class="card-title">REDEFINIR</h3>
        </div>            
        <div class="card-body d-grid gap-3">
            <div class="form-group">
                <label><i class="bi bi-key"></i> Senha Atual:</label>
                <div class="input-group">
                    <input type="password" id="senha_atual" class="form-control focus-ring focus-ring-danger" name="senha_atual" placeholder="***">
                    <button type="button" id="exibir_ocultar_atual" class="btn btn-light border-start focus-ring focus-ring-danger"><i id="botao_atual" class="bi bi-eye"></i></button>
                </div>
                @error('senha_atual')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Nova Senha:</label>
                <div class="input-group">
                    <input type="password" id="senha" class="form-control focus-ring focus-ring-danger" name="senha" placeholder="@Example123">
                    <button type="button" id="exibir_ocultar" class="btn btn-light border-start focus-ring focus-ring-danger"><i id="botao" class="bi bi-eye"></i></button>
                </div>
                @error('senha')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label><i class="bi bi-key"></i> Confirmar Nova Senha:</label>
                <div class="input-group">
                    <input type="password" id="senha_confirmacao" class="form-control focus-ring focus-ring-danger" name="senha_confirmation" placeholder="***">
                    <button type="button" id="exibir_ocultar_confirmacao" class="btn btn-light border-start focus-ring focus-ring-danger"><i id="botao_confirmacao" class="bi bi-eye"></i></button>
                </div>
                @error('senha_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        @error('falha')
            <div class="form-control bg-danger-subtle">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror

        <div class="card-footer d-flex justify-content-between">
            <div class="d-flex gap-2">
                <a href="{{ route("atualizar.conta") }}" type="button" class="btn btn-warning border border-black focus-ring focus-ring-warning">Voltar</a>
                <button type="button" class="btn btn-secondary border border-black focus-ring focus-ring-secondary" onclick="limparCampos()">Limpar</button>
            </div>
            <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Confirmar</button>
        </div>
    </form>
@endsection