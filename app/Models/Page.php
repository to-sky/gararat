<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Translatable;

    const HOME_PAGE_SLUG = 'home';
    const SERVICES_PAGE_SLUG = 'services';

    protected $fillable = [
        'slug', 'name', 'name_ar', 'title', 'title_ar', 'body', 'body_ar'
    ];

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
