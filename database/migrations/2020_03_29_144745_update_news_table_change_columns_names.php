<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNewsTableChangeColumnsNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table)
        {
            $table->renameColumn('nw_id', 'id');
            $table->renameColumn('nw_title', 'title');
            $table->renameColumn('nw_title_ar', 'title_ar');
            $table->renameColumn('nw_body', 'body');
            $table->renameColumn('nw_body_ar', 'body_ar');
            $table->renameColumn('nw_description', 'short_description');
            $table->renameColumn('nw_description_ar', 'short_description_ar');
            $table->dropColumn(['nw_name', 'nw_name_ar', 'nw_created', 'nw_image']);

            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::table('news', function (Blueprint $table)
        {
            $table->string('title')->nullable(false)->change();
            $table->string('title_ar')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table)
        {
            $table->renameColumn('id', 'nw_id');
            $table->renameColumn('body', 'nw_body');
            $table->renameColumn('body_ar', 'nw_body_ar');
            $table->renameColumn('title', 'nw_title');
            $table->renameColumn('title_ar', 'nw_title_ar');
            $table->renameColumn('short_description', 'nw_description');
            $table->renameColumn('short_description_ar', 'nw_description_ar');

            $table->string('nw_name');
            $table->string('nw_name_ar')->nullable();
            $table->string('nw_image')->nullable();
            $table->dateTime('nw_created');
            $table->index('nw_created');

            $table->dropColumn(['slug', 'created_at', 'updated_at']);
        });

        Schema::table('news', function (Blueprint $table)
        {
            $table->string('nw_title')->nullable()->change();
            $table->string('nw_title_ar')->nullable()->change();
        });

    }
}
