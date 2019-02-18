<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use DB;

class Nodes extends Model
{
    //======================================================================
    // HELPERS
    //======================================================================
    public function proceedNodeImage($image, $size)
    {

    }
    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $data
     * @return mixed
     */
    public function createBasicNode($data)
    {
        $seoTitleEn = NULL;
        $seoTitleAr = NULL;
        if($data['seoTitleEn'] === NULL) {
            $seoTitleEn = $data['nameEn'];
        }
        if($data['seoTitleAr'] === NULL) {
            $seoTitleAr = $data['nameAr'];
        }

        return DB::table('nodes')->insertGetId([
            'n_name_en' => $data['nameEn'],
            'n_title_en' => $seoTitleEn,
            'n_description_en' => $data['seoDescriptionEn'],
            'n_name_ar' => $data['nameAr'],
            'n_title_ar' => $seoTitleAr,
            'n_description_ar' => $data['seoDescriptionAr'],
            'has_photo' => $data['hasPhoto'],
            'in_stock' => $data['inStock'],
            'is_special' => $data['isSpecial'],
            'price' => $data['nodePrice'],
            'special_price' => $data['nodeSpecialPrice'],
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * @param $nid
     * @param $data
     * @return mixed
     */
    public function saveEquipmentNode($nid, $data)
    {
        return DB::table('nodes_machinery_fields')->insert([
            'node' => $nid,
            'nmf_name_en' => $data['nameEn'],
            'nmf_body_en' => $data['nodeBody'],
            'nmf_description_en' => $data['seoDescriptionAr'],
            'nmf_short_en' => $data['nodeShortBody'],
            'nmf_name_ar' => $data['nameAr'],
            'nmf_body_ar' => $data['nodeBodyAr'],
            'nmf_description_ar' => $data['seoDescriptionAr'],
            'nmf_short_ar' => $data['nodeShortBodyAr']
        ]);
    }

    /**
     * @param $nid
     * @param $catalogs
     * @return bool
     */
    public function setNodeToCatalog($nid, $catalogs)
    {
        $removeOldRecords = DB::table('nodes_to_catalog')->where('node', $nid)->delete();
        foreach ($catalogs as $catalog) {
            DB::table('nodes_to_catalog')->insert([
                'node' => $nid,
                'catalog' => $catalog
            ]);
        }
        return TRUE;
    }
    //======================================================================
    // READ
    //======================================================================

    //======================================================================
    // UPDATE
    //======================================================================

    //======================================================================
    // DELETE
    //======================================================================

}
