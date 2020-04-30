<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use App\Services\MediaService;

class Unit extends Model implements HasMedia
{
    use HasMediaTrait;

    public $timestamps = false;

    protected $fillable = [
        'equipment_id', 'catalog_id'
    ];

    protected static function boot()
    {
        parent::boot();

        self::deleting(function ($unit) {
            MediaService::destroy($unit, ['figure']);
        });
    }

    /**
     * Register collection names
     * Only single main_image
     * Return blank image if not exists
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('figure')
            ->useFallbackUrl('images/blank.png')
            ->useFallbackPath(public_path('images/blank.png'))
            ->singleFile();
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
            ->performOnCollections('figure');

        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300)
            ->performOnCollections('figure');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalog()
    {
        return $this->belongsTo(Catalog::class)->with('parent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unitParts()
    {
        return $this->hasMany(UnitPart::class)->with('part');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function parts()
    {
        return $this->hasManyThrough(Part::class, UnitPart::class, 'unit_id', 'id', 'id', 'part_id')->withoutGlobalScope('sort');
    }
}
