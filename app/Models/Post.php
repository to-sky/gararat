<?php

namespace App\Models;

use App\Events\PostCreated;
use App\Services\MediaService;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia
{
    use HasMediaTrait, Translatable;

    const TYPE_NEWS = 0;
    const TYPE_ARTICLE = 1;
    const TYPE_VIDEO = 2;

    protected $fillable = [
        'title', 'title_ar', 'slug', 'short_description', 'short_description_ar', 'body', 'body_ar', 'created_at',
        'is_published', 'type'
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($post) {
            MediaService::store($post, 'thumbnail');
        });

        self::created(function($post) {
            if($post->type !== self::TYPE_VIDEO) {
                event(new PostCreated($post));
            }
        });

        self::deleting(function ($post) {
            MediaService::destroy($post, ['thumbnail']);
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
     * Link to the post
     *
     * @return string
     */
    public function link()
    {
        return route('posts.show', $this);
    }

    public static function getPublishedAndGrouped() {
        return self::whereIsPublished(1)->get()->groupBy('type');
    }

    /**
     * Return all post types
     *
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_NEWS => 'News',
            self::TYPE_ARTICLE => 'Articles',
            self::TYPE_VIDEO => 'Videos'
        ];
    }

    /**
     * Display post type
     *
     * @return string
     */
    public function displayType()
    {
        return $this->getTypes()[$this->type] ?? 'Type is not defined';
    }

    /**
     * Display post status
     *
     * @return string
     */
    public function displayStatus()
    {
        return $this->is_published ? 'Published' : 'Druft';
    }
}
