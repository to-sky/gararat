<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NodesToCatalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes_to_catalog', function (Blueprint $table) {
            $table->increments('ntc_id');
            $table->integer('node')->unsigned()->default(0);
            $table->integer('catalog')->unsigned()->default(0);

            $table->foreign('node')->references('nid')->on('nodes');
            $table->foreign('catalog')->references('cid')->on('catalog');

            $table->index('node');
            $table->index('catalog');
            $table->index(['node', 'catalog']);
            $table->index(['catalog', 'node']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes_to_catalog');
    }
}
