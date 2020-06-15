<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteNodesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nodes_images');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('nodes_images', function (Blueprint $table) {
            $table->increments('ni_id');
            $table->integer('node')->unsigned()->default(0);
            $table->string('full_path');
            $table->string('mid_path');
            $table->string('thumb_path');
            $table->integer('is_featured')->default(0);

            $table->foreign('node')->references('id')->on('nodes');

            $table->index('node');
            $table->index('is_featured');
            $table->index(['node', 'is_featured']);
        });
    }
}
