<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersToNodesTableChangeOtnId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_to_nodes', function (Blueprint $table) {
            $table->renameColumn('otn_id', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_to_nodes', function (Blueprint $table) {
            $table->renameColumn('id', 'otn_id');
        });
    }
}
