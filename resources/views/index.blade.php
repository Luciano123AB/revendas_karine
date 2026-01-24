@extends("layouts.main_layout")

@section("content")    
    <div class="container d-flex gap-1">
        <div id="carousel_ofertas" class="carousel slide w-75">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carousel_ofertas" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
    
            <div class="carousel-inner shadow">
                <div class="carousel-item active">
                    <img src="{{ asset("assets/images/banners/exemplo01.png") }}" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset("assets/images/banners/exemplo02.png") }}" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset("assets/images/banners/exemplo03.png") }}" class="d-block w-100">
                </div>
            </div>
    
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel_ofertas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span>Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel_ofertas" data-bs-slide="next">
                <span>Próximo</span>
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
        <div class="d-flex flex-column gap-1 w-25">
            <img src="{{ asset("assets/images/banners/exemplo02.png") }}" class="bg-light shadow h-50">
            <img src="{{ asset("assets/images/banners/exemplo03.png") }}" class="bg-light shadow h-50">
        </div>
    </div>
@endsection