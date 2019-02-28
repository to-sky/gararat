<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColorToFiguresNodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('figures_to_nodes', function (Blueprint $table) {
            $table->string('color')->default('0, 0, 0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('figures_to_nodes', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}
