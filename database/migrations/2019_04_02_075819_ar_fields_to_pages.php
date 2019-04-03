<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArFieldsToPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('pg_name_ar')->nullable();
            $table->string('pg_title_ar')->nullable();
            $table->longText('pg_body_ar')->nullable();
            $table->text('pg_description_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('pg_name_ar');
            $table->dropColumn('pg_title_ar');
            $table->dropColumn('pg_body_ar');
            $table->dropColumn('pg_description_ar');
        });
    }
}
