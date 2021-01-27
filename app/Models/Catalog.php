<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Catalog extends Model
{
    use Translatable;

    protected $fillable = ['name', 'name_ar', 'parent_id'];

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
     * @return HasMany
     */
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Check if this category is child category
     *
     * @return bool
     */
    public function isParent(): bool
    {
        return is_null($this->parent_id);
    }

    /**
     * Check if this category is child category
     *
     * @return bool
     */
    public function isChild(): bool
    {
        return ! $this->isParent();
    }

    /**
     * Check if catalog has childs catalogs
     *
     * @return bool
     */
    public function hasChilds(): bool
    {
        return $this->childs->count() ? true : false;
    }

    /**
     * Get only child catalogs
     *
     * @param $query
     */
    public function scopeChildCatalogs($query)
    {
        $query->whereNotNull('parent_id');
    }

    /**
     * Get only parent catalogs
     *
     * @param $query
     */
    public function scopeParentCatalogs($query)
    {
        $query->whereNull('parent_id');
    }

    /**
     * Sorting catalogs by "parent than all childs"
     *
     * @return array|Collection
     */
    public static function sortByParentChilds()
    {
        $sortedCatalogs = collect();
        $parentCatalogs = self::parentCatalogs(
            self::query()
        )->with('childs')->get();

        foreach ($parentCatalogs as $parentCatalog) {
            $sortedCatalogs[] = $parentCatalog;

            foreach ($parentCatalog->childs as $child) {
                $sortedCatalogs[] = $child;
            }
        }

        return $sortedCatalogs;
    }
}
