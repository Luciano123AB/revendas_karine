@extends("layouts.main_layout")

@section("content")
    <form action="{{ route("comprar", ["id" => Crypt::encrypt($produto->id)]) }}" id="formulario" class="fundo card shadow w-100" method="POST">
        @csrf

        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset("assets/images/icons/icone_produtos.png") }}" class="imagem img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Nome: {{ $produto->nome }}</h5>
                    <p class="card-text border-bottom">Descrição: {{ $produto->descricao }}</p>
                    <p class="card-text border-bottom"><small class="text-body-secondary">Categoria: {{ $produto->categoria->nome }}</small></p>
                    <p class="card-text border-bottom"><small class="text-body-secondary">Estoque: {{ $produto->estoque }}</small></p>
                    <div class="d-flex gap-1 mb-3">
                        <div class="align-content-center">
                            <h4>Preço:</h4>
                        </div>
                        <div>
                            @if ($produto->desconto > 0)
                                <p class="text-decoration-line-through m-0">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                            @endif
                            <h4 class="card-text">R$ {{ number_format($produto->preco - ($produto->preco * $produto->desconto / 100), 2, ',', '.') }}
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
                        <input type="number" class="form-control focus-ring focus-ring-danger w-25" name="quantidade" placeholder="1" value="1" min="1" max="{{ $produto->estoque }}">
                        @error('quantidade')
                            <div class="form-control bg-danger-subtle">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route("home") }}" type="button" class="btn btn-warning border border-black focus-ring focus-ring-warning">Voltar</a>
                <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Comprar</button>
            </div>
        </div>
    </form>
@endsection