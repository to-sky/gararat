<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSliderTableChangeColumnsNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('slider', 'slides');

        Schema::table('slides', function (Blueprint $table) {
            $table->renameColumn('sl_id', 'id');
            $table->renameColumn('sl_title', 'title');
            $table->renameColumn('sl_description', 'sub_title');
            $table->renameColumn('sl_order', 'slide_number');

            $table->integer('text_position')->default(0);
            $table->string('title_ar')->nullable();
            $table->string('sub_title_ar')->nullable();
            $table->string('link')->nullable();
            $table->dropColumn('sl_image');

            $table->dropIndex('slider_sl_order_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('slides', 'slider');

        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn(['text_position', 'title_ar', 'sub_title_ar', 'link']);

            $table->renameColumn('id', 'sl_id');
            $table->renameColumn('title', 'sl_title');
            $table->renameColumn('sub_title', 'sl_description');
            $table->renameColumn('slide_number', 'sl_order');

            $table->string('sl_image')->nullable();

            $table->index('sl_order');
        });
    }
}
