<?php

namespace App\Models;

use App\Services\MediaService;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Slide extends Model implements HasMedia
{
    use HasMediaTrait, Translatable;

    const BTN_LEFT = 0;
    const BTN_CENTER = 1;
    const BTN_RIGHT = 2;

    protected $fillable = [
        'body', 'body_ar', 'link', 'slide_number', 'blackout', 'btn_position'
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('slide_number', 'asc');
        });

        self::saving(function($part) {
            MediaService::store($part, [
                'home_slide', 'home_slide_mobile'
            ]);
        });

        self::deleting(function ($part) {
            MediaService::destroy($part, [
                'home_slide', 'home_slide_mobile'
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
        $this->addMediaCollection('home_slide')
            ->useFallbackUrl(MediaService::BLANK_IMAGE_PATH)
            ->useFallbackPath(public_path(MediaService::BLANK_IMAGE_PATH))
            ->singleFile();

        $this->addMediaCollection('home_slide_mobile')
            ->useFallbackUrl(MediaService::BLANK_IMAGE_PATH)
            ->useFallbackPath(public_path(MediaService::BLANK_IMAGE_PATH))
            ->singleFile();
    }

    /**
     * Register sizes for media collections
     *
     * @param Media|null $media
     * @throws InvalidManipulation
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
    public static function getBtnPositions()
    {
        return [
            self::BTN_LEFT => 'Left',
            self::BTN_CENTER => 'Center',
            self::BTN_RIGHT => 'Right'
        ];
    }

    /**
     * Display btn position
     *
     * @param bool $toLower
     * @return string
     */
    public function displayBtnPosition($toLower = false)
    {
        $btnPosition = $this->getBtnPositions()[$this->btn_position];

        return $toLower ? strtolower($btnPosition) : $btnPosition;
    }
}
