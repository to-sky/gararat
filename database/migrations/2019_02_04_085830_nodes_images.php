<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NodesImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes_images', function (Blueprint $table) {
            $table->increments('ni_id');
            $table->integer('node')->unsigned()->default(0);
            $table->string('full_path');
            $table->string('mid_path');
            $table->string('thumb_path');
            $table->integer('is_featured')->default(0);

            $table->foreign('node')->references('nid')->on('nodes');

            $table->index('node');
            $table->index('is_featured');
            $table->index(['node', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes_images');
    }
}
