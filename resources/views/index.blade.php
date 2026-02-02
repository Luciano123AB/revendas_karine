@extends("layouts.main_layout")

@section("content")
    <div class="carrossel d-flex gap-1 mb-5">
        <div id="carousel_ofertas" class="carousel slide w-75">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
    
            <div class="carousel-inner shadow">
                <div class="carousel-item active">
                    <img src="{{ asset("assets/images/banners/ofertas01.png") }}" class="carrossel d-block border border-black w-100">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset("assets/images/banners/ofertas02.png") }}" class="carrossel d-block border border-black w-100">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset("assets/images/banners/ofertas03.png") }}" class="carrossel d-block border border-black w-100">
                </div>
            </div>
    
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel_ofertas" data-bs-slide="prev">
                <i class="bi bi-chevron-double-left bg-dark opacity-75 fs-1"></i>
                <span>Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel_ofertas" data-bs-slide="next">
                <span>Próximo</span>
                <i class="bi bi-chevron-double-right bg-dark opacity-75 fs-1"></i>
            </button>
        </div>
        <div class="carrossel d-flex flex-column w-25">
            <div class="carousel slide h-50 pb-1" data-bs-ride="carousel">
                <div class="carousel-inner shadow h-100">
                    <div class="carousel-item active border border-black h-100">
                        <img src="{{ asset("assets/images/banners/ofertas01.png") }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item border border-black h-100">
                        <img src="{{ asset("assets/images/banners/ofertas02.png") }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item border border-black h-100">
                        <img src="{{ asset("assets/images/banners/ofertas03.png") }}" class="d-block w-100 h-100">
                    </div>
                </div>
            </div>
            <img src="{{ asset("assets/images/banners/ofertas03.png") }}" class="border border-black shadow h-50">
        </div>
    </div>

    <h1 class="card-title mb-1">
        <i class="bi bi-fire"></i>
        <span>OFERTAS DO DIA:</span>
    </h1>
    <div id="ofertas" class="@if($total > 0) produtos overflow-auto @endif d-grid mb-5 gap-3">
        @forelse ($ofertas as $oferta)
            <div class="fundo card shadow">
                <img src="{{ $oferta->imagem == null ? asset("assets/images/icons/icone_produtos.png") : "$oferta->imagem" }}" class="card-img-top bg-white w-100 p-3" height="200">
                <h5 class="card-header text-center">{{ $oferta->nome }}</h5>

                <div class="card-body">
                    <p class="text-decoration-line-through m-0">R$ {{ number_format($oferta->preco, 2, ',', '.') }}</p>
                    <h4 class="card-text">R$ {{ number_format($oferta->preco - ($oferta->preco * $oferta->desconto / 100), 2, ',', '.') }} <span class="bg-success fs-5">-{{ $oferta->desconto }}%</span></h4>
                </div>

                <div class="card-footer text-center">
                    @auth
                        @if ($oferta->estoque > 0)
                            @if (Auth::user()->name != "Admin")
                                <a href="{{ route('escolher', ["id" => Crypt::encrypt($oferta->id)]) }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">ESCOLHER</a>
                            @endif
                        @else
                            @if (Auth::user()->name != "Admin")
                                <button class="btn btn-secondary border border-black" disabled>ESGOTADO</button>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>        
        @empty
            <div id="nenhuma_oferta">
                <div class="card bg-light shadow text-center p-1">
                    <h4 class="card-title">Nenhuma oferta disponível no momento. Volte mais tarde!</h4>
                </div>
            </div>
        @endforelse
    </div>
@endsection