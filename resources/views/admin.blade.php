@extends("layouts.main_layout")

@section("content")
    <div class="admin vh-100 gap-3 overflow-auto">
        <div class="d-grid align-items-start gap-3">
            <div class="fundo card shadow">
                <h3 class="card-header text-center">PRODUTOS</h3>
        
                <div class="card-body d-grid gap-3">
                    <form action="{{ route('importar') }}" class="card" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="card-body d-grid">
                            <div class="form-group">
                                <input type="file" class="form-control focus-ring focus-ring-danger" name="arquivo">
                                @error('arquivo')
                                    <div class="form-control bg-danger-subtle">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                                @error('falha_importar')
                                    <div class="form-control bg-danger-subtle">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        @if(session('sucesso_importar'))
                            <div class="form-control bg-success-subtle">
                                <span class="text-success">{{ session('sucesso_importar') }}</span>
                            </div>
                        @endif

                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger w-100">Importar</button>
                        </div>
                    </form>
                    
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route("exportar") }}" class="btn btn-danger border border-black focus-ring focus-ring-danger w-100">Exportar</a>
                            @error('falha_exportar')
                                <div class="form-control bg-danger-subtle">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('novo_produto') }}" id="formulario" class="fundo card shadow h-100" method="POST">
                @csrf

                <div class="card-header text-center">
                    <h3 class="card-title">NOVO PRODUTO</h3>
                </div>            
                <div class="card-body d-grid gap-3">
                    <div class="form-group">
                        <label><i class="bi bi-image"></i> Imagem:</label>
                        <input type="url" class="form-control focus-ring focus-ring-danger" name="imagem" placeholder="https://..." value="{{ old('imagem') }}">
                        @error('imagem')
                            <div class="form-control bg-danger-subtle">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-box-seam"></i> Nome:</label>
                        <input type="text" class="form-control focus-ring focus-ring-danger" name="nome" placeholder="..." value="{{ old('nome') }}">
                        @error('nome')
                            <div class="form-control bg-danger-subtle">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-file-earmark-text"></i> Descrição:</label>
                        <textarea class="form-control focus-ring focus-ring-danger" rows="4" name="descricao" placeholder="...">{{ old('descricao') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-cash-stack"></i> Preço:</label>
                        <input type="text" class="form-control focus-ring focus-ring-danger" name="preco" placeholder="000,00" value="{{ old('preco') }}">
                        @error('preco')
                            <div class="form-control bg-danger-subtle">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-cash-coin"></i> Desconto:</label>
                        <input type="number" class="form-control focus-ring focus-ring-danger" name="desconto" placeholder="00" value="{{ old('desconto') }}">
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-boxes"></i> Estoque:</label>
                        <input type="number" class="form-control focus-ring focus-ring-danger" name="estoque" placeholder="000" value="{{ old('estoque') }}">
                        @error('estoque')
                            <div class="form-control bg-danger-subtle">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="bi bi-pen"></i> Categoria:</label>
                        <select class="form-control focus-ring focus-ring-danger" name="categoria">
                            <option value="Selecione" selected>Selecione a categoria...</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old("categoria") == "$categoria->id" ? "selected" : "" }}>{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                        @error('categoria')
                            <div class="form-control bg-danger-subtle">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
                @error('existe')
                    <div class="form-control bg-danger-subtle">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
                @session('sucesso')
                    <div class="form-control bg-success-subtle">
                        <span class="text-success">{{ session("sucesso") }}</span>
                    </div>
                @endsession

                <div class="card-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary border border-black focus-ring focus-ring-secondary" onclick="limparCampos()">Limpar</button>
                    <button type="submit" class="btn btn-danger border border-black focus-ring focus-ring-danger">Salvar</button>
                </div>
            </form>
        </div>

        <div class="fundo card shadow overflow-auto">
            <h3 class="card-header text-center">PEDIDOS</h3>
            <div class="overflow-auto pt-3">
                <table class="table table-bordered table-warning table-hover border border-black text-center shadow">
                    <thead class="table-dark border border-bottom-0 border-black">
                        <tr>
                            <th scope="col"><span class="fs-5 fw-bold">Nº</span></th>
                            <th scope="col"><span class="fs-5 fw-bold">Cliente</span></th>
                            <th scope="col"><span class="fs-5 fw-bold">Produto</span></th>
                            <th scope="col"><span class="fs-5 fw-bold">Valor(R$)</span></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($pedidos as $pedido)
                            <tr>
                                <th scope="row" class="align-content-center">{{ $loop->index + 1 }}</th>
                                <td class="align-content-center">{{ $pedido->user->name }}</td>
                                <td class="align-content-center">{{ $pedido->produto->nome }}</td>
                                <td class="align-content-center">{{ number_format($pedido->valor, 2, ",") }}</td>
                                <td class="align-middle">
                                    <div class="admin gap-1">
                                        <a href="{{ route("confirmar_cancelar", ["id" => Crypt::encrypt($pedido->id)]) }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">Cancelar</a>
                                        <a href="{{ route("confirmar_aprovar", ["id" => Crypt::encrypt($pedido->id)]) }}" class="btn btn-success border border-black focus-ring focus-ring-success">Aprovar</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">Nenhum pedido feito no momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection