<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Part extends Product
{
    protected $fillable = [
        'name', 'name_ar', 'price', 'slug', 'special_price', 'producer_id', 'is_special', 'qty', 'equipment_id'
    ];

    protected $casts = [
        'price' => 'float',
        'special_price' => 'float'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy(DB::raw("IF(qty > 0, 1, 0)"), 'desc');
            $builder->orderBy(DB::raw("IF(is_special = 0, price, special_price)"), 'asc');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unitParts()
    {
        return $this->hasMany(UnitPart::class);
    }
}
