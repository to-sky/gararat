<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NodesPartsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes_parts_fields', function (Blueprint $table) {
            $table->increments('npf_id');
            $table->integer('node')->unsigned()->default(0);
            $table->integer('group')->nullable();
            $table->string('fig_no')->nullable();
            $table->integer('pos_no')->nullable();
            $table->integer('qty')->nullable();
            $table->string('producer_id')->nullable();
            $table->string('our_id')->nullable();
            // English names
            $table->text('fig_name_en')->nullable();
            $table->string('npf_name_en')->nullable();
            // Arabic names
            $table->text('fig_name_ar')->nullable();
            $table->string('npf_name_ar')->nullable();

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
        Schema::dropIfExists('nodes_parts_fields');
    }
}
