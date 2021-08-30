<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateManufacturersTableChangeTableNameToEquipmentCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('manufacturers', 'equipment_categories');

        Schema::table('equipment_categories', function (Blueprint $table) {
            $table->renameIndex('manufacturers_name_unique', 'equipment_categories_name_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('equipment_categories', 'manufacturers');

        Schema::table('manufacturers', function (Blueprint $table) {
            $table->renameIndex('equipment_categories_name_unique', 'manufacturers_name_unique');
        });
    }
}
