<?php

namespace App\Models;

use App\Services\MediaService;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Slide extends Model implements HasMedia
{
    use HasMediaTrait, Translatable;

    const TEXT_LEFT = 0;
    const TEXT_CENTER = 1;
    const TEXT_RIGHT = 2;

    protected $fillable = [
        'title', 'title_ar', 'sub_title', 'sub_title_ar', 'link', 'slide_number', 'text_position'
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('slide_number', 'asc');
        });

        self::saving(function($part) {
            MediaService::store($part, 'home_slide');
        });

        self::deleting(function ($part) {
            MediaService::destroy($part, ['home_slide']);
        });
    }

    /**
     * Register collection names
     * Only single main_image
     * Return blank image if not exists
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('home_slide')
            ->useFallbackUrl('/assets/blank.png')
            ->useFallbackPath(public_path('/assets/blank.png'))
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

        $this->addMediaConversion('large')
            ->height(500);
    }

    /**
     * Return all positions
     *
     * @return array
     */
    public static function getTextPositions()
    {
        return [
            self::TEXT_LEFT => 'Left',
            self::TEXT_CENTER => 'Center',
            self::TEXT_RIGHT => 'Right'
        ];
    }

    /**
     * Display text position
     *
     * @param bool $toLower
     * @return string
     */
    public function displayTextPosition($toLower = false)
    {
        $textPosition = $this->getTextPositions()[$this->text_position];

        return $toLower ? strtolower($textPosition) : $textPosition;
    }
}
