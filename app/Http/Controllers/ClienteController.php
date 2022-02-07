<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Endereco;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    public function cadastrar(Request $request){
        $data = [];

        return view("cadastrar", $data);
    }

    public function cadastrarCliente(Request $request){

        $values = $request->all();
        $usuario = new Usuario();
        $usuario->fill($values);
        $usuario->login = $request->input('cpf', '');    

        $senha = $request->input("password", '');
        $usuario->password = Hash::make($senha); //Criptografia da senha

        $endereco = new Endereco($values);
        $endereco->logradouro = $request->input('endereco', ''); 
        
        $clienteService = new ClienteService();
        $result = $clienteService->salvarUsuario($usuario, $endereco);

        $message = $result['message'];
        $status = $result['status'];

        $request->session()->flash($status, $message);//Seleciona pelo status qual mensagem vai ser gravada
        
        return redirect()->route("cadastrar");
    }
}
