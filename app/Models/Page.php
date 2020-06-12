<?php

namespace App\Models;

use App\Services\SettingService;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Translatable;

    const HOME_PAGE_SLUG = 'home';

    protected $fillable = [
        'slug', 'name', 'name_ar', 'title', 'title_ar', 'body', 'body_ar'
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function($page) {
            SettingService::addPageToMenu($page);
        });

        self::updated(function($page) {
            SettingService::updatePageIntoMenu($page);
        });

        self::deleting(function($page) {
            SettingService::deletePageFromMenu($page);
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
     * Get homepage
     *
     * @return mixed
     */
    public static function getHomepage()
    {
        return self::whereSlug(self::HOME_PAGE_SLUG)->first();
    }

    /**
     * Get all pages without home
     *
     * @return mixed
     */
    public static function getAllPageWithoutHome()
    {
        return self::where('slug', '!=', self::HOME_PAGE_SLUG)->get();
    }

    /**
     * Check if page is homepage
     *
     * @return bool
     */
    public function isHome()
    {
        return $this->slug == self::HOME_PAGE_SLUG;
    }

    /**
     * Check if dynamic page exists
     *
     * @param $slug
     * @return bool
     */
    public function isPageExists($slug)
    {
        return $this->whereSlug($slug)->exists();
    }

    /**
     * Get page url
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrl()
    {
        return $this->isHome() ? route(self::HOME_PAGE_SLUG) : url($this->slug);
    }
}
