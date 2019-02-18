<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Image;
use DB;

class Nodes extends Model
{
    //======================================================================
    // HELPERS
    //======================================================================
    /**
     * @param $image
     * @param $size
     * @param $pathFolder
     * @return string
     */
    public function proceedNodeImage($image, $size, $pathFolder)
    {
        $image2 = $image;
        $img_salt = uniqid();
        $image_filename = md5($image2->getClientOriginalName() . $img_salt);
        $path = public_path('uploads/' . $pathFolder . '/' . $image_filename . '.' . $image2->getClientOriginalExtension());
        $filename_to_store = 'uploads/' . $pathFolder . '/' . $image_filename . '.' . $image2->getClientOriginalExtension();
        if($size !== NULL) {
            Image::make($image2->getRealPath())->resize($size, null, function($constraint) {
                $constraint->aspectRatio();
            })->save($path);
        } else {
            Image::make($image2->getRealPath())->save($path);
        }
        return $filename_to_store;
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
     * @param $data
     * @return mixed
     */
    public function savePartsNode($nid, $data)
    {
        return DB::table('nodes_parts_fields')->insert([
            'node' => $nid,
            'group' => $data['partGroup'],
            'fig_no' => $data['figNumber'],
            'pos_no' => $data['posNumber'],
            'qty' => $data['qty'],
            'producer_id' => $data['producerId'],
            'our_id' => $data['ourId'],
            'fig_name_en' => $data['figNameEn'],
            'npf_name_en' => $data['nameEn'],
            'fig_name_ar' => $data['figNameAr'],
            'npf_name_ar' => $data['nameAr']
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
            $getCatalog = DB::table('catalog')->where('cat_number', $catalog)->first();
            DB::table('nodes_to_catalog')->insert([
                'node' => $nid,
                'catalog' => $getCatalog->cid
            ]);
        }
        return TRUE;
    }

    /**
     * @param $nid
     * @param $image
     * @param $isFeatured
     * @return mixed
     */
    public function saveNewNodeImage($nid, $image, $isFeatured)
    {
        if($isFeatured == 1) {
            DB::table('nodes_images')->where('node', $nid)->where('is_featured', 1)->delete();
        }
        return DB::table('nodes_images')->insert([
            'node' => $nid,
            'full_path' => $this->proceedNodeImage($image, 2048, 'products'),
            'mid_path' => $this->proceedNodeImage($image, 1024, 'products-mid'),
            'thumb_path' => $this->proceedNodeImage($image, 512, 'products-thumb'),
            'is_featured' => $isFeatured
        ]);
    }
    //======================================================================
    // READ
    //======================================================================
    /**
     * @param $type
     * @return mixed
     */
    public function getNodesByType($nodes, $type)
    {
        $get = DB::table('nodes')->whereIn('nid', $nodes);
        switch($type) {
            case 1:
                $get->join('nodes_machinery_fields', 'nodes.nid', '=', 'nodes_machinery_fields.node');
                break;
            case 2:
                $get->join('nodes_parts_fields', 'nodes.nid', '=', 'nodes_parts_fields.node');
                break;
            default:
                break;
        }
        $get->leftJoin('nodes_images', function($join) {
            $join->on('nodes.nid', '=', 'nodes_images.node')
                ->where('nodes_images.is_featured', '=', 1);
        });
        return $get->orderBy('nodes.created_at', 'DESC')->paginate(50);
    }

    /**
     * @param $nid
     * @param $type
     * @return mixed
     */
    public function getNodeById($nid, $type)
    {
        $get = DB::table('nodes')->where('nid', $nid);
        switch($type) {
            case 1:
                $get->join('nodes_machinery_fields', 'nodes.nid', '=', 'nodes_machinery_fields.node');
                break;
            case 2:
                $get->join('nodes_parts_fields', 'nodes.nid', '=', 'nodes_parts_fields.node');
                break;
            default:
                break;
        }
        return $get->first();
    }

    /**
     * @param $catalog
     * @return array
     */
    public function getNodesForProductType($catalog)
    {
        $nodes = [];
        $getNodes = DB::table('nodes_to_catalog')->whereIn('catalog', $catalog)->get();
        foreach ($getNodes as $node) {
            if(!in_array($node->node, $nodes)) {
                $nodes[] = $node->node;
            }
        }
        return $nodes;
    }

    /**
     * @param $nid
     * @return mixed
     */
    public function getNodeImages($nid)
    {
        return DB::table('nodes_images')->where('node', $nid)->get();
    }
    //======================================================================
    // UPDATE
    //======================================================================
    /**
     * @param $data
     * @return mixed
     */
    public function updateBasicNode($data)
    {
        $seoTitleEn = NULL;
        $seoTitleAr = NULL;
        if($data['seoTitleEn'] === NULL) {
            $seoTitleEn = $data['nameEn'];
        }
        if($data['seoTitleAr'] === NULL) {
            $seoTitleAr = $data['nameAr'];
        }

        return DB::table('nodes')->where('nid', $data['nid'])->update([
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
            'updated_at' => Carbon::now()
        ]);
    }

    /**
     * @param $nid
     * @param $data
     * @return mixed
     */
    public function updateEquipmentNode($data)
    {
        return DB::table('nodes_machinery_fields')->where('node', $data['nid'])->update([
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
     * @param $data
     * @return mixed
     */
    public function updatePartsNode($data)
    {
        return DB::table('nodes_parts_fields')->where('node', $data['nid'])->update([
            'group' => $data['partGroup'],
            'fig_no' => $data['figNumber'],
            'pos_no' => $data['posNumber'],
            'qty' => $data['qty'],
            'producer_id' => $data['producerId'],
            'our_id' => $data['ourId'],
            'fig_name_en' => $data['figNameEn'],
            'npf_name_en' => $data['nameEn'],
            'fig_name_ar' => $data['figNameAr'],
            'npf_name_ar' => $data['nameAr']
        ]);
    }
    //======================================================================
    // DELETE
    //======================================================================
    /**
     * @param $nid
     * @return bool
     */
    public function removeNodeById($nid)
    {
        DB::table('nodes_images')->where('node', $nid)->delete();
        DB::table('nodes_machinery_fields')->where('node', $nid)->delete();
        DB::table('nodes_parts_fields')->where('node', $nid)->delete();
        DB::table('nodes_to_catalog')->where('node', $nid)->delete();
        DB::table('nodes')->where('nid', $nid)->delete();
        return true;
    }
    /**
     * @param $ni_id
     * @return mixed
     */
    public function deleteImageById($ni_id)
    {
        return DB::table('nodes_images')->where('ni_id', $ni_id)->delete();
    }

    public function removeProductByNodeId($nid)
    {

    }
}
