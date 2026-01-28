<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background-image: url("{{ asset('assets/images/carrinho.png') }}");
        background-repeat: repeat;
        background-size: 200px;
    }

    #barra {
        padding-left: 5%;
        padding-right: 5%;
    }

    .carrossel {
        height: 25vh;
    }

    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .produtos {
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    }

    #direitos {
        display: flex;
    }

    @media (max-width: 430px) {
        #barra {
            padding-left: 0%;
            padding-right: 0%;
        }

        #pagina {
            font-size: medium;
        }

        .carousel-control-prev span,
        .carousel-control-next span {
            display: none;
        }

        .produtos {
            grid-template-columns: 1fr 1fr;
        }

        #direitos {
            display: grid;
        }
    }
</style>