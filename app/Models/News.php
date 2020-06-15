<?php

namespace App\Models;

use App\Events\NewsCreated;
use App\Services\MediaService;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class News extends Model implements HasMedia
{
    use HasMediaTrait, Translatable;

    protected $fillable = [
        'title', 'title_ar', 'slug', 'short_description', 'short_description_ar', 'body', 'body_ar', 'created_at'
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($news) {
            MediaService::store($news, 'thumbnail');
        });

        self::created(function($news) {
            event(new NewsCreated($news));
        });

        self::deleting(function ($news) {
            MediaService::destroy($news, ['thumbnail']);
        });
    }

    /**
     * Register collection names
     * Only single main_image
     * Return blank image if not exists
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('thumbnail')
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Link to news
     *
     * @return string
     */
    public function link()
    {
        return route('news.show', $this);
    }
}
