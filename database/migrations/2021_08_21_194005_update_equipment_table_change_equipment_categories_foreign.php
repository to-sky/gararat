<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEquipmentTableChangeEquipmentCategoriesForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropForeign(['manufacturer_id']);
            $table->unsignedBigInteger('equipment_category_id')->nullable()->change();

            $table->foreign('equipment_category_id')
                ->references('id')
                ->on('equipment_categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropForeign(['equipment_category_id']);

            $table->foreign('equipment_category_id', 'equipment_manufacturer_id_foreign')
                ->references('id')
                ->on('equipment_categories');
        });
    }
}
