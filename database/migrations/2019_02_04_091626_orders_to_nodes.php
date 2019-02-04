<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersToNodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_to_nodes', function (Blueprint $table) {
            $table->increments('otn_id');
            $table->integer('order')->unsigned()->default(0);
            $table->integer('node')->unsigned()->default(0);
            $table->integer('order_qty')->default(1);

            $table->foreign('order')->references('oid')->on('orders');
            $table->foreign('node')->references('nid')->on('nodes');

            $table->index('order');
            $table->index('node');
            $table->index(['order', 'node']);
            $table->index(['node', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_to_nodes');
    }
}
