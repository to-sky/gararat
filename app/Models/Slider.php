<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';

    protected $primaryKey = 'sl_id';

    protected $fillable = ['sl_order', 'sl_title', 'sl_description', 'sl_image'];

    public $timestamps = false;
}
