@extends("layouts.main_layout")

@section("content")
    <form action="{{ route('comprar') }}" id="formulario" class="card shadow w-100" method="POST">
        @csrf

        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset("assets/images/icons/icone_produtos.png") }}" class="img-fluid rounded-start border-end">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title text-center mb-5">Nome: {{ $produto->nome }}</h5>
                    <p class="card-text border-bottom">Descrição: {{ $produto->descricao }}</p>
                    <p class="card-text border-bottom"><small class="text-body-secondary">Categoria: {{ $produto->categoria->nome }}</small></p>
                    <p class="card-text border-bottom"><small class="text-body-secondary">Estoque: {{ $produto->estoque }}</small></p>
                    <div class="d-flex gap-1">
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
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route("home") }}" type="button" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Voltar</a>
                <button type="submit" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">Comprar</button>
            </div>
        </div>
    </form>
@endsection