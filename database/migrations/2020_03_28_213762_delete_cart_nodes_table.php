<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteCartNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cart_nodes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('cart_nodes', function (Blueprint $table) {
            $table->increments('cart_nodes_id');
            $table->integer('cart')->unsigned()->default(0);
            $table->integer('node')->unsigned()->default(0);
            $table->integer('order_qty')->default(1);

            $table->foreign('cart')->references('cart_id')->on('cart');
            $table->foreign('node')->references('id')->on('nodes');

            $table->index('cart');
            $table->index(['cart', 'node']);
            $table->index(['node', 'cart']);
        });
    }
}
