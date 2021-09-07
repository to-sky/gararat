<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEquipmentCategoriesDropUniqueNameAndSlugIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment_categories', function (Blueprint $table) {
            $table->dropUnique(['name']);
            $table->dropUnique(['slug']);
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment_categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->change();
            $table->unique('name');
            $table->unique('slug');
        });
    }
}
