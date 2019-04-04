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

    /**
     * @return mixed
     */
    public function createDefaultHomePage()
    {
        return DB::table('home_page')->insert([
            'block_1' => null
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

    /**
     * @return mixed
     */
    public function getHomePage()
    {
        return DB::table('home_page')->first();
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

    /**
     * @param $data
     * @return mixed
     */
    public function updateHomePage($data)
    {
        return DB::table('home_page')->where('hp_id', $data['pageId'])->update([
            'block_1' => $data['block1'],
            'block_1_ar' => $data['block1Ar'],
            'block_2' => $data['block2'],
            'block_2_ar' => $data['block2Ar'],
            'block_3' => $data['block3'],
            'block_3_ar' => $data['block3Ar'],
            'block_4' => $data['block4'],
            'block_4_ar' => $data['block4Ar'],
            'block_5' => $data['block5'],
            'block_5_ar' => $data['block5Ar']
        ]);
    }
    //======================================================================
    // DELETE
    //======================================================================

}
