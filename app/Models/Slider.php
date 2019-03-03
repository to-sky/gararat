<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use DB;

use \App\Models\Nodes;

class Slider extends Model
{
    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $data
     * @param $file
     * @return mixed
     */
    public function saveNewSlide($data, $file)
    {
        $nodeModel = new Nodes;
        $saveImage = $nodeModel->proceedNodeImage($file, null, 'slider');
        return DB::table('slider')->insert([
            'sl_order' => $data['positionNumber'],
            'sl_title' => $data['slideTitle'],
            'sl_description' => $data['sliderDescription'],
            'sl_image' => $saveImage,
        ]);
    }
    //======================================================================
    // READ
    //======================================================================
    /**
     * @return mixed
     */
    public function getAllSlides()
    {
        return DB::table('slider')->orderBy('sl_order', 'ASC')->get();
    }
    //======================================================================
    // UPDATE
    //======================================================================

    //======================================================================
    // DELETE
    //======================================================================
    /**
     * @param $sl_id
     * @return mixed
     */
    public function removeSlide($sl_id)
    {
        return DB::table('slider')->where('sl_id', $sl_id)->delete();
    }
}
