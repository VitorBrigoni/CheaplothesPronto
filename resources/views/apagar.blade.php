@extends("layout")
@section("conteudo")
<div class="row">
    <div class="col">

        <div class="alert alert-danger" role="alert">
            <i class="fa fa-exclamation-triangle-fill"></i>
            <strong>Cuidado!</strong> Você está prestes a remover o produto!
        </div>

        <p>Produto: {{$prod->nome}}</p>
        <p>Você tem certeza que deseja apagar este produto para sempre?</p>

        <form method="post" action="{{ route('produtos_delete', $prod) }}">
            @csrf
            @method('delete')
            
            <input type="submit" class="btn btn-danger" value="Manda braza meu patrão">
            <a href="{{ route('home') }}" class="btn btn-secondary">Desculpa, eu cliquei errado!</a>
        </form>

        

    </div>
</div>
@endsection