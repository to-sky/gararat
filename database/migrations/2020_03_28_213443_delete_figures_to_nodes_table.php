<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFiguresToNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('figures_to_nodes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('figures_to_nodes', function (Blueprint $table) {
            $table->increments('fig_nid_id');
            $table->integer('node')->unsigned()->default(0);
            $table->integer('figure')->unsigned()->default(0);
            $table->string('pos_x');
            $table->string('pos_y');
            $table->string('size_x');
            $table->string('size_y');

            $table->foreign('node')->references('id')->on('nodes');
            $table->foreign('figure')->references('fig_id')->on('figures');

            $table->index(['figure', 'node']);
        });
    }
}
