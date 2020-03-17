<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentGroup extends Model
{
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
}
