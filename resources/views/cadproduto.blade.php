@extends("layout")
@section("conteudo")
<div class='col-12'>
            <h2 class='mb-3'>Cadastrar Produto</h2>
        </div>
<form action="{{ route('cadastrar_produto') }}" method='post' enctype="multipart/form-data">
            @csrf
            <div class='row'>
                <div class='col-6'>
                    <div class='form-group'>
                        Nome Produto: <input type='text' required="" name='nome' class='form-control'/>
                    </div>
                </div>

                <div class='col-6'>
                    <div class='form-group'>
                        Valor: <input type='number' required="" name='valor' class='form-control'/>
                    </div>
                </div>

                <div class='col-6'>
                    <div class='form-group'>
                        Foto: <input type='file' required="" name='foto' class='form-control'/>
                    </div>
                </div>
                <div class='col-3'> 
                    <div class='form-group'>
                        Descrição: <br><textarea required="" name='descricao' class=""></textarea>
                    </div>
                </div>
                <div class='col-3'>
                    <div class='form-group'>
                        Categoria:<br>
                        <select class="form-group" name='categoria_id' required="">
                            <option value="Escolha" selected disabled>Escolha...</option>
                            <option value="2">Tênis</option>
                            <option value="3">Camisetas</option>
                            <option value="4">Calças</option>
                            <option value="5">Calções</option>
                        </select>
                    </div>
                </div>
            </div>
                <input type='submit' value='Cadastrar Produto' class='btn btn-success btn-lg'/>
        </form>
@endsection