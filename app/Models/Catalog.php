<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use DB;

class Catalog extends Model
{
    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $data
     * @return mixed
     */
    public function saveNewCatalogItem($data)
    {
        return DB::table('catalog')->insert([
            'cat_number' => $data['catalogNumber'],
            'parent_cat' => $data['catalogParent'],
            'cat_name_en' => $data['catalogNameEn'],
            'cat_title_en' => $data['catalogSeoTitleEn'],
            'cat_description_en' => $data['catalogSeoDescriptionEn'],
            'cat_name_ar' => $data['catalogNameAr'],
            'cat_title_ar' => $data['catalogSeoTitleAr'],
            'cat_description_ar' => $data['catalogSeoDescriptionAr'],
            'created_at' => Carbon::now()
        ]);
    }
    //======================================================================
    // READ
    //======================================================================
    /**
     * @param $catId
     * @return mixed
     */
    public function findCatalogItemByCatId($catId)
    {
        return DB::table('catalog')->where('cat_number', $catId)->count();
    }
    //======================================================================
    // UPDATE
    //======================================================================

    //======================================================================
    // DELETE
    //======================================================================

}
