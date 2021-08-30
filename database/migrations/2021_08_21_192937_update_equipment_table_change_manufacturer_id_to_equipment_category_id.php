<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEquipmentTableChangeManufacturerIdToEquipmentCategoryId extends Migration
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
            $table->dropIndex('equipment_manufacturer_id_foreign');

            $table->renameColumn('manufacturer_id', 'equipment_category_id');
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
            $table->renameColumn('equipment_category_id', 'manufacturer_id');

            $table->foreign('manufacturer_id')
                ->references('id')
                ->on('manufacturers');
        });
    }
}
