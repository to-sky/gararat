<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use DB;

use \App\Models\Node;

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
        $nodeModel = new Node;
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

    /**
     * @param $slider
     * @return mixed
     */
    public function getSliderById($slider)
    {
        return DB::table('slider')->where('sl_id', $slider)->first();
    }
    //======================================================================
    // UPDATE
    //======================================================================
    /**
     * @param $data
     * @param $file
     * @return mixed
     */
    public function updateSlider($data, $file)
    {
        if(isset($file) && $file !== null) {
            $nodeModel = new Node;
            $saveImage = $nodeModel->proceedNodeImage($file, null, 'slider');
            return DB::table('slider')->where('sl_id', $data['sliderId'])->update([
                'sl_order' => $data['positionNumber'],
                'sl_title' => $data['slideTitle'],
                'sl_description' => $data['sliderDescription'],
                'sl_image' => $saveImage,
            ]);
        } else {
            return DB::table('slider')->where('sl_id', $data['sliderId'])->update([
                'sl_order' => $data['positionNumber'],
                'sl_title' => $data['slideTitle'],
                'sl_description' => $data['sliderDescription']
            ]);
        }
    }
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
