<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function(Blueprint $table) {
            $table->renameColumn('country_id', 'id');
            $table->renameColumn('country', 'name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries' , function (Blueprint $table) {
            $table->renameColumn('id', 'country_id');
            $table->renameColumn('name', 'country');
        });
    }
}
