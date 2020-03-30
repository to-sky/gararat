<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteNodesPartsFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nodes_parts_fields');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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

            $table->foreign('node')->references('id')->on('nodes');

            $table->index('node');
        });
    }
}
