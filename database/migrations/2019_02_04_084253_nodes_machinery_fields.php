<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NodesMachineryFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes_machinery_fields', function (Blueprint $table) {
            $table->increments('nmf_id');
            $table->integer('node')->unsigned()->default(0);

            $table->foreign('node')->references('nid')->on('nodes');

            $table->index('node');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes_machinery_fields');
    }
}
