<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteOrdersToNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('orders_to_nodes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('orders_to_nodes', function (Blueprint $table) {
            $table->increments('otn_id');
            $table->integer('order')->unsigned()->default(0);
            $table->integer('node')->unsigned()->default(0);
            $table->integer('order_qty')->default(1);

            $table->foreign('order')->references('id')->on('orders');
            $table->foreign('node')->references('id')->on('nodes');

            $table->index('order');
            $table->index('node');
            $table->index(['order', 'node']);
            $table->index(['node', 'order']);
        });
    }
}
