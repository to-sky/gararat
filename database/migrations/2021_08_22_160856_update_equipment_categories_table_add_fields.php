<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEquipmentCategoriesTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment_categories', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('slug')->unique()->nullable();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('equipment_categories')
                ->onDelete('cascade');
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
            $table->dropColumn('slug');
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['description', 'description_ar', 'parent_id']);
        });
    }
}
