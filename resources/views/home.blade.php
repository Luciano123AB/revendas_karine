@extends("layouts.main_layout")

@section("content")
    <h1 class="card-title d-flex flex-wrap align-items-center gap-1 mb-1 mt-5">
        <div class="me-2">
            <i class="bi bi-box-seam-fill"></i>
            <span>TODOS OS PRODUTOS:</span>
        </div>

        <div class="btn-group">
            <div class="fundo d-grid btn btn-warning border border-black">
                <span class="text-white fs-5 overflow-auto">Categoria: {{ $categoria . " (" . $total . ")" }}</span>
            </div>
            <button type="button" class="dropdown-toggle fundo btn btn-lg btn-warning border border-black focus-ring focus-ring-warning" data-bs-toggle="dropdown" aria-expanded="false"></button>
            <ul class="dropdown-menu dropdown-menu-end fundo">
                <div class="border-bottom border-warning"></div>
                @if ($categoria != "Todos")
                    <li class="fundo">
                        <a href="{{ route("home", ["categoria" => "Todos"]) }}" class="dropdown-item btn btn-warning border-bottom border-warning focus-ring focus-ring-warning">Todos</a>
                    </li>
                @endif
                @foreach ($categorias as $categoria)
                    <li class="fundo">
                        <a href="{{ route("home", ["categoria" => $categoria->nome]) }}" class="dropdown-item btn btn-warning border-bottom border-warning focus-ring focus-ring-warning">{{ $categoria->nome }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </h1>
    <div class="vh-100 mb-5">
        <div class="@if ($total > 0) produtos overflow-auto @endif d-grid gap-3">
            @forelse ($produtos as $produto)
                <div class="fundo card shadow">
                    <img src="{{ $produto->imagem == null ? asset("assets/images/icons/icone_produtos.png") : "$produto->imagem" }}" class="card-img-top {{ $produto->imagem == null ? "bg-warning" : "bg-white p-3" }} w-100" height="200">
                    <h5 class="card-header text-center">{{ $produto->nome }}</h5>

                    <div class="card-body align-content-center">
                        @if ($produto->desconto > 0)
                            <p class="text-decoration-line-through m-0">R$ {{ $produto->preco_base }}</p>
                        @endif
                        <h4 class="card-text">R$ {{ $produto->preco_formatado }}
                            @if ($produto->desconto > 0)
                                <span class="bg-success fs-5">-{{ $produto->desconto }}%</span>
                            @endif
                        </h4>
                    </div>

                    <div class="card-footer text-center">
                        @if ($produto->estoque > 0)
                            @if (!Auth::user()?->permissao)
                                <a href="{{ route('escolher', ["id" => $produto->id_crypt]) }}" class="btn btn-danger border border-black focus-ring focus-ring-danger">ESCOLHER</a>
                            @endif
                        @else
                            @if (!Auth::user()?->permissao)
                                <button class="btn btn-secondary border border-black" disabled>ESGOTADO</button>
                            @endif
                        @endif
                    </div>
                </div>
            @empty
                <div id="nenhum_produto">
                    <div class="card bg-light shadow text-center p-1">
                        <h4 class="card-title">Nenhuma produto disponível no momento. Volte mais tarde!</h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection