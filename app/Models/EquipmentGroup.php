<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class EquipmentGroup extends Model
{
    use Translatable;

    protected $fillable = [
        'name', 'name_ar'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function units()
    {
        return $this->hasManyThrough(Unit::class, Equipment::class);
    }
}
