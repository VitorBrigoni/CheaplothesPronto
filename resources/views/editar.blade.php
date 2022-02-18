@extends("layout")
@section("conteudo")
<div class='col-12'>
            <h2 class='mb-3'>Editar Produto</h2>
        </div>
<form action="{{ route('produtos_update', $prod) }}" method='post' enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class='row'>
                <div class='col-6'>
                    <div class='form-group'>
                        Nome Produto: <input type='text' required="" value='{{ $prod->nome }}' name='nome' class='form-control'/>
                    </div>
                </div>

                <div class='col-6'>
                    <div class='form-group'>
                        Valor: <input type='number' required="" value='{{ $prod->valor }}' name='valor' class='form-control'/>
                    </div>
                </div>

                <div class='col-6'>
                    <div class='form-group'>
                        Foto Nova: <input type='file' value='{{$prod->foto}}' name='foto' class='form-control'/>
                        Foto Antiga:
                        <img src="{{'../../img/'.$prod->foto}}" alt='foto antiga'/>
                    </div>
                </div>
                <div class='col-3'> 
                    <div class='form-group'>
                        Descrição: <br><textarea required="" name='descricao' class="">{{ $prod->descricao }}</textarea>
                    </div>
                </div>
                <div class='col-3'>
                    <div class='form-group'>
                        Categoria:<br>
                        <select class="form-group" name='categoria_id' required="">
                            <option value="Escolha" disabled>Escolha...</option>
                            @if($prod->categoria_id == 2)
                                <option selected value="2">Tênis</option>
                                <option value="3">Camisetas</option>
                                <option value="4">Calças</option>
                                <option value="5">Calções</option>
                            @elseif($prod->categoria_id == 3)
                                <option value="2">Tênis</option>
                                <option selected value="3">Camisetas</option>
                                <option value="4">Calças</option>
                                <option value="5">Calções</option>
                            @elseif($prod->categoria_id == 4)
                                <option value="2">Tênis</option>
                                <option value="3">Camisetas</option>
                                <option selected value="4">Calças</option>
                                <option value="5">Calções</option>
                            @else
                                <option value="5">Calções</option>
                                <option value="3">Camisetas</option>
                                <option value="4">Calças</option>
                                <option selected value="5">Calções</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
                <input type='submit' value='Editar Produto' class='btn btn-success btn-lg'/>
        </form>
@endsection