<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeImage extends Model
{
    protected $table = 'nodes_images';

    protected $primaryKey = 'ni_id';

    public $timestamps = false;

    protected $fillable = ['node', 'full_path', 'mid_path', 'thumb_path', 'is_featured'];
}
