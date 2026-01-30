@if(session("confirmacao_pedido"))
    <script>
        Swal.fire({
            title: "Cancelar?",
            text: "Tem certeza que deseja cancelar esse pedido?",
            icon: "warning",
            background: "#ffc107",
            showConfirmButton: false,
            footer: "<div class='d-flex gap-2'>" +
                        "<a href='{{ route('cancelar_compra', ['id' => session('confirmacao_pedido')]) }}' class='btn btn-success border border-black focus-ring focus-ring-success'>Confirmar</a>" +
                        "<button id='cancelar' class='btn btn-danger border border-black focus-ring focus-ring-danger'>Desistir</button>" +
                    "</div>"
            });
    </script>
@endif