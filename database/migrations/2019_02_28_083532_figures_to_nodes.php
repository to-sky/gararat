<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FiguresToNodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('figures_to_nodes', function (Blueprint $table) {
            $table->increments('fig_nid_id');
            $table->integer('node')->unsigned()->default(0);
            $table->integer('figure')->unsigned()->default(0);
            $table->string('pos_x');
            $table->string('pos_y');

            $table->foreign('node')->references('nid')->on('nodes');
            $table->foreign('figure')->references('fig_id')->on('figures');

            $table->index(['figure', 'node']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('figures_to_nodes');
    }
}
