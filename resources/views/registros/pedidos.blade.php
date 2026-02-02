@extends("layouts.main_layout")

@section("content")
    <div class="fundo vh-100 shadow overflow-auto">
        <table class="table table-bordered table-warning table-hover border border-black text-center shadow">
            <thead class="table-dark border border-bottom-0 border-black">
                <tr>
                    <th scope="col"><span class="fs-5 fw-bold">Nº</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">Produto</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">Valor(R$)</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">Data/Hora</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">Status</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">QRCode</span></th>                    
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($pedidos as $pedido)
                    <tr>
                        <th scope="row" class="align-content-center">{{ $loop->index + 1 }}</th>
                        <td class="align-content-center">{{ $pedido->produto->nome }}</td>
                        <td class="align-content-center">{{ number_format($pedido->valor, 2, ",") }}</td>
                        <td class="align-content-center">{{ $pedido->data_compra }}</td>
                        <td class="align-content-center"><span class="badge text-bg-secondary fs-5">{{ $pedido->status }}</span></td>
                        <td class="align-content-center"><a href="{{ route("qrcode", ["id" => Crypt::encrypt($pedido->id)]) }}" class="btn btn-warning border border-black focus-ring focus-ring-warning"><i class="bi bi-qr-code-scan"></i></a></td>
                        <td class="align-content-center"><a href="{{ route("confirmar_cancelar", ["id" => Crypt::encrypt($pedido->id)]) }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">Cancelar</a></td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="7">Nenhum pedido feito no momento.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection