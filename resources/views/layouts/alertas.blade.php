@if(session("confirmar"))
    <script>
        Swal.fire({
            title: "{{ strtoupper(session('confirmar.acao')) }}?",
            text: "Tem certeza que deseja {{ session('confirmar.acao') }} @if (session('confirmar.acao') == 'resetar') todos os produtos? @else esse {{ session('confirmar.acao') == 'comprar' ? 'produto' : 'pedido' }}? @endif",
            icon: "warning",
            background: "#ffc107",
            showConfirmButton: false,
            footer: "<div class='d-flex gap-2'>" +
                        @if(session("confirmar.acao") == "comprar" || session("confirmar.acao") == "aprovar")
                            "<a href='{{ route(session('confirmar.acao'), ['id' => session('confirmar.id'), 'quantidade' => session('confirmar.quantidade')]) }}' class='btn btn-success border border-black focus-ring focus-ring-success'>Confirmar</a>" +
                        @elseif(session("confirmar.acao") == "cancelar")
                            "<a href='{{ route('cancelar_compra', ['id' => session('confirmar.id')]) }}' class='btn btn-success border border-black focus-ring focus-ring-success'>Confirmar</a>" +
                        @endif
                        @if(session("confirmar.acao") == "resetar")
                            "<a href='{{ route('resetar') }}' class='btn btn-success border border-black focus-ring focus-ring-success'>Confirmar</a>" +
                        @endif
                        "<button id='cancelar' class='btn btn-danger border border-black focus-ring focus-ring-danger'>Desistir</button>" +
                    "</div>",
            didOpen: () => {
                document.getElementById("cancelar")
                    .addEventListener("click", () => Swal.close());
            }
        });
    </script>
@endif