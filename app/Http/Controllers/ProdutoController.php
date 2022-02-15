<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\ItensPedido;
use App\Models\Produto;
use App\Services\VendaService;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

use PagSeguro\Configuration\Configure;

class ProdutoController extends Controller
{

     private $_configs;

     public function __construct(){
         $this->_configs = new Configure();                                                   
         $this->_configs->setCharset("UTF-8");
         $this->_configs->setAccountCredentials(env('PAGSEGURO_EMAIL'), env('PAGSEGURO_TOKEN'));
         $this->_configs->setEnvironment(env("PAGSEGURO_AMBIENTE"));
         $this->_configs->setLog(true, storage_path('logs/pagseguro_' . date('Ymd') . '.log'));
     }

    public function getCredential(){
        return $this->_configs->getAccountCredentials();
    }

    

    public function index(Request $request){
        $data = [];

        $listaProdutos = Produto::all(); //Faz o papel do select *
        $data["lista"] = $listaProdutos;

        return view("home", $data);
    }

    public function categoria($idcategoria = 0, Request $request){
        $data = [];

        //select de categorias
        $listaCategorias = Categoria::all();
        //select de produtos
        $queryProduto = Produto::limit(99);

        if($idcategoria != 0){
            $queryProduto->where("categoria_id", $idcategoria);
        }

        $listaProdutos = $queryProduto->get();

        $data['lista'] = $listaProdutos;
        $data["listaCategoria"] = $listaCategorias;
        $data["idcategoria"] = $idcategoria;
        return view("categoria", $data);
    }

    public function adicionarCarrinho($idProduto = 0, Request $request){ 
        $prod = Produto::find($idProduto);

        if($prod){
            $carrinho = session('cart', []);

            array_push($carrinho, $prod);
            session([ 'cart' => $carrinho ]);
        }

        return redirect()->route("home");
    }

    public function verCarrinho(Request $request){
        $carrinho = session('cart', []);
        $data = ['cart' => $carrinho];

        return view("carrinho", $data);
    }

    public function excluirCarrinho($indice, Request $request){
        $carrinho = session('cart', []);
        if(isset($carrinho[$indice])){
            unset($carrinho[$indice]);
        }
        session(['cart' => $carrinho]);
        return redirect()->route("ver_carrinho");
    }

    public function finalizar(Request $request){
        $prods = session('cart', []);
        $vendaService = new VendaService();
        $result = $vendaService->finalizarVenda($prods, Auth::user());

        if($result['status'] == 'ok'){
            $request->session()->forget('cart');

            $credCard = new \Pagseguro\Domains\Requests\DirectPayment\CreditCard();
            $credCard->setReference("PED_" . $result["idpedido"]);
            $credCard->setCurrency("BRL");

            foreach($prods as $p){
                $credCard->addItems()->withParameters(
                    $p->id,
                    $p->nome,
                    1,
                    number_format($p->valor, 2, ".", "")
                );
            }

            $user = Auth::user();

            $credCard->setSender()->setName($user->nome . " " . $user->nome);
            //$credCard->setSender()->setEmail($user->email);
            $credCard->setSender()->setName($user->login . "@sandbox.pagseguro.com.br");
            $credCard->setSender()->setHash($request->input("hashseller"));
            $credCard->setSender()->setPhone()->withParameters(54, 999240599);
            $credCard->setSender()->setDocument()->withParameters("CPF", $user->login);

            $credCard->setShipping()->setAddress()->withParameters(
                'Av. A',
                '1234',
                'Jardim Botanico',
                '22775554',
                'Rio de Janeiro',
                'RJ',
                'BRA',
                'Apto. 100'
            );
            $credCard->setBilling()->setAddress()->withParameters(
                'Av. A',
                '1234',
                'Jardim Botanico',
                '22775554',
                'Rio de Janeiro',
                'RJ',
                'BRA',
                'Apto. 100'
            );

            $credCard->setToken($request->input("cardtoken"));

            $nparcela = $request->input("nparcela");
            $totalapagar = $request->input("totalapagar");
            $totalparcela = $request->input("totalparcela");

            $credCard->setInstallment()->withParameters($nparcela, number_format($totalparcela, 2, ".", ""));

            $credCard->setHolder()->setName($user->nome . " " . $user->nome);
            $credCard->setHolder()->setDocument()->withParameters("CPF", $user->login);
            $credCard->setHolder()->setBirthdate("01/01/1980");
            $credCard->setHolder()->setPhone()->withParameters(54, 999240599);

            $credCard->setMode("DEFAULT");
            $result = $credCard->register($this->getCredential());

            echo("Compra realizada com sucesso");

        }else{
            echo("Compra não realizada");
        }

        //$request->session()->flash($result['status'], $result['message']);
        //return redirect()->route("ver_carrinho");
    }

    public function historico(Request $request){
        $data = [];

        $idusuario = Auth::user()->id;

        $listaPedido = Pedido::where("usuario_id", $idusuario)->orderBy("datapedido", "desc")->get();
        $data['lista'] = $listaPedido;

        return view("compra/historico", $data);
    }

    public function detalhes(Request $request){
        $idpedido = $request->input("idpedido");
        
        $listaItens = ItensPedido::join("produtos", "produtos.id", "=", "itens_pedidos.produto_id")->where("pedido_id", $idpedido)->get(['itens_pedidos.*', 'itens_pedidos.valor as valoritem', 'produtos.*' ]);
        
        $data = [];
        $data["listaItens"] = $listaItens;
        return view("compra/detalhes", $data);
    }

     public function pagar(Request $request){
          $data = [];
          $carrinho = session('cart', []);
          $data['cart'] = $carrinho;

          $sessionCode = \PagSeguro\Services\Session::create(          //FUNÇÃO PAGAR QUE UTILIZARIA A PARTE LA DE CIMA
             $this->getCredential()
          );
          $IDSession = $sessionCode->getResult();
         $data['sessionID'] = $IDSession;

         return view("compra/pagar", $data);
     }
}
