<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('nw_id');
            $table->string('nw_name');
            $table->longText('nw_body');
            $table->string('nw_title')->nullable();
            $table->text('nw_description')->nullable();
            $table->dateTime('nw_created');

            $table->index('nw_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
