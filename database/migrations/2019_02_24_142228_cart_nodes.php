<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CartNodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_nodes', function (Blueprint $table) {
            $table->increments('cart_nodes_id');
            $table->integer('cart')->unsigned()->default(0);
            $table->integer('node')->unsigned()->default(0);
            $table->integer('order_qty')->default(1);

            $table->foreign('cart')->references('cart_id')->on('cart');
            $table->foreign('node')->references('nid')->on('nodes');

            $table->index('cart');
            $table->index(['cart', 'node']);
            $table->index(['node', 'cart']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_nodes');
    }
}
