@extends("layouts.main_layout")

@section("content")    
    <div class="container">
        <div class="d-flex gap-1 mb-5">
            <div id="carousel_ofertas" class="carousel slide w-75">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
        
                <div class="carousel-inner shadow">
                    <div class="carousel-item active">
                        <img src="{{ asset("assets/images/banners/exemplo01.png") }}" class="d-block border border-black w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset("assets/images/banners/exemplo02.png") }}" class="d-block border border-black w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset("assets/images/banners/exemplo03.png") }}" class="d-block border border-black w-100">
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
            <div class="d-flex flex-column gap-1 w-25">
                <div class="carousel slide h-50" data-bs-ride="carousel">
                    <div class="carousel-inner shadow h-100">
                        <div class="carousel-item active border border-black h-100">
                            <img src="{{ asset("assets/images/banners/exemplo01.png") }}" class="d-block w-100 h-100">
                        </div>
                        <div class="carousel-item border border-black h-100">
                            <img src="{{ asset("assets/images/banners/exemplo02.png") }}" class="d-block w-100 h-100">
                        </div>
                        <div class="carousel-item border border-black h-100">
                            <img src="{{ asset("assets/images/banners/exemplo03.png") }}" class="d-block w-100 h-100">
                        </div>
                    </div>
                </div>
                <img src="{{ asset("assets/images/banners/exemplo03.png") }}" class="border border-black shadow h-50">
            </div>
        </div>

        <h1 class="card-title mb-1">
            <i class="bi bi-fire"></i>
            <span>OFERTAS DO DIA:</span>
        </h1>
        <div class="produto d-grid mb-5 gap-3">
            @for ($i = 0; $i < 7; $i++)
                <div class="card bg-light shadow">
                    <img src="https://static.vecteezy.com/system/resources/previews/014/918/179/non_2x/plastic-shop-cart-icon-flat-isolated-vector.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Produto: Nome do Produto</h5>
                        <p class="card-text">Valor: R$000,00</p>
                        <div class="text-center">
                            <a href="#" class="btn btn-outline-danger border border-danger shadow focus-ring focus-ring-danger">COMPRAR</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection