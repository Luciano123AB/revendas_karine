@extends("layouts.main_layout")

@section("content")
    <div class="vh-100 my-5">
        <table class="table table-bordered table-hover border border-black text-center shadow">
            <thead>
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data/Hora</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pedidos as $pedido)
                    <tr>
                        <th scope="row" class="align-content-center">{{ $loop->index + 1 }}</th>
                        <td class="align-content-center">{{ $pedido->produto }}</td>
                        <td class="align-content-center">{{ $pedido->valor }}</td>
                        <td class="align-content-center">{{ $pedido->data_compra }}</td>
                        <td class="align-content-center"><button class="btn btn-secondary" disabled>{{ $pedido->status }}</button></td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="5">Nenhum pedido feito no momento.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
