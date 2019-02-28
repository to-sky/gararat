<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Image;
use DB;

class Figures extends Model
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
            $imageWidth = getimagesize($image2)[0];
            $imageHeight = getimagesize($image2)[1];
            $imageSave = Image::make($image2->getRealPath());
            if($imageWidth >= $imageHeight) {
                $imageSave->resize(850, null, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            } else {
                $imageSave->resize(null, 800, function($constraint) {
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
     * @param $nid
     * @param $figure
     * @return bool
     */
    public function createOrUpdateNodeForFigure($nid, $figure)
    {
        $count = DB::table('figures_to_nodes')->where('node', $nid)->count();
        if($count === 0) {
            return DB::table('figures_to_nodes')->insert([
                'node' => $nid,
                'figure' => $figure,
                'pos_x' => 0,
                'pos_y' => 0,
                'size_x' => 28,
                'size_y' => 22
            ]);
        } else {
            return false;
        }
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
            'cat_name_en' => 'Figure',
            'created_at' => Carbon::now()
        ]);
        return $createFigure;
    }
    //======================================================================
    // READ
    //======================================================================
    /**
     * @param $fig_id
     * @return mixed
     */
    public function getFigureById($fig_id)
    {
        return DB::table('figures')->where('fig_id', $fig_id)->first();
    }
    //======================================================================
    // UPDATE
    //======================================================================

    //======================================================================
    // DELETE
    //======================================================================

}
