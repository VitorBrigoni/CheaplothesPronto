<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Endereco;

class ClienteService {

    public function salvarUsuario(Usuario $user, Endereco $endereco){
        try{
            $dbUsuario = Usuario::where("login", $user->login)->first();//Basicamente verifica se existe
            if($dbUsuario){
                return ['status' => 'err', 'message' => 'Login já cadastrado no sistema'];
            }

            DB::beginTransaction();;// Utilizei para informa que iniciou a transacao
            $user->save();//salva
            $endereco->usuario_id = $user->id;//Relaciona
            $endereco->save();//salva
            DB::commit(); // Aqui dai confirma a transacao

            return ['status' => 'ok', 'message' => 'Usuario Cadastrado com sucesso!'];

        }catch(\Exception $e){
            Log::error("ERRO", ['file' => 'ClienteService.salvarUsuario', 'message' => $e->getMessage()]);
            DB::rollback(); // Cancela a transacao
            return ['status' => 'err', 'message' => 'Não pode cadastrar o usuário'];
        }
    }

}