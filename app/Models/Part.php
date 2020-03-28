<?php

namespace App\Models;

use App\Services\MediaService;
use App\Traits\{Excludable, Filterable, Saleable, Translatable};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\{HasMedia, HasMediaTrait};
use Spatie\MediaLibrary\Models\Media;

class Part extends Model implements HasMedia
{
    use HasMediaTrait, Excludable, Translatable, Saleable, Filterable;

    protected $fillable = [
        'name', 'name_ar', 'price', 'special_price', 'producer_id', 'is_special', 'qty', 'equipment_id'
    ];

    protected $appends = ['in_stock', 'current_price'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy(DB::raw("IF(qty > 0, 1, 0)"), 'desc');
            $builder->orderBy(DB::raw("IF(is_special = 0, price, special_price)"), 'asc');
        });

        self::saving(function($part) {
            MediaService::store($part, [
                'main_image', 'additional_images'
            ]);
        });

        self::deleting(function ($part) {
            MediaService::destroy($part, [
                'main_image', 'additional_images'
            ]);
        });
    }

    /**
     * Register collection names
     * Only single main_image
     * Return blank image if not exists
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('main_image')
            ->useFallbackUrl('/assets/blank.png')
            ->useFallbackPath(public_path('/assets/blank.png'))
            ->singleFile();

        $this->addMediaCollection('additional_images')
            ->useFallbackUrl('/images/blank.jpg')
            ->useFallbackPath(public_path('/images/blank.jpg'));
    }

    /**
     * Register sizes for media collections
     *
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);

        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300);

        $this->addMediaConversion('large')
            ->watermark(public_path('/assets/blank.png'))
            ->watermarkOpacity(40)
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkFit(Manipulations::FIT_STRETCH);
    }

    /**
     * Check if part in stock
     *
     * @return bool
     */
    public function getInStockAttribute()
    {
        return $this->qty ? true : false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unitParts()
    {
        return $this->hasMany(UnitPart::class);
    }
}
