<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use DB;

class Catalog extends Model
{
    use Translatable;

    protected $fillable = ['name', 'name_ar', 'parent_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(static::class, 'id', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Check if this category is child category
     *
     * @return bool
     */
    public function isParent()
    {
        return is_null($this->parent_id) ? true : false;
    }

    /**
     * Check if this category is child category
     *
     * @return bool
     */
    public function isChild()
    {
        return ! $this->isParent();
    }

    /**
     * Check if catalog has childs catalogs
     *
     * @return bool
     */
    public function hasChilds()
    {
        return $this->childs->count() ? true : false;
    }

    /**
     * Get only child catalogs
     *
     * @param $query
     */
    public function scopeChildCatalogs($query)
    {
        $query->whereNotNull('parent_id');
    }

    /**
     * Get only parent catalogs
     *
     * @param $query
     */
    public function scopeParentCatalogs($query)
    {
        $query->whereNull('parent_id');
    }

    /**
     * Sorting catalogs by "parent than all childs"
     *
     * @return array|\Illuminate\Support\Collection
     */
    public static function sortedByParentChilds()
    {
        $sortedCatalogs = collect();
        $parentCatalogs = self::parentCatalogs(
            self::query()
        )->with('childs')->get();

        foreach ($parentCatalogs as $parentCatalog) {
            $sortedCatalogs[] = $parentCatalog;

            foreach ($parentCatalog->childs as $child) {
                $sortedCatalogs[] = $child;
            }
        }

        return $sortedCatalogs;
    }

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
        $nodesModel = new Node;

        $getParentCatalog = $this->getCatalogByCatNumber($data['catalogParent']);

        $saveCatalog =  $this->insertGetId([
            'cat_number' => $data['catalogNumber'],
            'parent_cat' => $data['catalogParent'],
            'cat_name_en' => $data['catalogNameEn'],
            'cat_title_en' => $data['catalogSeoTitleEn'],
            'cat_description_en' => $data['catalogSeoDescriptionEn'],
            'cat_name_ar' => $data['catalogNameAr'],
            'cat_title_ar' => $data['catalogSeoTitleAr'],
            'cat_description_ar' => $data['catalogSeoDescriptionAr'],
            'created_at' => Carbon::now(),
            'cat_view' => $data['catalogViewType'],
            'cat_type' => $getParentCatalog->cat_type
        ]);

        if($file !== null) {
            $this->where('cid', $saveCatalog)->update([
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
        return $this->where('cat_number', $catId)->count();
    }

    /**
     * @param $catId
     * @param $cid
     * @return mixed
     */
    public function findCatalogItemByCatIdAndCid($catId, $cid)
    {
        return $this
            ->where('cat_number', $catId)
            ->where('cid', '!=', $cid)
            ->count();
    }

    /**
     * @param $type
     * @return mixed
     */
    public static function getAllCatalogItemsByType($type)
    {
        return self::where('cat_type', $type)->get();
    }

    /**
     * @return mixed
     */
    public function getAllCatalogItemsByTypeWithoutRoot($type)
    {
        return $this
            ->where('cat_type', $type)
            ->where('parent_cat', '!=', 0)
            ->get();
    }

    /**
     * @param $cid
     * @return mixed
     */
    public function getCatalogItemParentId($cid)
    {
        return $this->find($cid)->select('parent_cat')->first();
    }

    /**
     * @param $catNumber
     * @return mixed
     */
    public function getCatalogByCatNumber($catNumber)
    {
        return $this->where('cat_number', $catNumber)->first();
    }

    /**
     * @param $catNumber
     * @return mixed
     */
    public function getCatalogChilds($catNumber)
    {
        return $this->where('parent_cat', $catNumber)->get();
    }

    /**
     * @param $catNumber
     * @return mixed
     */
    public function getCatalogListByCatalogNumber($catNumber)
    {
        return $this->where('cat_number', $catNumber)->get();
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
        $categories = $this->get()->toArray();

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
        $categories = $this->get()->toArray();
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
     * @param $id
     * @return mixed
     */
    public function getCatalogByNodeId($id)
    {
        return DB::table('nodes_to_catalog')
            ->where('node', $id)
            ->join('catalog', 'nodes_to_catalog.catalog', '=', 'catalog.cid')
            ->first();
    }

    /**
     * @param $parent
     * @return int
     */
    public function countParentsToRoot($parent)
    {
        $i = 0;
        while($parent > 0) {
            $catalog = $this->getCatalogByCatNumber($parent);
            $parent = $catalog->parent_cat;
            $i++;
        }
        return $i;
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
        return $this->where('parent_cat', $oldParent)->update([
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
        $updateCatalog =  $this->find($data['cid'])->update([
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
            $nodesModel = new Node;
            $this->where('cid', $data['cid'])->update([
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
        $getCatalog = $this->find($cid);
        $this->where('parent_cat', $getCatalog->cat_number)->update([
            'parent_cat' => $getCatalog->parent_cat
        ]);
        DB::table('nodes_to_catalog')->where('catalog', $cid)->delete();

        return $this->where('cid', $cid)->delete();
    }
}
