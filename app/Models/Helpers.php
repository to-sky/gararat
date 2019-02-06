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
                $result .= '<li>' . "\n";
                $result .= '<strong>' . $value['cat_name_en'] . '</strong> <a href="/secured/admin/catalog/edit/' . $value['cid'] . '" class="c-blue-500" style="margin-left: 10px;"><i class="ti-pencil"></i> Edit</a> <a class="c-red-500" href="/secured/admin/catalog/delete/' . $value['cid'] . '"><i class="c-red-500 ti-trash"></i> Delete</a>';
                $result .= $this->buildCatalogMenuWithLevels($array, $value['cat_number']);
                $result .= '</li>' . "\n";
            }
        }
        return $result ? '<ul>' . $result . '</ul>' . "\n" : '';
    }
}
