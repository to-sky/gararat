<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteHomePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('home_page');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('home_page', function (Blueprint $table) {
            $table->increments('hp_id');
            $table->text('block_1')->nullable();
            $table->text('block_2')->nullable();
            $table->longText('block_3')->nullable();
            $table->text('block_4')->nullable();
            $table->longText('block_5')->nullable();
            $table->text('block_1_ar')->nullable();
            $table->text('block_2_ar')->nullable();
            $table->longText('block_3_ar')->nullable();
            $table->text('block_4_ar')->nullable();
            $table->longText('block_5_ar')->nullable();
        });
    }
}
