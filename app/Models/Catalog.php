<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use DB;

class Catalog extends Model
{
    use Translatable;

    protected $fillable = ['name', 'name_ar', 'parent_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(static::class, 'id', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Check if this category is child category
     *
     * @return bool
     */
    public function isParent()
    {
        return is_null($this->parent_id) ? true : false;
    }

    /**
     * Check if this category is child category
     *
     * @return bool
     */
    public function isChild()
    {
        return ! $this->isParent();
    }

    /**
     * Check if catalog has childs catalogs
     *
     * @return bool
     */
    public function hasChilds()
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
     * @return array|\Illuminate\Support\Collection
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
