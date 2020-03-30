<?php

namespace App\Models;

use App\Services\MediaService;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class News extends Model implements HasMedia
{
    use HasMediaTrait, Translatable;

    protected $fillable = [
        'title', 'title_ar', 'short_description', 'short_description_ar', 'body', 'body_ar', 'created_at'
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($news) {
            MediaService::store($news, ['news_images']);

            $news->slug = Str::slug($news->title.'-'.$news->created_at->toDateString());
        });

        self::deleting(function ($news) {
            MediaService::destroy($news, ['news_images']);
        });
    }

    /**
     * Register collection names
     * Only single main_image
     * Return blank image if not exists
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('news_images')
            ->useFallbackUrl('/assets/blank.png')
            ->useFallbackPath(public_path('/assets/blank.png'));
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
