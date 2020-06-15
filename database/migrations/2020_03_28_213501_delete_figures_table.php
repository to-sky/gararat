<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('figures');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('figures', function (Blueprint $table) {
            $table->increments('fig_id');
            $table->string('fig_no');
            $table->string('fig_image');
            $table->string('catalog')->default(0);
            $table->string('color')->default('0, 0, 0');

            $table->index('fig_no');
        });
    }
}
