@if(session("confirmar"))
    @include("layouts.formulario_confirmacao")

    <script>
        Swal.fire({
            title: "{{ strtoupper(session('confirmar.acao')) }}?",
            text: "Tem certeza que deseja {{ session('confirmar.acao') }} @if (session('confirmar.acao') == 'resetar') todos os produtos? @else esse {{ session('confirmar.acao') == 'comprar' ? 'produto' : 'pedido' }}? @endif",
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