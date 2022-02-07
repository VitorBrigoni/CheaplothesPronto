<table class='table table-bordered'>
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor</th>
    </tr>
    @foreach($listaItens as $item)
    <tr>
        <td>{{ $item->nome }}</td>
        <td>{{ $item->quantidade }}</td>
        <td>{{ $item->valoritem }}</td>
    </tr>
    @endforeach
</table>