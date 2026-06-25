@if(session("confirmar"))
    @include("layouts.partials.formulario_confirmacao")

    <script>
        Swal.fire({
            title: "{{ strtoupper(session('confirmar.acao')) }}?",
            text: "Tem certeza que deseja {{ session('confirmar.acao') }}" +
                        "@if (session('confirmar.acao') == 'resetar')" +
                            " todos os produtos?" +
                        "@elseif (session('confirmar.acao') == 'deletar')" +
                            " sua conta? (Todas as suas compras pendentes serão canceladas)" +
                        "@else" +
                            " esse {{ session('confirmar.acao') == 'comprar' ? 'produto' : 'pedido' }}?" +
                        "@endif",
            icon: "warning",
            background: "#ffc107",
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            cancelButtonText: "Desistir",
            customClass: {
                confirmButton: "btn btn-success border border-black focus-ring focus-ring-success",
                cancelButton: "btn btn-danger border border-black focus-ring focus-ring-danger",
                popup: "border border-black shadow"
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("formulario_confirmacao").submit();
            }
        });
    </script>
@endif

@if(session("resultado"))
    <script>
        Swal.fire({
            title: "{{ session('resultado.titulo') }}!",
            text: "{{ session('resultado.menssagem') }}",
            icon: "{{ session('resultado.icone') }}",
            background: "#ffc107",
            showConfirmButton: true,
            confirmButtonText: "OK",
            customClass: {
                confirmButton: "btn btn-success border border-black focus-ring focus-ring-success",
                popup: "border border-black shadow"
            }
        });
    </script>
@endif