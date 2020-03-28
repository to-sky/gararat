<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Translatable;

    protected $table = 'news';

    protected $primaryKey = 'nw_id';

    protected $casts = [
       'nw_created' => 'datetime'
    ];

    protected $fillable = [
        'nw_name', 'nw_body', 'nw_title', 'nw_description', 'nw_created', 'nw_image', 'nw_name_ar', 'nw_title_ar',
        'nw_body_ar', 'nw_description_ar'
    ];

    public function getNwCreatedAtAttribute()
    {
        return $this->nw_created->format('Y-m-d');
    }


    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $data
     * @param $file
     * @return mixed
     */
//    public function createNewsItem($data, $file)
//    {
//        $nodeModel = new Node;
//        return DB::table('news')->insert([
//            'nw_name' => $data['newsName'],
//            'nw_body' => $data['newsBody'],
//            'nw_title' => $data['newsTitle'],
//            'nw_description' => $data['newsDescription'],
//            'nw_name_ar' => $data['newsNameAr'],
//            'nw_body_ar' => $data['newsBodyAr'],
//            'nw_title_ar' => $data['newsTitleAr'],
//            'nw_description_ar' => $data['newsDescriptionAr'],
//            'nw_image' => $nodeModel->proceedNodeImage($file, NULL, 'news'),
//            'nw_created' => $data['newsDate'],
//        ]);
//    }

    //======================================================================
    // READ
    //======================================================================

    //======================================================================
    // UPDATE
    //======================================================================
    /**
     * @param $data
     * @param $file
     * @return mixed
     */
//    public function updateNewsItem($data, $file)
//    {
//        $nodeModel = new Node;
//        if($file !== NULL) {
//            return DB::table('news')->where('nw_id', $data['nw_id'])->update([
//                'nw_name' => $data['newsName'],
//                'nw_body' => $data['newsBody'],
//                'nw_title' => $data['newsTitle'],
//                'nw_description' => $data['newsDescription'],
//                'nw_name_ar' => $data['newsNameAr'],
//                'nw_body_ar' => $data['newsBodyAr'],
//                'nw_title_ar' => $data['newsTitleAr'],
//                'nw_description_ar' => $data['newsDescriptionAr'],
//                'nw_image' => $nodeModel->proceedNodeImage($file, NULL, 'news'),
//                'nw_created' => $data['newsDate'],
//            ]);
//        } else {
//            return DB::table('news')->where('nw_id', $data['nw_id'])->update([
//                'nw_name' => $data['newsName'],
//                'nw_body' => $data['newsBody'],
//                'nw_title' => $data['newsTitle'],
//                'nw_description' => $data['newsDescription'],
//                'nw_name_ar' => $data['newsNameAr'],
//                'nw_body_ar' => $data['newsBodyAr'],
//                'nw_title_ar' => $data['newsTitleAr'],
//                'nw_description_ar' => $data['newsDescriptionAr'],
//                'nw_created' => $data['newsDate'],
//            ]);
//        }
//    }
    //======================================================================
    // DELETE
    //======================================================================
    /**
     * @param $nw_id
     * @return mixed
     */
//    public function removeNewsItem($nw_id)
//    {
//        return DB::table('news')->where('nw_id', $nw_id)->delete();
//    }
}
