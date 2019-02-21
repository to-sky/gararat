<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use \App\Models\Catalog;

class Helpers extends Model
{
    //======================================================================
    // Catalog Menu Builder
    //======================================================================
    /**
     * @param $qb_result
     * @return mixed
     */
    public function convertQueryBuilderToArray($qb_result)
    {
        return json_decode(json_encode($qb_result), true);
    }

    /**
     * @param $array
     * @param $parent
     * @param $i
     * @return string
     */
    public function buildCatalogOptionsWithLevels($array, $parent, $i, $activeItemId, $protectId)
    {
        $result = '';
        foreach($array as $key => $value) {
            if($value['parent_cat'] == $parent) {
                $selected = '';
                $activeCatalogs = [];
                if(is_array($activeItemId)) {
                     foreach ($activeItemId as $item) {
                         $activeCatalogs[] = $item;
                     }
                } else {
                    $activeCatalogs[] = $activeItemId;
                }
                if($activeItemId !== NULL && in_array($value['cat_number'], $activeCatalogs)) {
                    $selected = 'selected';
                }
                $option = '<option ' .  $selected . ' value="' . $value['cat_number'] . '">' . $value['cat_number'] . ' ' . $value['cat_name_en'] . '</option>';
                // $i .= '---';
                if($protectId !== NULL) {
                    if($value['cat_number'] == $protectId) {
                        $result .= $option;
                        $result .= $this->buildCatalogOptionsWithLevels($array, $value['cat_number'], $i, $activeItemId, NULL);
                    }
                } else {
                    $result .= $option;
                    $result .= $this->buildCatalogOptionsWithLevels($array, $value['cat_number'], $i, $activeItemId, NULL);
                }
            }
        }
        return $result;
    }

    /**
     * @param $array
     * @param $parent
     * @return string
     */
    public function buildCatalogMenuWithLevels($array, $parent)
    {
        $result = '';
        foreach($array as $key => $value) {
            if($value['parent_cat'] == $parent) {
                $result .= '<li style="font-size: 18px;">' . "\n";
                if($value['parent_cat'] !== 0) {
                    $result .= $value['cat_name_en'] . '<a href="/secured/admin/catalog/edit/' . $value['cid'] . '" class="c-blue-500" style="margin-left: 10px; font-size: 14px;"><i class="ti-pencil"></i> Edit</a> <a class="c-red-500" href="/secured/admin/catalog/delete/' . $value['cid'] . '" style="font-size: 14px;"><i class="c-red-500 ti-trash"></i> Delete</a>';
                } else {
                    $result .= '<strong>' . $value['cat_name_en'] . '</strong>';
                }
                $result .= $this->buildCatalogMenuWithLevels($array, $value['cat_number']);
                $result .= '</li>' . "\n";
            }
        }
        return $result ? '<ul>' . $result . '</ul>' . "\n" : '';
    }

    //======================================================================
    // Breadcrumbs Builder
    //======================================================================
    /**
     * @param $currentCatalog
     * @return array
     */
    public function buildCatalogBreadcrumbs($currentCatalog, $hasLast)
    {
        $catalogModel = new Catalog;
        $breadcrumbsArray = [];
        if($hasLast === TRUE) {
            $breadcrumbsArray[] = array('name' => $currentCatalog->cat_name_en, 'route' => 'catalogPage', 'param' => $currentCatalog->cid);
        } else {
            $breadcrumbsArray[] = array('name' => $currentCatalog->cat_name_en, 'route' => NULL, 'param' => $currentCatalog->cid);
        }
        $parentCat = $currentCatalog->parent_cat;
        if($parentCat > 0) {
            while($parentCat > 0) {
                $getCatalog = $catalogModel->getCatalogParent($parentCat);
                $breadcrumbsArray[] = array('name' => $getCatalog->cat_name_en, 'route' => 'catalogPage', 'param' => $getCatalog->cid);
                $parentCat = $getCatalog->parent_cat;
            }
        }
        $breadcrumbsArray[] = array('name' => 'Home', 'route' => 'homePage', 'param' => NULL);

        return array_reverse($breadcrumbsArray);
    }
}
