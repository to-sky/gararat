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
     * @param $array
     * @param $parent
     * @param $i
     * @return string
     */
    public function buildCatalogOptionsWithLevels($array, $parent, $i)
    {
        $result = '';
        foreach($array as $key => $value) {
            if($value['parent_cat'] == $parent) {
                $result .= '<option value="' . $value['cat_number'] . '">' . $i . ' ' . $value['cat_name_en'] . '</option>';
                $i .= '---';
                $result .= $this->buildCatalogOptionsWithLevels($array, $value['cat_number'], $i);
            }
        }
        return $result;
    }

    public function buildCatalogMenuWithLevels($catalogArray)
    {

    }
}
