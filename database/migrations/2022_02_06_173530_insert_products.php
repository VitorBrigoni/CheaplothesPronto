<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cat = new \App\Models\Categoria(['categoria' => 'Geral']);
        $cat->save();


        $prod = new \App\Models\Produto(['nome' => 'Tênis Branco', 'valor' => 199.00, 'foto' => 'images/produto1.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod->save();

        $prod2 = new \App\Models\Produto(['nome' => 'Camiseta Branca', 'valor' => 289.00, 'foto' => 'images/produto2.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod2->save();

        $prod3 = new \App\Models\Produto(['nome' => 'Camiseta Preta', 'valor' => 99.00, 'foto' => 'images/produto3.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod3->save();

        $prod4 = new \App\Models\Produto(['nome' => 'Calça Jeans', 'valor' => 149.00, 'foto' => 'images/produto4.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod4->save();

        $prod5 = new \App\Models\Produto(['nome' => 'Calça Preta Rasgada', 'valor' => 99.00, 'foto' => 'images/produto5.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod5->save();

        $prod6 = new \App\Models\Produto(['nome' => 'Calção Praiana', 'valor' => 129.00, 'foto' => 'images/produto6.jpg', 'descricao' => '', 'categoria_id' => $cat->id]);
        $prod6->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
