@extends("layouts.main_layout")

@section("content")
    <div class="fundo vh-100 my-5 shadow overflow-auto">
        <table class="table table-bordered table-warning table-hover border border-black text-center shadow">
            <thead class="table-dark border border-bottom-0 border-black">
                <tr>
                    <th scope="col"><span class="fs-5 fw-bold">Nº</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">Produto</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">Valor(R$)</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">Data/Hora</span></th>
                    <th scope="col"><span class="fs-5 fw-bold">Status</span></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($compras as $compra)
                    <tr>
                        <th scope="row" class="align-content-center">{{ $loop->index + 1 }}</th>
                        <td class="align-content-center">{{ $compra->produto }}</td>
                        <td class="align-content-center">{{ number_format($compra->valor, 2, ",") }}</td>
                        <td class="align-content-center">{{ $compra->data_efetuacao }}</td>
                        <td class="align-content-center"><span class="badge text-bg-{{ $compra->status == "Cancelado" ? "danger" : "success" }} fs-5">{{ $compra->status }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="5">Nenhuma compra feita no momento.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
