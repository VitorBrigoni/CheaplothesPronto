<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function logar(Request $request){
        $data = [];
        
        if($request->isMethod("POST")){
            $login = $request->input("login");
            $senha = $request->input("senha");

            $login = preg_replace('/[^0-9]/', "", $login);

            $credential = [ 'login' => $login, 'password' => $senha ];
            if(Auth::attempt($credential)){
                return redirect()->route("home");
            }else{
                $request->session()->flash("err", "Usuário / Senha inválido");
                return redirect()->route("logar");
            }
        }
        
        return view("logar", $data);
    }

    public function sair(Request $request){
        Auth::logout();
        return redirect()->route("home");
    }   
}
