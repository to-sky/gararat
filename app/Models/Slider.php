<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use DB;

class Slider extends Model
{
    protected $table = 'slider';

    protected $primaryKey = 'sl_id';

    protected $fillable = ['sl_order', 'sl_title', 'sl_description', 'sl_image'];

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
}
