@if(session("confirmar"))
    <script>
        Swal.fire({
            title: "{{ strtoupper(session('confirmar.acao')) }}?",
            text: "Tem certeza que deseja {{ session('confirmar.acao') }} esse {{ session('confirmar.acao') == 'comprar' ? 'produto' : 'pedido' }}?",
            icon: "warning",
            background: "#ffc107",
            showConfirmButton: false,
            footer: "<div class='d-flex gap-2'>" +
                        @if(session("confirmar.acao") == "comprar" || session("confirmar.acao") == "aprovar")
                            "<a href='{{ route(session('confirmar.acao'), ['id' => session('confirmar.id'), 'quantidade' => session('confirmar.quantidade')]) }}' class='btn btn-success border border-black focus-ring focus-ring-success'>Confirmar</a>" +
                        @elseif(session("confirmar.acao") == "cancelar")
                            "<a href='{{ route('cancelar_compra', ['id' => session('confirmar.id')]) }}' class='btn btn-success border border-black focus-ring focus-ring-success'>Confirmar</a>" +
                        @endif
                        "<button id='cancelar' class='btn btn-danger border border-black focus-ring focus-ring-danger'>Desistir</button>" +
                    "</div>"
            });
    </script>
@endif