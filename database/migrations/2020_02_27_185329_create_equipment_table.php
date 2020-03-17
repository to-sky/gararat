<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('name_ar')->nullable();
            $table->text('description')->nullable();
            $table->text('description_ar')->nullable();
            $table->unsignedBigInteger('equipment_group_id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->decimal('price');
            $table->decimal('special_price')->nullable();
            $table->boolean('in_stock')->default(1);
            $table->boolean('is_special')->default(0);
            $table->integer('site_position')->nullable();
            $table->json('specifications')->nullable();

            $table->foreign('manufacturer_id')
                  ->references('id')
                  ->on('manufacturers');

            $table->foreign('equipment_group_id')
                  ->references('id')
                  ->on('equipment_groups');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
