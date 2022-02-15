@extends("layout")
@section("scriptjs")
    <script>
        $(function(){
            $(".infocompra").on('click', function(){
                let id = $(this).attr("data-bs-value")
                $.post('{{ route("compra_detalhes") }}', { idpedido : id }, (result) => {//realiza a consulta recebendo o id do pedido para saber qual pedido esta sendo consultado
                    $("#conteudopedido").html(result)//faz a função do callback 
                })
            })
        })
    </script>
@endsection
@section("conteudo")

    
    <div class='col-12'>
        <h2>Minhas Compras</h2>
    </div>

    <div class='col-12'>
        <table class='table tabled-bordered'> 
            <tr>
                <th>Data da Compra</th>
                <th>Situação</th>
                <th>Detalhes</th>
            </tr>
            @foreach($lista as $ped)
                <tr>
                    <td>{{ $ped->datapedido->format("d/m/Y H:i") }}</td>
                    <td>{{ $ped->statusDesc() }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info infocompra" data-bs-value="{{ $ped->id }}" data-bs-toggle="modal" data-bs-target="#modalcompra">
                            <i class='fa fa-shopping-basket'></i>
                        </a>
                    </td>   
                </tr>
            @endforeach

        </table>
    </div>
    <!-- Aqui utilizei do js modal do bootstrap, porque pesquisei e achei o jeito mais interessante -->
    <div class="modal fade" id="modalcompra">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes da Compra</h5>
                </div>
                <div class="modal-body">
                    <div id='conteudopedido'>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type='button' class='btn btn-sm btn-secondary' data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

@endsection