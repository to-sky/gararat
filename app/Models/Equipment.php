<?php

namespace App\Models;

use App\Services\MediaService;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Equipment extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $casts = [
        'specifications' => 'array',
    ];

    protected $fillable = [
        'name', 'name_ar', 'description', 'description_ar', 'price', 'special_price', 'in_stock', 'is_special',
        'equipment_group_id', 'specifications', 'manufacturer_id', 'site_position'
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($equipment) {
            MediaService::store($equipment, [
                'main_image', 'additional_images'
            ]);
        });

        self::deleting(function ($equipment) {
            MediaService::destroy($equipment, [
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
            ->useFallbackUrl('images/blank.jpg')
            ->useFallbackPath(public_path('images/blank.jpg'))
            ->singleFile();

        $this->addMediaCollection('additional_images')
            ->useFallbackUrl('images/blank.jpg')
            ->useFallbackPath(public_path('images/blank.jpg'));
    }

    /**
     * Register sizes for media collections
     *
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->performOnCollections('main_image', 'additional_images');

        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300)
            ->performOnCollections('main_image', 'additional_images');
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

    /**
     * Show Yes or No if equipment in_stock
     *
     * @return string
     */
    public function displayInStock()
    {
        return $this->in_stock ? 'Yes' : 'No';
    }

    /**
     * Get price current price with special condition
     *
     * @return mixed
     */
    public function getCurrentPriceAttribute()
    {
        $currentPrice = (float) $this->is_special ? $this->special_price : $this->price;

        return number_format($currentPrice, 2, '.', ',' );
    }

    // TODO: refactor this
    public function displayPrice()
    {
        $price = number_format($this->price, 2, '.', ',');
        $specialPrice = number_format($this->special_price, 2, '.', ',');

        if($this->is_special) {
            return "$specialPrice <small><s>$price</s></small>";
        }

        return $price;
    }
}
