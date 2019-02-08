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
    public function buildCatalogOptionsWithLevels($array, $parent, $i, $activeItemId)
    {
        $result = '';
        foreach($array as $key => $value) {
            if($value['parent_cat'] == $parent) {
                $selected = '';
                if($activeItemId !== NULL && $value['cat_number'] == $activeItemId) {
                    $selected = 'selected';
                }
                $result .= '<option ' .  $selected . ' value="' . $value['cat_number'] . '">' . $i . ' ' . $value['cat_name_en'] . '</option>';
                $i .= '---';
                $result .= $this->buildCatalogOptionsWithLevels($array, $value['cat_number'], $i, $activeItemId);
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
                $result .= $value['cat_name_en'] . '<a href="/secured/admin/catalog/edit/' . $value['cid'] . '" class="c-blue-500" style="margin-left: 10px; font-size: 14px;"><i class="ti-pencil"></i> Edit</a> <a class="c-red-500" href="/secured/admin/catalog/delete/' . $value['cid'] . '" style="font-size: 14px;"><i class="c-red-500 ti-trash"></i> Delete</a>';
                $result .= $this->buildCatalogMenuWithLevels($array, $value['cat_number']);
                $result .= '</li>' . "\n";
            }
        }
        return $result ? '<ul>' . $result . '</ul>' . "\n" : '';
    }

    //======================================================================
    // Breadcrumbs Builder
    //======================================================================
    public function buildCatalogBreadcrumbs($currentCatalog)
    {
        $breadcrumbsArray = [];
    }
}
