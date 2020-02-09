<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App;

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
                    if($value['cat_type'] == $protectId) {
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
                $result .= '<li class="list-group-item fsz-md">' . "\n";
                if($value['parent_cat'] !== 0) {
                    $result .= $value['cat_number'] . ' - ' . $value['cat_name_en'] . '<a href="/secured/admin/catalog/edit/' . $value['cid'] . '" class="c-blue-500" style="margin-left: 10px; font-size: 14px;"><i class="ti-pencil"></i> Edit</a> <a class="c-red-500" href="/secured/admin/catalog/delete/' . $value['cid'] . '" style="font-size: 14px;"><i class="c-red-500 ti-trash"></i> Delete</a>';
                } else {
                    $result .= '<strong>' . $value['cat_name_en'] . '</strong>';
                }
                $result .= $this->buildCatalogMenuWithLevels($array, $value['cat_number']);
                $result .= '</li>' . "\n";
            }
        }

        return $result ? '<ul class="list-group list-group-flush">' . $result . '</ul>' . "\n" : '';
    }

    /**
     * @param $currentCid
     * @param $array
     * @param $parent
     * @return string
     */
    public function buildFrontendPartsCatalogMenu($currentCid, $array, $parent)
    {
        $locale = App::getLocale();
        $catalogModel = new Catalog;
        $result = '';
        foreach($array as $key => $value) {
            if($value['parent_cat'] == $parent) {
                $getClilds = $catalogModel->getCatalogChilds($value['cat_number']);
                if(count($getClilds) !== 0) {
                    $expanded = 'expanded';
                } else {
                    $expanded = 'not-expanded';
                }
                // Active Menu
                if($currentCid == $value['cid']) {
                    $activeMenu = 'active';
                } else {
                    $activeMenu = '';
                }
                // <i class="fas fa-chevron-right"></i>
                $result .= '<li class="' . $expanded . ' ' . $activeMenu . '">' . "\n";
                if($locale === 'en') {
                    $result .= '<a href="/catalog/' . $value['cid'] . '"><span class="menu__name">' . $value['cat_name_en'] . '</span>';
                } else {
                    $result .= '<a href="/catalog/' . $value['cid'] . '"><span class="menu__name">' . $value['cat_name_ar'] . '</span>';
                }
                if(count($getClilds) !== 0) {
                    $result .= '<span class="menu_dropdown"><i class="fas fa-chevron-right"></i></span>';
                }
                $result .=  '</a>';
                $result .= $this->buildFrontendPartsCatalogMenu($currentCid, $array, $value['cat_number']);
                $result .= '</li>' . "\n";
            }
        }
        if($parent === '2') {
            $classTree = 'tree';
        } else {
            $classTree = '';
        }
        return $result ? '<ul class="' . $classTree . '">' . $result . '</ul>' . "\n" : '';
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
        $locale = App::getLocale();
        $catalogModel = new Catalog;
        $breadcrumbsArray = [];
        if($locale === 'en') {
            if($hasLast === TRUE) {
                $breadcrumbsArray[] = array('name' => $currentCatalog->cat_name_en, 'route' => 'catalogPage', 'param' => $currentCatalog->cid);
            } else {
                $breadcrumbsArray[] = array('name' => $currentCatalog->cat_name_en, 'route' => NULL, 'param' => $currentCatalog->cid);
            }
        } else {
            if($hasLast === TRUE) {
                $breadcrumbsArray[] = array('name' => $currentCatalog->cat_name_ar, 'route' => 'catalogPage', 'param' => $currentCatalog->cid);
            } else {
                $breadcrumbsArray[] = array('name' => $currentCatalog->cat_name_ar, 'route' => NULL, 'param' => $currentCatalog->cid);
            }
        }
        $parentCat = $currentCatalog->parent_cat;
        if($parentCat > 0) {
            while($parentCat > 0) {
                $getCatalog = $catalogModel->getCatalogByCatNumber($parentCat);
                if($locale === 'en') {
                    $breadcrumbsArray[] = array('name' => $getCatalog->cat_name_en, 'route' => 'catalogPage', 'param' => $getCatalog->cid);
                } else {
                    $breadcrumbsArray[] = array('name' => $getCatalog->cat_name_ar, 'route' => 'catalogPage', 'param' => $getCatalog->cid);
                }
                $parentCat = $getCatalog->parent_cat;
            }
        }
        if($locale === 'en') {
            $breadcrumbsArray[] = array('name' => 'Home', 'route' => 'homePage', 'param' => NULL);
        } else {
            $breadcrumbsArray[] = array('name' => 'الرئيسية', 'route' => 'homePage', 'param' => NULL);
        }

        return array_reverse($breadcrumbsArray);
    }
    //======================================================================
    // Cart Builder
    //======================================================================
    public function cartPreview()
    {

    }
}
