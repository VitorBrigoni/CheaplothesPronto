@if(isset($lista))
    <div class='row'>
        @foreach($lista as $prod)
            <div class='mb-3 mr-4 d-flex align-items-stretch'>
                <div class='card'>
                    <img src="{{'../img/'.$prod->foto}}" class='' height='267' width='263'/>
                    <div class='card-body'>
                        <h6 class='card-title'>{{ $prod->nome }} - R$ {{$prod->valor}}</h6>
                        @if(Auth::user())
                            <a href="{{ route('adicionar_carrinho', ['idproduto' => $prod->id]) }}" class='btn btn-sm btn-secondary'>Adicionar Item</a>
                            <a href="{{ route('produtos_edit', $prod) }}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-pen"></i></a>
                            <a href="{{ route('produtos_remove', $prod) }}" class="btn btn-danger btn-sm" role="button"><i class="fa fa-trash"></i></a>
                            <a href="#" class="btn btn-sm btn-info infocompra" data-bs-value="{{ $prod->descricao }}" data-bs-toggle="modal" data-bs-target="#modalcompra{{ $prod->id }}">
                                <i class='fa fa-list'></i>
                            </a>
                        @else
                            <a class='btn btn-sm btn-secondary' href="{{ route('logar') }}">Logue para começar a comprar</a>
                        @endif

                        <div class="modal fade" id="modalcompra{{$prod->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Descrição do Produto</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div id='conteudopedido'>
                                            <h8 class="modal-title">{{ $prod->descricao }}</h8>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type='button' class='btn btn-sm btn-secondary' data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif