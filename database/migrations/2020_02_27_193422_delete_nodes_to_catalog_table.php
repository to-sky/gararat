<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteNodesToCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nodes_to_catalog');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('nodes_to_catalog', function (Blueprint $table) {
            $table->increments('ntc_id');
            $table->integer('node')->unsigned()->default(0);
            $table->integer('catalog')->unsigned()->default(0);

            $table->foreign('node')->references('id')->on('nodes');
            $table->foreign('catalog')->references('cid')->on('catalog');

            $table->index('node');
            $table->index('catalog');
            $table->index(['node', 'catalog']);
            $table->index(['catalog', 'node']);
        });
    }
}
