<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Image;
use DB;

class Figure extends Model
{
    protected $table = 'figures';

    protected $primaryKey = 'fig_id';

    protected $fillable = ['fig_no', 'fig_image', 'catalog'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function catalog()
    {
        return $this->hasOne(Catalog::class, 'cat_number', 'catalog');
    }

    public function nodes()
    {
        return $this->belongsToMany(Node::class, 'figures_to_nodes', 'figure', 'node')->withPivot(['pos_x', 'pos_y', 'size_x', 'size_y', 'color']);
    }

    /**
     * Get nodes with parts
     * Return array with nested 2 array
     * inTheDraw contain parts where position number > 0
     * notInTheDraw contain parts where position number == 0
     *
     * @return array
     */
    public function getSeparatedNodesWithParts()
    {
        $nodes = [
            'inTheDraw' => [],
            'notInTheDraw' => []
        ];

        $this->nodes()->with('part')->get()->map(function ($node) use (&$nodes) {
            $type = $node->part->pos_no ? 'inTheDraw' : 'notInTheDraw';

            $nodes[$type][] = $node;
        });

        return $nodes;
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
        if($size !== NULL) {
            $imageWidth = getimagesize($image2)[0];
            $imageHeight = getimagesize($image2)[1];
            $imageSave = Image::make($image2->getRealPath());
            if($imageWidth >= $imageHeight) {
                $imageSave->resize(700, null, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            } else {
                $imageSave->resize(null, 700, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            $imageSave->save($path);
        } else {
            Image::make($image2->getRealPath())->save($path);
        }
        return $filename_to_store;
    }

    /**
     * @param $figure
     * @param $fig_no
     * @return bool
     */
    public static function createOrUpdateNodeForFigure($figure, $fig_no)
    {
        $get = DB::table('nodes_parts_fields')->where('fig_no', $fig_no)->get();
        foreach ($get as $value) {
            $count = DB::table('figures_to_nodes')->where('node', $value->node)->where('figure', $figure)->count();
            if ($count === 0) {
                DB::table('figures_to_nodes')->insert([
                    'node' => $value->node,
                    'figure' => $figure,
                    'pos_x' => 0,
                    'pos_y' => 0,
                    'size_x' => 18,
                    'size_y' => 18,
                    'color' => 'RGB(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')'
                ]);
            }
        }
        return true;
    }
    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $data
     * @param $file
     * @return mixed
     */
    public function initFigure($data, $file)
    {
        // Create figure
        $createFigure = DB::table('figures')->insertGetId([
            'fig_no' => $data['figureNumber'],
            'fig_image' => $this->proceedNodeImage($file, 850, 'figures'),
            'catalog' => $data['figureCategory']
        ]);
        // Create Catalog Item
        DB::table('catalog')->insert([
            'cat_number' => uniqid(),
            'parent_cat' => $data['figureCategory'],
            'cat_type' => 1,
            'is_drawing' => 1,
            'cat_name_en' => 'Drawing',
            'cat_name_ar' => 'رسم',
            'created_at' => Carbon::now(),
            'figure' => $createFigure
        ]);
        return $createFigure;
    }

    //======================================================================
    // UPDATE
    //======================================================================
    /**
     * @param $data
     * @return mixed
     */
    public function saveParamsForFigureNode($data)
    {
        return DB::table('figures_to_nodes')->where('node', $data['id'])->where('figure', $data['fig_id'])->update([
            'pos_x' => $data['pos_x'],
            'pos_y' => $data['pos_y'],
            'size_x' => $data['size_x'],
            'size_y' => $data['size_y']
        ]);
    }
    /**
     * @param $data
     * @return mixed
     */
    public function clearFigureNode($data)
    {
        return DB::table('figures_to_nodes')->where('node', $data['id'])->where('figure', $data['fig_id'])->update([
            'pos_x' => 0,
            'pos_y' => 0
        ]);
    }
    //======================================================================
    // DELETE
    //======================================================================
    /**
     * @param $figure
     * @param $catalog
     * @return mixed
     */
    public function removeFigure($figure, $catalog)
    {
        // Remove catalog
        DB::table('catalog')->where('parent_cat', $catalog)->where('cat_name_en', 'Figure')->delete();
        // Remove Nodes
        DB::table('figures_to_nodes')->where('figure', $figure)->delete();
        // Remove Figure
        return DB::table('figures')->where('fig_id', $figure)->delete();
    }
}
