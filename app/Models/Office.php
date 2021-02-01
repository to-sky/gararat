<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use Translatable;

    protected $casts = [
        'phones' => 'array'
    ];

    protected $fillable = [
        'name', 'name_ar', 'address', 'address_ar', 'email', 'phones', 'lat', 'lng', 'site_position'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('site_position', 'asc');
        });
    }

    /**
     * Get last site position attribute
     *
     * @return int
     */
    public static function getLastSitePosition()
    {
        return Office::max('site_position');
    }
}
