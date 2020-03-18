<?php

namespace App\Models;

use App\Services\MediaService;
use App\Traits\Excludable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Part extends Model implements HasMedia
{
    use HasMediaTrait, Excludable;

    protected $fillable = [
        'name', 'name_ar', 'price', 'special_price', 'producer_id', 'is_special', 'qty', 'equipment_id'
    ];

    protected static function boot()
    {
        parent::boot();

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
     * Display price with html structure
     *
     * @return string
     */
    public function displayPrice()
    {
        // TODO: refactor this
        $price = number_format($this->price, 2, '.', ',');
        $specialPrice = number_format($this->special_price, 2, '.', ',');

        if($this->is_special) {
            return "$specialPrice <small><s>$price</s></small>";
        }

        return $price;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unitParts()
    {
        return $this->hasMany(UnitPart::class);
    }
}
