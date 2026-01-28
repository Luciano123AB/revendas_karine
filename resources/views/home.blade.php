@extends("layouts.main_layout")

@section("content")
    <h1 class="card-title mb-1 mt-5">
        <i class="bi bi-box-seam-fill"></i>
        <span>TODOS OS PRODUTOS:</span>
    </h1>
    <div class="vh-100 mb-5">
        <div style="max-height: 100vh;" class="@if ($total > 0) produtos @endif d-grid gap-3 overflow-auto">
            @forelse ($produtos as $produto)
                <div class="card bg-light shadow">
                    <img src="{{ asset("assets/images/icons/icone_produtos.png") }}" class="card-img-top border-bottom w-100" height="200">
                    <h5 class="card-title text-center">{{ $produto->nome }}</h5>

                    <div class="card-body">
                        <p class="text-decoration-line-through m-0">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        <h4 class="card-text">R$ {{ number_format($produto->preco, 2, ',', '.') }} @if ($produto->desconto > 0) <span class="bg-success fs-5">-{{ $produto->desconto }}%</span> @endif</h4>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('comprar') }}" class="btn btn-outline-danger border border-danger focus-ring focus-ring-danger">COMPRAR</a>
                    </div>
                </div>
            @empty
                <div style="height: 100vh">
                    <div class="card bg-light shadow text-center p-1">
                        <h4 class="card-title">Nenhuma produto disponível no momento. Volte mais tarde!</h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
