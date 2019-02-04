<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Catalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_number')->default(0);
            $table->integer('parent_cat')->default(0);
            $table->string('cat_name');
            $table->string('cat_title')->nullable();
            $table->text('cat_description')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

            $table->index('cat_number');
            $table->index('parent_cat');
            $table->index(['cat_number', 'parent_cat']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog');
    }
}
