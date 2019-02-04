<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('nid');
            $table->decimal('price', 8, 2)->default(0);
            // English names
            $table->string('n_name_en');
            $table->string('n_title_en')->nullable();
            $table->text('n_description_en')->nullable();
            // Arabic names
            $table->string('n_name_ar');
            $table->string('n_title_ar')->nullable();
            $table->text('n_description_ar')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
    }
}
