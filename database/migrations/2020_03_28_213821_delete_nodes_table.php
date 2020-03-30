<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nodes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            // English names
            $table->string('n_name_en');
            $table->string('n_title_en')->nullable();
            $table->text('n_description_en')->nullable();
            // Arabic names
            $table->string('n_name_ar');
            $table->string('n_title_ar')->nullable();
            $table->text('n_description_ar')->nullable();
            // Params
            $table->integer('has_photo')->default(0)->comment('0 - No, 1 - Yes');
            $table->integer('in_stock')->default(0)->comment('0 - Not in stock, 1 - In stock');
            $table->integer('is_special')->default(0)->comment('0 - No, 1 - Yes');
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('special_price', 8, 2)->default(0);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();

            $table->index('created_at');
        });
    }
}
