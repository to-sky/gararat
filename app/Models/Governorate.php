<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use Translatable;

    protected $fillable = ['name', 'name_ar'];
}
