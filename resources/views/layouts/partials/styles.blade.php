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

    #ofertas {
        max-height: 70vh;
    }

    #nenhuma_oferta {
        height: 55vh;
    }

    #nenhum_produto {
        height: 100vh;
    }

    .produtos {
        max-height: 100vh;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    }

    #descricao {
        max-height: 60px;
    }

    .fundo {
        background-color: #fd7e14;
    }

    .imagem {
        width: 500px;
        height: 500px;
    }

    .swal2-icon.swal2-warning,
    .swal2-icon.swal2-success,
    .swal2-icon.swal2-error {
        border-color: #fd7e14;
        color: #fd7e14;
    }

    #formulario_confirmacao {
        display: none;
    }

    #qrcode {
        width: 30%;
    }

    .admin {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .tabela {
        max-height: 500px;
    }

    .numero {
        width: 1%;
    }

    #pix {
        max-height: 50px;
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

        #qrcode {
            width: 100%;
        }

        .admin {
            grid-template-columns: 1fr;
        }

        #direitos {
            display: grid;
        }
    }
</style>