<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use DB;

use \App\Models\Nodes;

class Catalog extends Model
{
    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $data
     * @param $file
     * @return mixed
     */
    public function saveNewCatalogItem($data, $file)
    {
        $nodesModel = new Nodes;

        $saveCatalog =  DB::table('catalog')->insertGetId([
            'cat_number' => $data['catalogNumber'],
            'parent_cat' => $data['catalogParent'],
            'cat_name_en' => $data['catalogNameEn'],
            'cat_title_en' => $data['catalogSeoTitleEn'],
            'cat_description_en' => $data['catalogSeoDescriptionEn'],
            'cat_name_ar' => $data['catalogNameAr'],
            'cat_title_ar' => $data['catalogSeoTitleAr'],
            'cat_description_ar' => $data['catalogSeoDescriptionAr'],
            'created_at' => Carbon::now(),
            'cat_view' => $data['catalogViewType']
        ]);

        if($file !== null) {
            DB::table('catalog')->where('cid', $saveCatalog)->update([
                'cat_image' => $nodesModel->proceedNodeImage($file, 512, 'catalog')
            ]);
        }

        return $saveCatalog;
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
     * @return mixed
     */
    public function getAllCatalogItemsByType($type)
    {
        return DB::table('catalog')->where('cat_type', $type)->get();
    }

    /**
     * @return mixed
     */
    public function getAllCatalogItemsByTypeWithoutRoot($type)
    {
        return DB::table('catalog')->where('cat_type', $type)->where('parent_cat', '!=', 0)->get();
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
     * @param $cid
     * @return mixed
     */
    public function getCatalogByCid($cid)
    {
        return DB::table('catalog')->where('cid', $cid)->first();
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

    /**
     * @param $category
     * @return array
     */
    public function getAllChildsCategories($category)
    {
        switch ($category) {
            case 0:
                $needed = 1;
                break;
            case 1:
                $needed = 2;
                break;
            default:
                break;
        }
        $allCategories = $this->getAllCatalogItems();
        $categories = json_decode(json_encode($allCategories), true);
        $array = [];
        if($needed != 1 && $needed != 2) {
            $parent = $needed;
        } else {
            $parent = 0;
        }
        $get = $this->buildChildsCategories($categories, $parent, $needed);
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
     * @param $category
     * @return array
     */
    public function getAllChildsCategoriesFrontEnd($category)
    {
        switch ($category) {
            case 1:
                $needed = 1;
                break;
            case 2:
                $needed = 2;
                break;
            default:
                $needed = $category;
                break;
        }
        $allCategories = $this->getAllCatalogItems();
        $categories = json_decode(json_encode($allCategories), true);
        $array = [];
        if($needed != 1 && $needed != 2) {
            $parent = $needed;
        } else {
            $parent = 0;
        }
        $get = $this->buildChildsCategories($categories, $parent, $needed);
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
            } else {
                if($value['cat_number'] == $neededCategory) {
                    $array .= $value['cid'] . ',';
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

    /**
     * @param $nid
     * @return mixed
     */
    public function getCatalogByNodeId($nid)
    {
        return DB::table('nodes_to_catalog')
            ->where('node', $nid)
            ->join('catalog', 'nodes_to_catalog.catalog', '=', 'catalog.cid')
            ->first();
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
     * @param $file
     * @return mixed
     */
    public function updateCatalogItem($data, $file)
    {
        $updateCatalog =  DB::table('catalog')->where('cid', $data['cid'])->update([
            'cat_number' => $data['catalogNumber'],
            'parent_cat' => $data['catalogParent'],
            'cat_name_en' => $data['catalogNameEn'],
            'cat_title_en' => $data['catalogSeoTitleEn'],
            'cat_description_en' => $data['catalogSeoDescriptionEn'],
            'cat_name_ar' => $data['catalogNameAr'],
            'cat_title_ar' => $data['catalogSeoTitleAr'],
            'cat_description_ar' => $data['catalogSeoDescriptionAr'],
            'updated_at' => Carbon::now(),
            'cat_view' => $data['catalogViewType']
        ]);

        if($file !== null) {
            $nodesModel = new Nodes;
            DB::table('catalog')->where('cid', $data['cid'])->update([
                'cat_image' => $nodesModel->proceedNodeImage($file, 512, 'catalog')
            ]);
        }
        return $updateCatalog;
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
