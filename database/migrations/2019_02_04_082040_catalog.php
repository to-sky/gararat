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
            $table->increments('cid');
            $table->string('cat_number')->unique();
            $table->string('parent_cat')->default(0);
            $table->integer('cat_type')->default(0)->comment('0 - Equipment, 1 - Parts');
            $table->integer('is_drawing')->default(0)->comment('0 - No, 1 - Yes');
            // English names
            $table->string('cat_name_en');
            $table->string('cat_title_en')->nullable();
            $table->text('cat_description_en')->nullable();
            // Arabic names
            $table->string('cat_name_ar')->nullable();
            $table->string('cat_title_ar')->nullable();
            $table->text('cat_description_ar')->nullable();
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
