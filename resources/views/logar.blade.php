@extends("layout")
@section("scriptjs")
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function(){
            $("#cpf").mask("000.000.000-00")
        })
    </script>
@endsection
@section("conteudo")
    <div class='col-12'>
        <h2 class='mb-3'>Logar no Sistema</h2>

        <form action="{{ route('logar') }}" method='post' class='mb-3'>
            @csrf
            <div class='form-group'>
                CPF:<input type='text' name='login' id='cpf' class='form-control' placeholder='Insira seu CPF'/>
            </div>

            <div class='form-group'>
                Senha:<input type='password' name='senha' class='form-control' placeholder='Insira sua senha'/>
            </div>
            
            <input type='submit' value='Logar' class='btn btn-lg btn-primary'/>
        </form>
        <label class='mb-3'>Não tem conta? </label>
        <a class='' href="{{ route('cadastrar') }}">Cadastrar</a>
    </div>
@endsection