<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentFilter extends Filter
{
    /**
     * Filter equipment by manufacturer ids
     *
     * @param  array  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function manufacturers(array $value = []) : Builder
    {
        return $this->builder->whereIn('manufacturer_id', $value);
    }
}