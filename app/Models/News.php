<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use DB;

use \App\Models\Nodes;

class News extends Model
{
    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $data
     * @param $file
     * @return mixed
     */
    public function createNewsItem($data, $file)
    {
        $nodeModel = new Nodes;
        return DB::table('news')->insert([
            'nw_name' => $data['newsName'],
            'nw_body' => $data['newsBody'],
            'nw_title' => $data['newsTitle'],
            'nw_description' => $data['newsDescription'],
            'nw_image' => $nodeModel->proceedNodeImage($file, NULL, 'news'),
            'nw_created' => Carbon::now(),
        ]);
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
