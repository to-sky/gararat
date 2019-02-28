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

    //======================================================================
    // UPDATE
    //======================================================================

    //======================================================================
    // DELETE
    //======================================================================

}
