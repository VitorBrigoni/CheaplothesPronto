@extends("layout")
@section("scriptjs")
@endsection
@section("conteudo")

<form>
    <div class='row'>
        <div class='col-4'>
            Cartão de Crédito:
            <input type='text' name='ncredito' class='ncredito form-control'/>
        </div>
        <div class='col-4'>
            CVV:
            <input type='text' name='ncvv' class='ncvv form-control'/>
        </div>
        <div class='col-4'>
            Mês de Expiração:
            <input type='text' name='mesexp' class='mesexp form-control'/>
        </div>
        <div class='col-4'>
            Ano de Expiração:
            <input type='text' name='anoexp' class='anoexp form-control'/>
        </div>
        <div class='col-4'>
            Nome no Cartão:
            <input type='text' name='nomecartao' class='nomecartao form-control'/>
        </div>
        <div class='col-4'>
            Parcelas:
            <input type='text' name='nparcela' class='nparcela form-control'/>
        </div>
        <div class='col-4'>
            Valor Total:
            <input type='text' name='totalfinal' class='totalfinal form-control'/>
        </div>
        <div class='col-4'>
            Valor da Parcela:
            <input type='text' name='totalparcela' class='totalparcela form-control'/>
        </div>
        @csrf
    </div>
    <input type='button' value='Pagar' class='btn btn-lg btn-success pagar'/>
</form>

@endsection