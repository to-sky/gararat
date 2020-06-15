<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableAddTotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();

            $table->integer('user_id')->unsigned()->nullable()->change();
            $table->string('email')->nullable(false)->change();
            $table->string('first_name')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();

            $table->dropColumn('country');

            $table->decimal('total');
            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            Schema::disableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();

            $table->integer('user_id')->unsigned()->nullable(false)->change();
            $table->string('email')->nullable()->change();
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('phone')->nullable()->change();

            $table->dropForeign(['country_id']);
            $table->dropColumn(['total', 'country_id']);

            $table->string('country')->nullable();

            Schema::disableForeignKeyConstraints();
        });
    }
}
