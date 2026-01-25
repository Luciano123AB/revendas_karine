<style>
    * {
        margin: 0;
        padding: 0;
    }

    .navbar {
        padding-left: 5%;
        padding-right: 5%;
    }

    .opcoes {
        display: flex;
    }

    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .produto {
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    }

    @media (max-width: 430px) {
        .navbar {
            padding-left: 0%;
            padding-right: 0%;
        }

        .opcoes {
            display: grid;
        }

        .carousel-control-prev span,
        .carousel-control-next span {
            display: none;
        }

        .produto {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>