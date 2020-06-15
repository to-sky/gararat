<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use Translatable;

    protected $casts = [
        'phones' => 'array'
    ];

    protected $fillable = [
        'name', 'name_ar', 'address', 'address_ar', 'email', 'phones', 'lat', 'lng'
    ];
}
