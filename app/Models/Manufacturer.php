<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use Translatable;

    protected $fillable = [
        'name', 'name_ar'
    ];

    protected $guarded = [];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
