<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PartsFilter extends Filter
{
    /**
     * Get parts which are in catalogs and equipment groups together
     *
     * @param array $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function union(array $value = []) : Builder
    {
        return $this->builder->whereHas('unitParts.unit', function ($query) use ($value) {
            $query->whereHas('unitParts.unit.catalog', function ($q) use ($value) {
                $q->whereIn('id', $value['catalogs']);
            });

            $query->whereHas('unitParts.unit.equipment.equipmentGroup', function ($q) use ($value) {
                $q->whereIn('id', $value['equipmentGroups']);
            });
        });
    }

    /**
     * Get parts from catalogs
     *
     *  @param  array  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function catalogs(array $value = []) : Builder
    {
        return $this->builder->whereHas('unitParts.unit.catalog', function ($query) use ($value) {
            $query->whereIn('id', $value);
        });
    }

    /**
     * Get parts which are in equipment groups
     *
     *  @param  array  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function equipmentGroups(array $value = []) : Builder
    {
        return $this->builder->whereHas('unitParts.unit.equipment.equipmentGroup', function ($query) use ($value) {
            $query->whereIn('id', $value);
        });
    }

    /**
     * Order by 'In stock' or 'By request'
     *
     * @param string $value
     * @return Builder
     */
    public function inStock(string $value = 'desc') : Builder
    {
        return $this->builder->orderBy(DB::raw("IF(qty > 0, 1, 0)"), $value);
    }

    /**
     * Order by price
     *
     * @param string $value
     * @return Builder
     */
    public function price(string $value = 'asc') : Builder
    {
        return $this->builder->orderBy(DB::raw("IF(is_special = 0, price, special_price)"), $value);
    }
}