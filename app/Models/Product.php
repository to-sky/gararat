<?php

namespace App\Models;

use App\Services\CartService;
use App\Services\MediaService;
use App\Traits\{Excludable, Filterable, Translatable};
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\{HasMedia, HasMediaTrait};
use Spatie\MediaLibrary\Models\Media;

abstract class Product extends Model implements HasMedia, Buyable
{
    use HasMediaTrait, Excludable, Translatable, Filterable;

    protected $appends = ['in_stock', 'current_price'];

    protected static function boot()
    {
        parent::boot();

        self::saving(function($product) {
            MediaService::store($product, [
                'main_image', 'additional_images'
            ]);
        });

        self::updated(function () {
            CartService::updateProducts();
        });

        self::deleting(function ($product) {
            MediaService::destroy($product, [
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
     * Show path to product
     *
     * @param string $action
     * @return string
     */
    public function path($action = 'show')
    {
        $product = Str::plural($this->getTable());

        switch ($action) {
            case 'edit':
                $path = 'admin.' . $product . '.edit';
                break;
            case 'update':
                $path = 'admin.' . $product . '.update';
                break;
            case 'destroy':
                $path = 'admin.' . $product . '.destroy';
                break;
            default:
                $path = $product . '.show';
        }

        $params = $this;
        if ($product == 'equipment' && $action == 'show') {
            $params = [
                'equipmentCategory' => $this->equipmentCategory->parent,
                'equipment' => $this
            ];
        }

        return route($path, $params);
    }

    /**
     * Show product type name
     *
     * @return string
     */
    public function getProductType()
    {
        return strtolower(class_basename($this));
    }

    /**
     * Register collection names
     * Only single main_image
     * Return blank image if not exists
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('main_image')
            ->useFallbackUrl(MediaService::BLANK_IMAGE_PATH)
            ->useFallbackPath(public_path(MediaService::BLANK_IMAGE_PATH))
            ->singleFile();

        $this->addMediaCollection('additional_images')
            ->useFallbackUrl(MediaService::BLANK_IMAGE_PATH)
            ->useFallbackPath(public_path(MediaService::BLANK_IMAGE_PATH));
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
            ->watermark(public_path(MediaService::WATERMARK_PATH))
            ->watermarkPosition(Manipulations::POSITION_CENTER)
            ->watermarkHeight(50, Manipulations::UNIT_PERCENT)
            ->watermarkWidth(50, Manipulations::UNIT_PERCENT);
    }

    /**
     * Get current price
     *
     * @return float
     */
    public function getCurrentPriceAttribute() : float
    {
        return (float) $this->is_special
            ? $this->special_price ?? $this->price
            : $this->price;
    }

    /**
     * Check if product in stock
     * Product in_stock if qty > 0
     *
     * @return bool
     */
    public function getInStockAttribute() : bool
    {
        return (bool) $this->qty > 0;
    }

    /**
     * Show Yes or No if product in_stock
     *
     * @return string
     */
    public function displayInStock()
    {
        return $this->in_stock ? __('Yes') : __('No');
    }

    /**
     * Display price with html structure
     *
     * @return string
     */
    public function displayPrice()
    {
        return displayPrice($this->current_price, $this->is_special, $this->special_price, $this->price);
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->current_price;
    }

    /**
     * Get equipment or part instance by product type
     *
     * @param $productType
     * @param $id
     * @return mixed
     */
    public static function getProductByType($productType, $id)
    {
        return $productType === 'equipment' ? Equipment::find($id) : Part::find($id);
    }
}
