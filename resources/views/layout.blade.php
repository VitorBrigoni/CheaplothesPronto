<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheaplothes - Eccomerce</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
    @yield("scriptjs")
</head>
<body>
    <nav class='navbar navbar-light navbar-expand-md bg-light pl-5 pr-5 mb-5'>
        <a href='#' class='navbar-brand'>Cheaplothes</a>
        <div class='colapse navbar-collapse'>
            <div class='navbar-nav'>
                <a class='nav-link' href="{{ route('home') }}">HOME</a>
                <a class='nav-link' href="{{ route('categoria') }}">Categorias</a>
                <a class='nav-link' href="{{ route('cadastrar') }}">Cadastrar</a>
                @if(!Auth::user())
                    <a class='nav-link' href="{{ route('logar') }}">Logar</a>
                @else
                    <a class='nav-link' href="{{ route('compra_historico') }}">Minhas Compras</a>
                    <a class='nav-link' href="{{ route('sair') }}">Logout</a>
                @endif
            </div>
        </div>
        <a href="{{ route('ver_carrinho') }}" class='btn btn-sm'><i class='fa fa-shopping-cart'></i></a>
    </nav>
    
    <div class='container'>
        <div class='row'>

            @if(Auth::user())  
                <div class='col-12'>
                    <p class='text-right'>Seja bem-vindo, {{Auth::user()->nome}}, <a href="{{ route('sair') }}">sair</a></p>
                </div>
            @endif

            @if($message = Session::get("err"))
                <div class='col-12'>
                    <div class='alert alert-danger'>{{ $message }}</div>
                </div>
            @endif
            @if($message = Session::get("ok"))
                <div class='col-12'>
                    <div class='alert alert-success'>{{ $message }}</div>
                </div>
            @endif
            @yield("conteudo");
        </div>
    </div>
</body>
</html>l