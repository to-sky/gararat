<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArFieldsToNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('nw_name_ar')->nullable();
            $table->string('nw_title_ar')->nullable();
            $table->longText('nw_body_ar')->nullable();
            $table->text('nw_description_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('nw_name_ar');
            $table->dropColumn('nw_title_ar');
            $table->dropColumn('nw_body_ar');
            $table->dropColumn('nw_description_ar');
        });
    }
}
