<?php

namespace App\Models;

use App\Services\MediaService;
use App\Traits\{Excludable, Filterable, Saleable, Translatable};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\{HasMedia, HasMediaTrait};
use Spatie\MediaLibrary\Models\Media;

class Equipment extends Model implements HasMedia
{
    use HasMediaTrait, Excludable, Translatable, Saleable, Filterable;

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

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('site_position', 'asc');
        });

        self::saving(function($equipment) {
            MediaService::store($equipment, [
                'main_image', 'additional_images'
            ]);

            $equipment->slug = Str::slug($equipment->name);
        });

        self::deleting(function ($equipment) {
            MediaService::destroy($equipment, [
                'main_image', 'additional_images'
            ]);
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
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
