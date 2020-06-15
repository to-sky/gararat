<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdatePagesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['pg_description', 'pg_description_ar']);

            $table->renameColumn('pg_id', 'id')->first();
            $table->renameColumn('pg_name', 'name')->after('id');
            $table->renameColumn('pg_name_ar', 'name_ar')->after('name');
            $table->renameColumn('pg_alias', 'slug')->after('name_ar');
            $table->renameColumn('pg_title', 'title')->after('slug');
            $table->renameColumn('pg_title_ar', 'title_ar')->after('title');
            $table->renameColumn('pg_body', 'body')->nullable()->after('title_ar');
            $table->renameColumn('pg_body_ar', 'body_ar')->after('body');

            $table->timestamps();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->longText('body')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('pg_description')->nullable();
            $table->text('pg_description_ar')->nullable();

            $table->renameColumn('name', 'pg_name');
            $table->renameColumn('name_ar', 'pg_name_ar');
            $table->renameColumn('id', 'pg_id');
            $table->renameColumn('slug', 'pg_alias');
            $table->renameColumn('title', 'pg_title');
            $table->renameColumn('title_ar', 'pg_title_ar');
            $table->renameColumn('body', 'pg_body');
            $table->renameColumn('body_ar', 'pg_body_ar');

            $table->dropTimestamps();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->longText('pg_body')->nullable(false)->change();
        });
    }
}
