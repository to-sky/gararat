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
            // English names
            $table->string('nmf_name_en')->nullable();
            $table->longText('nmf_body_en')->nullable();
            $table->text('nmf_description_en')->nullable();
            $table->text('nmf_short_en')->nullable();
            // Arabic names
            $table->string('nmf_name_ar')->nullable();
            $table->longText('nmf_body_ar')->nullable();
            $table->text('nmf_description_ar')->nullable();
            $table->text('nmf_short_ar')->nullable();

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
