<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Equipment extends Product
{
    protected $casts = [
        'main_specifications' => 'array',
        'specifications' => 'array',
        'price' => 'float',
        'special_price' => 'float'
    ];

    protected $fillable = [
        'name', 'name_ar', 'slug', 'description', 'description_ar', 'price', 'special_price', 'qty', 'is_special',
        'equipment_group_id', 'main_specifications', 'specifications', 'manufacturer_id', 'site_position'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('site_position', 'asc');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipmentGroup()
    {
        return $this->belongsTo(EquipmentGroup::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function catalogs()
    {
        return $this->hasManyThrough(
            Catalog::class,
            Unit::class,
            'equipment_id',
            'id',
            'id',
            'catalog_id'
        )->distinct();
    }
}
