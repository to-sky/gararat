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
    /**
     * @param $perPage
     * @return mixed
     */
    public function getAllNews($perPage)
    {
        return DB::table('news')->orderBy('nw_created', 'DESC')->paginate($perPage);
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getLimitedNews($limit)
    {
        return DB::table('news')->orderBy('nw_created', 'DESC')->limit($limit)->get();
    }

    /**
     * @param $nw_id
     * @return mixed
     */
    public function getNewsItemById($nw_id)
    {
        return DB::table('news')->where('nw_id', $nw_id)->first();
    }
    //======================================================================
    // UPDATE
    //======================================================================
    /**
     * @param $data
     * @param $file
     * @return mixed
     */
    public function updateNewsItem($data, $file)
    {
        $nodeModel = new Nodes;
        if($file !== NULL) {
            return DB::table('news')->where('nw_id', $data['nw_id'])->update([
                'nw_name' => $data['newsName'],
                'nw_body' => $data['newsBody'],
                'nw_title' => $data['newsTitle'],
                'nw_description' => $data['newsDescription'],
                'nw_image' => $nodeModel->proceedNodeImage($file, NULL, 'news'),
            ]);
        } else {
            return DB::table('news')->where('nw_id', $data['nw_id'])->update([
                'nw_name' => $data['newsName'],
                'nw_body' => $data['newsBody'],
                'nw_title' => $data['newsTitle'],
                'nw_description' => $data['newsDescription']
            ]);
        }
    }
    //======================================================================
    // DELETE
    //======================================================================
    /**
     * @param $nw_id
     * @return mixed
     */
    public function removeNewsItem($nw_id)
    {
        return DB::table('news')->where('nw_id', $nw_id)->delete();
    }
}
