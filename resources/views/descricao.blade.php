<table class='table table-bordered'>
    <tr>
        <th>Descricao</th>
    </tr>
    @foreach($prod2 as $p)
    <tr>
        <td>{{ $p }}</td>
    </tr>
    @endforeach
</table>