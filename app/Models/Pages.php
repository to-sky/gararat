<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pages extends Model
{
    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $slug
     * @param $name
     * @param $body
     * @return mixed
     */
    public function createDefaultPage($slug, $name, $body)
    {
        return DB::table('pages')->insert([
            'pg_name' => $name,
            'pg_body' => $body,
            'pg_alias' => $slug
        ]);
    }
    //======================================================================
    // READ
    //======================================================================
    /**
     * @param $alias
     * @return mixed
     */
    public function getPageByAlias($alias)
    {
        return DB::table('pages')->where('pg_alias', $alias)->first();
    }
    //======================================================================
    // UPDATE
    //======================================================================
    /**
     * @param $data
     * @return mixed
     */
    public function updateDefaultPage($data)
    {
        return DB::table('pages')->where('pg_id', $data['pageId'])->update([
            'pg_name' => $data['pageName'],
            'pg_body' => $data['pageBody'],
            'pg_title' => $data['pageTitle'],
            'pg_description' => $data['pageDescription'],
            'pg_name_ar' => $data['pageNameAr'],
            'pg_title_ar' => $data['pageTitleAr'],
            'pg_body_ar' => $data['pageBodyAr'],
            'pg_description_ar' => $data['pageDescriptionAr']
        ]);
    }
    //======================================================================
    // DELETE
    //======================================================================

}
