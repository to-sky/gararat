<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helpers extends Model
{
    /**
     * @param $qb_result
     * @return mixed
     */
    public function convertQueryBuilderToArray($qb_result)
    {
        return json_decode(json_encode($qb_result), true);
    }

    /**
     * @param $parentId
     * @param $array
     * @return false|int|string
     */
    private function isHasChilds($parentId, $array) {
        $column = array_column($array, 'parent_cat');
        $found_key = array_search($parentId, $column);
        return $found_key;
    }

    public function pushOption($array, $parent, $result, $i)
    {
        foreach($array as $key => $value) {
            if($value['parent_cat'] == $parent) {
                $result .= '<option value="' . $value['cat_number'] . '">' . $i . ' ' . $value['cat_name_en'] . '</option>';
                if($this->isHasChilds($value['cat_number'], $array) !== false) {
                    $i .= '-';
                    $result .= $this->pushOption($array, $value['cat_number'], $result, $i);
                }
            }
        }
        return $result;
    }

    public function buildCatalogOptionsWithLevels($array, $parent)
    {
        $result = '';
        foreach($array as $key => $value) {
            if($value['parent_cat'] == $parent) {
                $result .= '<option value="' . $value['cat_number'] . '">' . $value['cat_name_en'] . '</option>';
                $result .= $this->buildCatalogOptionsWithLevels($array, $value['cat_number']);
            }
        }
        return $result;
    }

    public function buildCatalogMenuWithLevels($catalogArray)
    {

    }
}
