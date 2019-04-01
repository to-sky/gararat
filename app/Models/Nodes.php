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
                $constraint->upsize();
            })->save($path);
        } else {
            Image::make($image2->getRealPath())->save($path);
        }
        return $filename_to_store;
    }

    /**
     * @param $data
     */
    public function getPartsCsvRecordToAnalyze($data)
    {
        $checkIfNodeExist = DB::table('nodes_parts_fields')->where('our_id', $data['OUR ID'])->select('node')->first();
        if($checkIfNodeExist && $checkIfNodeExist !== null) {
            $this->updateBasicPartsNodeFromCSV($checkIfNodeExist->node, $data);
        } else {
            $this->createBasicPartsNodeFromCSV($data);
        }
    }

    /**
     * @param $data
     */
    public function getEQCsvRecordToAnalyze($data)
    {
        $checkIfNodeExist = DB::table('nodes_machinery_fields')->where('our_id', $data['OUR ID'])->select('node')->first();
        if($checkIfNodeExist && $checkIfNodeExist !== null) {
            $this->updateEQNodeFromCSV($checkIfNodeExist->node, $data);
        } else {
            $this->createEQNodeFromCSV($data);
        }
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
     * @param $data
     * @return bool
     */
    public function createBasicPartsNodeFromCSV($data)
    {
        $specialPrice = 0;
        if($data['Special price'] != '' && $data['Special price'] !== null) {
            $specialPrice = $data['Special price'];
        }

        $getCatalog = DB::table('catalog')->where('cat_number', $data['Catalog'])->select('cid')->first();

        if($getCatalog && $getCatalog !== null) {
            $saveNode = DB::table('nodes')->insertGetId([
                'n_name_en' => $data['Drawing name Eng.'] . ' - ' . $data['Name Eng.'],
                'n_title_en' => $data['Drawing name Eng.'] . ' - ' . $data['Name Eng.'],
                'n_description_en' => $data['Drawing name Eng.'] . ' - ' . $data['Name Eng.'],
                'n_name_ar' => $data['Drawing  name Ar.'] . ' - ' . $data['Name Ar.'],
                'n_title_ar' => $data['Drawing  name Ar.'] . ' - ' . $data['Name Ar.'],
                'n_description_ar' => $data['Drawing  name Ar.'] . ' - ' . $data['Name Ar.'],
                'has_photo' => $data['Has photo'],
                'in_stock' => $data['In stock'],
                'is_special' => $data['Is speial'],
                'price' => $data['Price'],
                'special_price' => $specialPrice,
                'created_at' => Carbon::now()
            ]);
            // Save to catalog
            DB::table('nodes_to_catalog')->insert([
                'node' => $saveNode,
                'catalog' => $getCatalog->cid
            ]);
            // Save parts fields
            $positionNumber = null;
            $qty = null;
            if($data['Pos. No.'] != '' && $data['Pos. No.'] !== null) {
                $positionNumber = $data['Pos. No.'];
            }
            if($data['Q-ty on the drawing'] != '' && $data['Q-ty on the drawing'] !== null) {
                $qty = $data['Q-ty on the drawing'];
            }
            $producerId = $data['Producer ID'];
            if(strlen($producerId) > 200) {
                $producerId = substr($producerId, 0, 200);
            }
            DB::table('nodes_parts_fields')->insert([
                'node' => $saveNode,
                'group' => (int)$data['Group No.'],
                'fig_no' => $data['Drawing No.'],
                'pos_no' => (int)$positionNumber,
                'qty' => (int)$qty,
                'producer_id' => $producerId,
                'our_id' => $data['OUR ID'],
                'fig_name_en' => $data['Drawing name Eng.'],
                'npf_name_en' => $data['Name Eng.'],
                'fig_name_ar' => $data['Drawing  name Ar.'],
                'npf_name_ar' => $data['Name Ar.']
            ]);
        }
        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    public function createEQNodeFromCSV($data)
    {
        $specialPrice = 0;
        if($data['Special price'] != '' && $data['Special price'] !== null) {
            $specialPrice = $data['Special price'];
        }

        $getCatalog = DB::table('catalog')->where('cat_number', $data['Catalog'])->select('cid')->first();
        if($getCatalog && $getCatalog !== null) {
            $saveNode = DB::table('nodes')->insertGetId([
                'n_name_en' => $data['Name Eng.'],
                'n_title_en' => $data['Name Eng.'],
                'n_description_en' => null,
                'n_name_ar' => $data['Name Ar.'],
                'n_title_ar' => $data['Name Ar.'],
                'n_description_ar' => null,
                'has_photo' => $data['Has photo'],
                'in_stock' => $data['In stock'],
                'is_special' => $data['Is speial'],
                'price' => $data['Price'],
                'special_price' => $specialPrice,
                'created_at' => Carbon::now()
            ]);
            // Save to catalog
            DB::table('nodes_to_catalog')->insert([
                'node' => $saveNode,
                'catalog' => $getCatalog->cid
            ]);

            DB::table('nodes_machinery_fields')->insert([
                'node' => $saveNode,
                'nmf_name_en' => $data['Name Eng.'],
                'nmf_body_en' => null,
                'nmf_description_en' => null,
                'nmf_short_en' => null,
                'nmf_name_ar' => $data['Name Ar.'],
                'nmf_body_ar' => null,
                'nmf_description_ar' => null,
                'nmf_short_ar' => null,
                'our_id' => $data['OUR ID']
            ]);
        }
        return true;
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
            'nmf_description_en' => $data['seoDescriptionEn'],
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
     * @param array $nodes
     * @param int $type
     * @param int $perPage
     * @param string $orderingTarget
     * @param string $orderingType
     * @return mixed
     */
    public function getNodesByType(array $nodes, int $type, $perPage = 45, $orderingTarget = 'price', $orderingType = 'ASC')
    {
        $get = DB::table('nodes')->whereIn('nodes.nid', $nodes);
        switch($type) {
            case 0:
                $get->join('nodes_machinery_fields', 'nodes.nid', '=', 'nodes_machinery_fields.node');
                break;
            case 1:
                $get->join('nodes_parts_fields', 'nodes.nid', '=', 'nodes_parts_fields.node');
                break;
            default:
                break;
        }
        $get->leftJoin('nodes_images', function($join) {
            $join->on('nodes.nid', '=', 'nodes_images.node')
                ->where('nodes_images.is_featured', '=', 1);
        });
        return $get
            ->orderBy('nodes.' . $orderingTarget, $orderingType)
            ->paginate($perPage);
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
            case 0:
                $get->join('nodes_machinery_fields', 'nodes.nid', '=', 'nodes_machinery_fields.node');
                break;
            case 1:
                $get->join('nodes_parts_fields', 'nodes.nid', '=', 'nodes_parts_fields.node');
                break;
            default:
                break;
        }
        return $get->first();
    }

    /**
     * @param $nid
     * @param $type
     * @return mixed
     */
    public function getNodeByCatalogType($nid, $type)
    {
        $get = DB::table('nodes')->where('nid', $nid);
        switch($type) {
            case 0:
                $get->leftJoin('nodes_machinery_fields', 'nodes.nid', '=', 'nodes_machinery_fields.node');
                break;
            case 1:
                $get->leftJoin('nodes_parts_fields', 'nodes.nid', '=', 'nodes_parts_fields.node');
                break;
            default:
                break;
        }
        return $get->first();
    }

    /**
     * @param $search
     * @return mixed
     */
    public function getNodesBySearchRequest($search)
    {
        $get = DB::table('nodes')->where('nodes.n_name_en', 'like', '%' . $search .'%');
        $get->leftJoin('nodes_images', function($join) {
            $join->on('nodes.nid', '=', 'nodes_images.node')
                ->where('nodes_images.is_featured', '=', 1);
        });
        return $get->paginate(50);
    }

    /**
     * @param $search
     * @return mixed
     */
    public function getNodesBySearchRequestSecured($search)
    {
        $get = DB::table('nodes')->where('nodes.n_name_en', 'like', '%' . $search .'%')
            ->join('nodes_to_catalog', 'nodes.nid', '=', 'nodes_to_catalog.node')
            ->leftJoin('catalog', 'nodes_to_catalog.catalog', '=', 'catalog.cid');
        $get->leftJoin('nodes_images', function($join) {
            $join->on('nodes.nid', '=', 'nodes_images.node')
                ->where('nodes_images.is_featured', '=', 1);
        });
        return $get->paginate(50);
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

    /**
     * @param $nid
     * @param $param
     * @return mixed
     */
    public function getNodeImagesWithParams($nid, $param)
    {
        $get = DB::table('nodes_images')->where('node', $nid)->where('is_featured', $param);

        switch ($param) {
            case 1:
                return $get->first();
                break;
            case 0:
                return $get->get();
                break;
            default:
                return $get->get();
                break;
        }
    }

    /**
     * @param $fig_number
     * @return mixed
     */
    public function getNodesForFigure($fig_number)
    {
        return DB::table('figures_to_nodes')
            ->where('figures_to_nodes.figure', $fig_number)
            ->join('nodes_parts_fields', 'figures_to_nodes.node', '=', 'nodes_parts_fields.node')
            ->leftJoin('nodes', 'nodes_parts_fields.node', '=', 'nodes.nid')
            ->leftJoin('nodes_images', function($join) {
                $join->on('nodes.nid', '=', 'nodes_images.node')
                    ->where('nodes_images.is_featured', '=', 1);
            })
            ->orderBy('nodes_parts_fields.pos_no', 'ASC')
            ->get();
    }

    /**
     * @return mixed
     */
    public function countPartsNodes()
    {
        return DB::table('nodes_parts_fields')->count();
    }

    /**
     * @return mixed
     */
    public function countEquipmentsNodes()
    {
        return DB::table('nodes_machinery_fields')->count();
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

    /**
     * @param $nid
     * @param $data
     * @return bool
     */
    public function updateBasicPartsNodeFromCSV($nid, $data)
    {
        $specialPrice = 0;
        if($data['Special price'] != '' && $data['Special price'] !== null) {
            $specialPrice = $data['Special price'];
        }

        $getCatalog = DB::table('catalog')->where('cat_number', $data['Catalog'])->select('cid')->first();

        if($getCatalog && $getCatalog !== null) {
            $saveNode = DB::table('nodes')->where('nid', $nid)->update([
                'n_name_en' => $data['Drawing name Eng.'] . ' - ' . $data['Name Eng.'],
                'n_title_en' => $data['Drawing name Eng.'] . ' - ' . $data['Name Eng.'],
                'n_description_en' => $data['Drawing name Eng.'] . ' - ' . $data['Name Eng.'],
                'n_name_ar' => $data['Drawing  name Ar.'] . ' - ' . $data['Name Ar.'],
                'n_title_ar' => $data['Drawing  name Ar.'] . ' - ' . $data['Name Ar.'],
                'n_description_ar' => $data['Drawing  name Ar.'] . ' - ' . $data['Name Ar.'],
                'has_photo' => $data['Has photo'],
                'in_stock' => $data['In stock'],
                'is_special' => $data['Is speial'],
                'price' => $data['Price'],
                'special_price' => $specialPrice,
                'updated_at' => Carbon::now()
            ]);
            // Save to catalog
            DB::table('nodes_to_catalog')->where('node', $nid)->update([
                'catalog' => $getCatalog->cid
            ]);
            // Save parts fields
            $positionNumber = null;
            $qty = null;
            if($data['Pos. No.'] != '' && $data['Pos. No.'] !== null) {
                $positionNumber = $data['Pos. No.'];
            }
            if($data['Q-ty on the drawing'] != '' && $data['Q-ty on the drawing'] !== null) {
                $qty = $data['Q-ty on the drawing'];
            }
            $producerId = $data['Producer ID'];
            if(strlen($producerId) > 200) {
                $producerId = substr($producerId, 0, 200);
            }
            DB::table('nodes_parts_fields')->where('node', $nid)->update([
                'group' => (int)$data['Group No.'],
                'fig_no' => $data['Drawing No.'],
                'pos_no' => (int)$positionNumber,
                'qty' => (int)$qty,
                'producer_id' => $producerId,
                'our_id' => $data['OUR ID'],
                'fig_name_en' => $data['Drawing name Eng.'],
                'npf_name_en' => $data['Name Eng.'],
                'fig_name_ar' => $data['Drawing  name Ar.'],
                'npf_name_ar' => $data['Name Ar.']
            ]);
        }
        return true;
    }

    /**
     * @param $nid
     * @param $data
     * @return bool
     */
    public function updateEQNodeFromCSV($nid, $data)
    {
        $specialPrice = 0;
        if($data['Special price'] != '' && $data['Special price'] !== null) {
            $specialPrice = $data['Special price'];
        }
        $getCatalog = DB::table('catalog')->where('cat_number', $data['Catalog'])->select('cid')->first();
        if($getCatalog && $getCatalog !== null) {
            $saveNode = DB::table('nodes')->where('nid', $nid)->update([
                'n_name_en' => $data['Name Eng.'],
                'n_title_en' => $data['Name Eng.'],
                'n_description_en' => null,
                'n_name_ar' => $data['Name Ar.'],
                'n_title_ar' => $data['Name Ar.'],
                'n_description_ar' => null,
                'has_photo' => $data['Has photo'],
                'in_stock' => $data['In stock'],
                'is_special' => $data['Is speial'],
                'price' => $data['Price'],
                'special_price' => $specialPrice,
                'created_at' => Carbon::now()
            ]);
            // Save to catalog
            DB::table('nodes_to_catalog')->where('node', $nid)->update([
                'catalog' => $getCatalog->cid
            ]);

            DB::table('nodes_machinery_fields')->where('node', $nid)->update([
                'nmf_name_en' => $data['Name Eng.'],
                'nmf_name_ar' => $data['Name Ar.']
            ]);
        }
        return true;
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
