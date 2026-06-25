@extends("layouts.main_layout")

@section("content")
    <div class="d-grid gap-3 vh-100">
        <div class="fundo shadow overflow-auto">
            <h4 class="bg-warning border border-black text-white mb-1">
                <i class="bi bi-repeat ms-1"></i>
                <span class="fw-bold">PENDENTES:</span>
            </h4>
            <div class="overflow-auto">
                <table class="table table-bordered table-warning table-hover border border-black text-center shadow">
                    <thead class="table-dark border border-bottom-0 border-black">
                        <tr>
                            <th scope="col" class="numero bg-warning"><span class="fs-5 fw-bold">Nº</span></th>
                            <th scope="col" class="bg-warning"><span class="fs-5 fw-bold">Produto</span></th>
                            <th scope="col" class="bg-warning"><span class="fs-5 fw-bold">Valor(R$)</span></th>
                            <th scope="col" class="bg-warning"><span class="fs-5 fw-bold">Data/Hora</span></th>
                            <th scope="col" class="bg-warning"><span class="fs-5 fw-bold">QRCode</span></th>                    
                            <th scope="col" class="bg-warning"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider border-top-0">
                        @forelse ($compras as $compra)
                            <tr>
                                <th scope="row" class="align-content-center">{{ $loop->index + 1 }}</th>
                                <td class="align-content-center">{{ $compra->produto->nome }}</td>
                                <td class="align-content-center">{{ $compra->valor_formatado }}</td>
                                <td class="align-content-center">{{ $compra->data_compra }}</td>
                                <td class="align-content-center"><a href="{{ route("qrcode", ["id" => $compra->id_crypt]) }}" class="btn btn-warning border border-black focus-ring focus-ring-warning"><i class="bi bi-qr-code-scan"></i></a></td>
                                <td class="align-content-center"><a href="{{ route("confirmar.cancelar", ["id" => $compra->id_crypt]) }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">Cancelar</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">Nenhuma compra realizada no momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    
        <div class="fundo shadow overflow-auto">
            <h4 class="bg-warning border border-black text-white mb-1">
                <i class="bi bi-check-circle ms-1"></i>
                <span class="fw-bold">CONCLUÍDOS:</span>
            </h4>
            <div class="overflow-auto">
                <table class="table table-bordered table-warning table-hover border border-black text-center shadow">
                    <thead class="table-dark border border-bottom-0 border-black">
                        <tr>
                            <th scope="col" class="numero bg-warning"><span class="fs-5 fw-bold">Nº</span></th>
                            <th scope="col" class="bg-warning"><span class="fs-5 fw-bold">Produto</span></th>
                            <th scope="col" class="bg-warning"><span class="fs-5 fw-bold">Valor(R$)</span></th>
                            <th scope="col" class="bg-warning"><span class="fs-5 fw-bold">Data/Hora</span></th>
                            <th scope="col" class="bg-warning"><span class="fs-5 fw-bold">Status</span></th>
                            <th scope="col" class="bg-warning"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider border-top-0">
                        @forelse ($concluidos as $concluido)
                            <tr>
                                <th scope="row" class="align-content-center">{{ $loop->index + 1 }}</th>
                                <td class="align-content-center">{{ $concluido->produto->nome }}</td>
                                <td class="align-content-center">{{ $concluido->valor_formatado }}</td>
                                <td class="align-content-center">{{ $concluido->data_efetuacao }}</td>
                                <td class="align-content-center"><span class="badge text-bg-{{ $concluido->status === \App\Enums\CompraStatus::CANCELADO ? "danger" : "success" }} fs-5">{{ $concluido->status }}</span></td>
                                <td class="align-content-center">
                                    <form action="{{ route("apagar", ["id" => $concluido->id_crypt]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
        
                                        <button type="submit" class="btn btn-outline-danger border border-black focus-ring focus-ring-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="6">Nenhuma compra concluída no momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection