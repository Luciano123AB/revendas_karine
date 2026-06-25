@extends("layouts.main_layout")

@section("content")
    <form action="{{ route("confirmar.comprar", ["id" => $produto->id_crypt]) }}" id="formulario" class="fundo card shadow w-100" method="POST">
        @csrf

        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $produto->imagem == null ? asset("assets/images/icons/icone_produtos.png") : "$produto->imagem" }}" class="imagem bg-white img-fluid rounded border-black p-3">
            </div>
            <div class="col-md-8">
                <h5 class="card-header text-center">Nome: {{ $produto->nome }}</h5>
                <div class="card-body">
                    <p id="descricao" class="card-text border-bottom border-black overflow-auto">Descrição: {{ $produto->descricao }}</p>
                    <p class="card-text border-bottom border-black"><small class="text-body-secondary">Categoria: {{ $produto->categoria->nome }}</small></p>
                    <p class="card-text border-bottom border-black"><small class="text-body-secondary">Estoque: {{ $produto->estoque }}</small></p>
                    <div class="d-flex gap-1 mb-3">
                        <div class="align-content-center">
                            <h4>Preço:</h4>
                        </div>
                        <div>
                            @if ($produto->desconto > 0)
                                <p class="text-decoration-line-through m-0">R$ {{ $produto->preco_base }}</p>
                            @endif
                            <h4 class="card-text">R$ {{ $produto->preco_formatado }}
                                @if ($produto->desconto > 0)
                                    <span class="bg-success fs-5">-{{ $produto->desconto }}%</span>
                                @endif
                            </h4>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-1">
                        <div class="align-content-center">
                            <h5>Quantidade:</h5>
                        </div>
                        <input type="number" class="form-control focus-ring focus-ring-danger w-25" name="quantidade" placeholder="1" value="{{ old("quantidade", 1) }}" min="1" max="{{ $produto->estoque }}">
                        @error('quantidade')
                            <span class="text-danger align-content-center">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route("home", ["categoria" => "Todos"]) }}" type="button" class="btn btn-warning border border-black focus-ring focus-ring-warning">Voltar</a>
                <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Comprar</button>
            </div>
        </div>
    </form>
@endsection