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

    /**
     * @param $catId
     * @param $cid
     * @return mixed
     */
    public function findCatalogItemByCatIdAndCid($catId, $cid)
    {
        return DB::table('catalog')
            ->where('cat_number', $catId)
            ->where('cid', '!=', $cid)
            ->count();
    }

    /**
     * @return mixed
     */
    public function getAllCatalogItems()
    {
        return DB::table('catalog')->get();
    }

    /**
     * @param $cid
     * @return mixed
     */
    public function getCatalogItemParentId($cid)
    {
        return DB::table('catalog')->where('cid', $cid)->select('parent_cat')->first();
    }

    /**
     * @param $cid
     * @return mixed
     */
    public function getCatalogItemById($cid)
    {
        return DB::table('catalog')->where('cid', $cid)->first();
    }
    //======================================================================
    // UPDATE
    //======================================================================
    /**
     * @param $oldParent
     * @param $newParent
     * @return mixed
     */
    public function changeParentCategory($oldParent, $newParent)
    {
        return DB::table('catalog')->where('parent_cat', $oldParent)->update([
            'parent_cat' => $newParent
        ]);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function updateCatalogItem($data)
    {
        return DB::table('catalog')->where('cid', $data['cid'])->update([
            'cat_number' => $data['catalogNumber'],
            'parent_cat' => $data['catalogParent'],
            'cat_name_en' => $data['catalogNameEn'],
            'cat_title_en' => $data['catalogSeoTitleEn'],
            'cat_description_en' => $data['catalogSeoDescriptionEn'],
            'cat_name_ar' => $data['catalogNameAr'],
            'cat_title_ar' => $data['catalogSeoTitleAr'],
            'cat_description_ar' => $data['catalogSeoDescriptionAr'],
            'updated_at' => Carbon::now()
        ]);
    }
    //======================================================================
    // DELETE
    //======================================================================
    /**
     * @param $cid
     * @return mixed
     */
    public function deleteCategoryItem($cid)
    {
        return DB::table('catalog')->where('cid', $cid)->delete(); // TODO: before delete category linked nodes should be deleted or hide
    }
}
