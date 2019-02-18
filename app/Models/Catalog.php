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

    /**
     * @param $catNumber
     * @return mixed
     */
    public function getCatalogByCatNumber($catNumber)
    {
        return DB::table('catalog')->where('cat_number', $catNumber)->first();
    }

    /**
     * @param $catNumber
     * @return mixed
     */
    public function getCatalogChilds($catNumber)
    {
        return DB::table('catalog')->where('parent_cat', $catNumber)->get();
    }

    /**
     * @param $catParent
     * @return mixed
     */
    public function getCatalogParent($catParent)
    {
        return DB::table('catalog')->where('cat_number', $catParent)->first();
    }

    /**
     * @param $catNumber
     * @return mixed
     */
    public function getCatalogListByCatalogNumber($catNumber)
    {
        return DB::table('catalog')->where('cat_number', $catNumber)->get();
    }

    public function getAllChildsCategories($category)
    {
        $allCategories = $this->getAllCatalogItems();
        $categories = json_decode(json_encode($allCategories), true);
        $array = [];
        if($category != 1 && $category != 2) {
            $parent = $category;
        } else {
            $parent = 0;
        }
        $get = $this->buildChildsCategories($categories, $parent, $category);
        $explodedCatalog = explode(',', $get);
        foreach ($explodedCatalog as $catalog) {
            if($catalog !== '') {
                if(!in_array($catalog, $array)) {
                    $array[] = $catalog;
                }
            }
        }
        return $array;
    }

    /**
     * @param $catalog
     * @param $parent
     * @param $neededCategory
     * @return string
     */
    public function buildChildsCategories($catalog, $parent, $neededCategory)
    {
        $array = '';
        foreach($catalog as $key => $value) {
            if($value['parent_cat'] == $parent) {
                if($neededCategory !== NULL) {
                    if($neededCategory != 1 && $neededCategory != 2) {
                        if($neededCategory == $value['parent_cat']) {
                            $array .= $value['cid'] . ',';
                            $array .= $this->buildChildsCategories($catalog, $value['cat_number'], NULL);
                        }
                    } else {
                        if($neededCategory == $value['cat_number']) {
                            $array .= $value['cid'] . ',';
                            $array .= $this->buildChildsCategories($catalog, $value['cat_number'], NULL);
                        }
                    }
                } else {
                    $array .= $value['cid'] . ',';
                    $array .= $this->buildChildsCategories($catalog, $value['cat_number'], NULL);
                }
            }
        }
        return $array;
    }

    /**
     * @param $nid
     * @return array
     */
    public function getSelectedCatalogItem($nid)
    {
        $request = DB::table('nodes_to_catalog')
            ->where('node', $nid)
            ->join('catalog', 'nodes_to_catalog.catalog', '=', 'catalog.cid')
            ->select('catalog.cat_number')
            ->get();
        $catalog = [];
        foreach ($request as $key => $value) {
            if(!in_array($value->cat_number, $catalog)) {
                $catalog[] = $value->cat_number;
            }
        }
        return $catalog;
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
