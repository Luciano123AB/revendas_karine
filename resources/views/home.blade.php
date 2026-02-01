@extends("layouts.main_layout")

@section("content")
    <h1 class="card-title mb-1 mt-5">
        <i class="bi bi-box-seam-fill"></i>
        <span>TODOS OS PRODUTOS:</span>
    </h1>
    <div class="vh-100 mb-5">
        <div style="max-height: 100vh;" class="@if ($total > 0) produtos overflow-auto @endif d-grid gap-3">
            @forelse ($produtos as $produto)
                <div class="fundo card shadow">
                    <img src="{{ $produto->imagem == null ? asset("assets/images/icons/icone_produtos.png") : "$produto->imagem" }}" class="card-img-top {{ $produto->imagem == null ? "bg-warning" : "bg-white p-3" }} w-100" height="200">
                    <h5 class="card-header text-center">{{ $produto->nome }}</h5>

                    <div class="card-body align-content-center">
                        @if ($produto->desconto > 0)
                            <p class="text-decoration-line-through m-0">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        @endif
                        <h4 class="card-text">R$ {{ number_format($produto->preco - ($produto->preco * $produto->desconto / 100), 2, ',', '.') }}
                            @if ($produto->desconto > 0)
                                <span class="bg-success fs-5">-{{ $produto->desconto }}%</span>
                            @endif
                        </h4>
                    </div>

                    <div class="card-footer text-center">
                        @if (Auth::user()->name != "Admin")
                            <a href="{{ route('escolher', ["id" => Crypt::encrypt($produto->id)]) }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">ESCOLHER</a>
                        @endif
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
