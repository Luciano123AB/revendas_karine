@if(session("confirmar.acao") == "comprar" || session("confirmar.acao") == "aprovar")
    <form action='{{ route(session('confirmar.acao'), ['id' => session('confirmar.id'), 'quantidade' => session('confirmar.quantidade')]) }}' id='formulario_confirmacao' method='POST'>
        @csrf
    </form>
@elseif(session("confirmar.acao") == "cancelar")
    <form action='{{ route('cancelar_compra', ['id' => session('confirmar.id')]) }}' id='formulario_confirmacao' method='POST'>
        @csrf
        @method('DELETE')
    </form>
@endif
@if(session("confirmar.acao") == "resetar")
    <form action='{{ route('resetar') }}' id='formulario_confirmacao' method='POST'>
        @csrf
        @method('DELETE')
    </form>
@else
    <form action='{{ route('deletar_conta') }}' id='formulario_confirmacao' method='POST'>
        @csrf
        @method('DELETE')
    </form>
@endif