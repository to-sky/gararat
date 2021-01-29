<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSlidersTableChangeBodyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn(['title', 'title_ar', 'sub_title', 'sub_title_ar']);
            $table->string('body')->nullable();
            $table->string('body_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn(['body', 'body_ar']);
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('sub_title_ar')->nullable();
        });
    }
}
