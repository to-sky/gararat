<?php

namespace App\Models;

use App\Services\MediaService;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class EquipmentCategory extends Model implements HasMedia
{
    use HasMediaTrait, Translatable;

    protected $fillable = [
        'name', 'name_ar', 'description', 'description_ar', 'parent_id'
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($equipmentCategory) {
            if ($equipmentCategory->isParent()) {
                MediaService::store($equipmentCategory, 'image');
            }
        });

        self::deleting(function($equipmentCategory) {
            if ($equipmentCategory->isParent()) {
                MediaService::destroy($equipmentCategory, ['image']);
            }
        });
    }

    /**
     * Register collection names
     * Only single main_image
     * Return blank image if not exists
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')
            ->useFallbackUrl(MediaService::BLANK_IMAGE_PATH)
            ->useFallbackPath(public_path(MediaService::BLANK_IMAGE_PATH))
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
            ->height(150);

        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300);
    }

    /**
     * @return HasMany
     */
    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * Create or update subcategories
     *
     * @param $subcategories
     * @return $this|false
     */
    public function updateOrCreateSubcategories($subcategories) {
        if (! $subcategories) return false;

        foreach ($subcategories as $subcategory) {
            if (! isset($subcategory['name']) || ! isset($subcategory['name_ar'])) {
               continue;
            }

            EquipmentCategory::updateOrCreate([
                'id' => $subcategory['id'] ?? ''
            ],
            [
                'name' => $subcategory['name'],
                'name_ar' => $subcategory['name_ar'],
                'parent_id' => $this->id
            ]);
        }

        return $this;
    }

    /**
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(static::class, 'id', 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function childs(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    /**
     * Get only parent categories
     *
     * @param $query
     */
    public function scopeParentCategories($query)
    {
        $query->whereNull('parent_id');
    }

    /**
     * Check if this category is child
     *
     * @return bool
     */
    public function isParent(): bool
    {
        return is_null($this->parent_id);
    }
}
