<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'name', 'name_ar'
    ];

    protected $guarded = [];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
