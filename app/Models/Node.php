<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Image;
use DB;

class Node extends Model
{
    protected $fillable = [
        'n_name_en', 'n_title_en', 'n_description_en', 'n_name_ar', 'n_title_ar', 'n_description_ar', 'has_photo',
        'in_stock', 'is_special', 'price', 'special_price'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function part()
    {
        return $this->hasOne(Part::class, 'node');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function machinery()
    {
        return $this->hasOne(Machinery::class, 'node');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nodeImages()
    {
        return $this->hasMany(NodeImage::class, 'node');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_to_nodes', 'node', 'order')->withPivot('order_qty');
    }

    /**
     * Get thumbnail path for main image
     *
     * @return mixed
     */
    public function getMainImagePath()
    {
        if (! $mainImage = $this->nodeImages()->whereIsFeatured(1)->first()) {
            return null;
        }

        return $mainImage->thumb_path;
    }
    /**
     * Get image path or empty image path, if image is not uploaded
     *
     * @return mixed|string
     */
    public function getImageOrEmpty()
    {
        return $this->getMainImagePath() ?? 'assets/logos/logo.jpg';
    }

    /**
     * Get price current price with special condition
     *
     * @return mixed
     */
    public function getCurrentPriceAttribute()
    {
        $currentPrice = (float) $this->is_special ? $this->special_price : $this->price;

        return number_format($currentPrice, 2, '.', ',' );
    }

    public function getSumPerQtyAttribute()
    {
        $priceForOrder = $this->current_price * $this->pivot->order_qty;

        return number_format($priceForOrder, 2, '.', ',' );
    }

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
        if ($size !== NULL) {
            Image::make($image2->getRealPath())->resize($size, null, function ($constraint) {
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
        if ($checkIfNodeExist && $checkIfNodeExist !== null) {
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
        if ($checkIfNodeExist && $checkIfNodeExist !== null) {
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
        if ($data['seoTitleEn'] === NULL) {
            $seoTitleEn = $data['nameEn'];
        }
        if ($data['seoTitleAr'] === NULL) {
            $seoTitleAr = $data['nameAr'];
        }

        return $this->create([
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
        if ($data['Special price'] != '' && $data['Special price'] !== null) {
            $specialPrice = $data['Special price'];
        }

        $getCatalog = DB::table('catalog')->where('cat_number', $data['Catalog'])->select('cid')->first();

        if ($getCatalog && $getCatalog !== null) {
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
            if ($data['Pos. No.'] != '' && $data['Pos. No.'] !== null) {
                $positionNumber = $data['Pos. No.'];
            }
            if ($data['Q-ty on the drawing'] != '' && $data['Q-ty on the drawing'] !== null) {
                $qty = $data['Q-ty on the drawing'];
            }
            $producerId = $data['Producer ID'];
            if (strlen($producerId) > 200) {
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
        if ($data['Special price'] != '' && $data['Special price'] !== null) {
            $specialPrice = $data['Special price'];
        }

        $getCatalog = DB::table('catalog')->where('cat_number', $data['Catalog'])->select('cid')->first();
        if ($getCatalog && $getCatalog !== null) {
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
     * @param $id
     * @param $data
     * @return mixed
     */
    public function saveEquipmentNode($id, $data)
    {
        return DB::table('nodes_machinery_fields')->insert([
            'node' => $id,
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
     * @param $id
     * @param $data
     * @return mixed
     */
    public function savePartsNode($id, $data)
    {
        return DB::table('nodes_parts_fields')->insert([
            'node' => $id,
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
     * @param $id
     * @param $catalogs
     * @return bool
     */
    public function setNodeToCatalog($id, $catalogs)
    {
        $removeOldRecords = DB::table('nodes_to_catalog')->where('node', $id)->delete();
        foreach ($catalogs as $catalog) {
            $getCatalog = DB::table('catalog')->where('cat_number', $catalog)->first();
            DB::table('nodes_to_catalog')->insert([
                'node' => $id,
                'catalog' => $getCatalog->cid
            ]);
        }
        return TRUE;
    }

    /**
     * @param $id
     * @param $image
     * @param $isFeatured
     * @return mixed
     */
    public function saveNewNodeImage($id, $image, $isFeatured)
    {
        if (is_null($image)) return null;

        if ($isFeatured == 1) {
            NodeImage::where('node', $id)->where('is_featured', 1)->delete();
        }

        return NodeImage::create([
            'node' => $id,
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
        $get = DB::table('nodes')
            ->whereIn('nodes.id', $nodes)
            ->where('nodes.price', '>=', 0);
        switch ($type) {
            case 0:
                $get->join('nodes_machinery_fields', 'nodes.id', '=', 'nodes_machinery_fields.node');
                break;
            case 1:
                $get->join('nodes_parts_fields', 'nodes.id', '=', 'nodes_parts_fields.node');
                break;
            default:
                break;
        }
        $get->leftJoin('nodes_images', function ($join) {
            $join->on('nodes.id', '=', 'nodes_images.node')
                ->where('nodes_images.is_featured', '=', 1);
        });
        return $get
            ->orderBy('nodes.' . $orderingTarget, $orderingType)
            ->paginate($perPage);
    }

    /**
     * @param $id
     * @param $type
     * @return mixed
     */
    public function getNodeById($id, $type)
    {
        $get = DB::table('nodes')->where('id', $id);
        switch ($type) {
            case 0:
                $get->join('nodes_machinery_fields', 'nodes.id', '=', 'nodes_machinery_fields.node');
                break;
            case 1:
                $get->join('nodes_parts_fields', 'nodes.id', '=', 'nodes_parts_fields.node');
                break;
            default:
                break;
        }
        return $get->first();
    }

    /**
     * @param $id
     * @param $type
     * @return mixed
     */
    public function getNodeByCatalogType($id, $type)
    {
        $get = DB::table('nodes')->where('id', $id);
        switch ($type) {
            case 0:
                $get->leftJoin('nodes_machinery_fields', 'nodes.id', '=', 'nodes_machinery_fields.node');
                break;
            case 1:
                $get->leftJoin('nodes_parts_fields', 'nodes.id', '=', 'nodes_parts_fields.node');
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
        $get = DB::table('nodes')
            ->where('nodes.n_name_en', 'like', '%' . $search . '%')
            ->where('nodes.price', '>=', '0')
            ->leftJoin('nodes_machinery_fields', 'nodes.id', '=', 'nodes_machinery_fields.node')
            ->leftJoin('nodes_parts_fields', 'nodes.id', '=', 'nodes_parts_fields.node');
        $get->leftJoin('nodes_images', function ($join) {
            $join->on('nodes.id', '=', 'nodes_images.node')
                ->where('nodes_images.is_featured', '=', 1);
        });
        $return = $get->paginate(50);
        if (count($return) === 0) {
            $get = DB::table('nodes')
                ->where('nodes.price', '>=', '0')
                ->join('nodes_parts_fields', function ($join) use ($search) {
                    $join->on('nodes.id', '=', 'nodes_parts_fields.node')
                        ->where('nodes_parts_fields.producer_id', 'like', '%' . $search . '%');
                });
            $get->leftJoin('nodes_images', function ($join) {
                $join->on('nodes.id', '=', 'nodes_images.node')
                    ->where('nodes_images.is_featured', '=', 1);
            });
            return $get->paginate(50);
        } else {
            return $return;
        }
    }

    /**
     * @param $search
     * @return mixed
     */
    public function getNodesBySearchRequestSecured($search)
    {
        $get = DB::table('nodes')->where('nodes.n_name_en', 'like', '%' . $search . '%')
            ->join('nodes_to_catalog', 'nodes.id', '=', 'nodes_to_catalog.node')
            ->leftJoin('catalog', 'nodes_to_catalog.catalog', '=', 'catalog.cid');
        $get->leftJoin('nodes_images', function ($join) {
            $join->on('nodes.id', '=', 'nodes_images.node')
                ->where('nodes_images.is_featured', '=', 1);
        });
        $return = $get->paginate(50);
        if (count($return) === 0) {
            $get = DB::table('nodes')
                ->where('nodes.price', '>=', '0')
                ->join('nodes_to_catalog', 'nodes.id', '=', 'nodes_to_catalog.node')
                ->leftJoin('catalog', 'nodes_to_catalog.catalog', '=', 'catalog.cid')
                ->join('nodes_parts_fields', function ($join) use ($search) {
                    $join->on('nodes.id', '=', 'nodes_parts_fields.node')
                        ->where('nodes_parts_fields.producer_id', 'like', '%' . $search . '%');
                });
            $get->leftJoin('nodes_images', function ($join) {
                $join->on('nodes.id', '=', 'nodes_images.node')
                    ->where('nodes_images.is_featured', '=', 1);
            });
            return $get->paginate(50);
        } else {
            return $return;
        }
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
            if (!in_array($node->node, $nodes)) {
                $nodes[] = $node->node;
            }
        }
        return $nodes;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNodeImages($id)
    {
        return DB::table('nodes_images')->where('node', $id)->get();
    }

    /**
     * @param $id
     * @param $param
     * @return mixed
     */
    public function getNodeImagesWithParams($id, $param)
    {
        $get = DB::table('nodes_images')->where('node', $id)->where('is_featured', $param);

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
            ->leftJoin('nodes', 'nodes_parts_fields.node', '=', 'nodes.id')
            ->leftJoin('nodes_images', function ($join) {
                $join->on('nodes.id', '=', 'nodes_images.node')
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
        if ($data['seoTitleEn'] === NULL) {
            $seoTitleEn = $data['nameEn'];
        }
        if ($data['seoTitleAr'] === NULL) {
            $seoTitleAr = $data['nameAr'];
        }

        return DB::table('nodes')->where('id', $data['id'])->update([
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
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateEquipmentNode($data)
    {
        return DB::table('nodes_machinery_fields')->where('node', $data['id'])->update([
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
        return DB::table('nodes_parts_fields')->where('node', $data['id'])->update([
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
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateBasicPartsNodeFromCSV($id, $data)
    {
        $specialPrice = 0;
        if ($data['Special price'] != '' && $data['Special price'] !== null) {
            $specialPrice = $data['Special price'];
        }

        $getCatalog = DB::table('catalog')->where('cat_number', $data['Catalog'])->select('cid')->first();

        if ($getCatalog && $getCatalog !== null) {
            $saveNode = DB::table('nodes')->where('id', $id)->update([
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
            DB::table('nodes_to_catalog')->where('node', $id)->update([
                'catalog' => $getCatalog->cid
            ]);
            // Save parts fields
            $positionNumber = null;
            $qty = null;
            if ($data['Pos. No.'] != '' && $data['Pos. No.'] !== null) {
                $positionNumber = $data['Pos. No.'];
            }
            if ($data['Q-ty on the drawing'] != '' && $data['Q-ty on the drawing'] !== null) {
                $qty = $data['Q-ty on the drawing'];
            }
            $producerId = $data['Producer ID'];
            if (strlen($producerId) > 200) {
                $producerId = substr($producerId, 0, 200);
            }
            DB::table('nodes_parts_fields')->where('node', $id)->update([
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
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateEQNodeFromCSV($id, $data)
    {
        $specialPrice = 0;
        if ($data['Special price'] != '' && $data['Special price'] !== null) {
            $specialPrice = $data['Special price'];
        }
        $getCatalog = DB::table('catalog')->where('cat_number', $data['Catalog'])->select('cid')->first();
        if ($getCatalog && $getCatalog !== null) {
            $saveNode = DB::table('nodes')->where('id', $id)->update([
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
            DB::table('nodes_to_catalog')->where('node', $id)->update([
                'catalog' => $getCatalog->cid
            ]);

            DB::table('nodes_machinery_fields')->where('node', $id)->update([
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
     * @param $id
     * @return bool
     */
    public function removeNodeById($id)
    {
        DB::table('nodes_images')->where('node', $id)->delete();
        DB::table('nodes_machinery_fields')->where('node', $id)->delete();
        DB::table('nodes_parts_fields')->where('node', $id)->delete();
        DB::table('nodes_to_catalog')->where('node', $id)->delete();
        DB::table('nodes')->where('id', $id)->delete();

        return true;
    }
}