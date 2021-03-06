<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], '/', [ProdutoController::class, 'index'])->name('home');

Route::match(['get', 'post'], '/categoria', [ProdutoController::class, 'categoria'])->name('categoria');

Route::match(['get', 'post'], '/{idcategoria}/categoria', [ProdutoController::class, 'categoria'])->name('categoria_por_id');

Route::match(['get', 'post'], '/cadproduto', [ProdutoController::class, 'cadProduto'])->name('cad_produto');

Route::match(['get', 'post'], '/produto/cadproduto', [ProdutoController::class, 'cadastrarProduto'])->name('cadastrar_produto');

Route::get('/produtos/{prod}/editar', [ProdutoController::class, 'edit'])->name('produtos_edit');

Route::put('/produtos/{prod}/editar', [ProdutoController::class, 'update'])->name('produtos_update');

Route::get('/produtos/{prod}/apagar', [ProdutoController::class, 'remove'])->name('produtos_remove');

Route::delete('/produtos/{prod}/apagar', [ProdutoController::class, 'delete'])->name('produtos_delete');





Route::match(['get', 'post'], '/cadastrar', [ClienteController::class, 'cadastrar'])->name('cadastrar');

Route::match(['get', 'post'], '/cliente/cadastrar', [ClienteController::class, 'cadastrarCliente'])->name('cadastrar_cliente');

Route::match(['get', 'post'], '/logar', [UsuarioController::class, 'logar'])->name('logar');

Route::get('/sair', [UsuarioController::class, 'sair'])->name('sair');



Route::match(['get', 'post'], '/{idproduto}/carrinho/adicionar', [ProdutoController::class, 'adicionarCarrinho'])->name('adicionar_carrinho');

Route::match(['get', 'post'], '/carrinho', [ProdutoController::class, 'verCarrinho'])->name('ver_carrinho');

Route::match(['get', 'post'], '/{indice}/excluircarrinho', [ProdutoController::class, 'excluirCarrinho'])->name('carrinho_excluir');

Route::post('/carinho/finalizar', [ProdutoController::class, 'finalizar'])->name('carrinho_finalizar');

Route::match(['get', 'post'], '/compras/historico', [ProdutoController::class, 'historico'])->name('compra_historico');

Route::post('/compras/detalhes', [ProdutoController::class, 'detalhes'])->name('compra_detalhes');

Route::match(['get', 'post'], '/compras/pagar', [ProdutoController::class, 'pagar'])->name('pagar');