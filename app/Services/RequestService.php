<?php

namespace App\Services;


class RequestService
{
    /**
     * Filtering json request and remove items with NULL values
     * For all null values return NULL
     *
     * @param $items
     * @return \Illuminate\Support\Collection|null
     */
    public static function filterArray($items)
    {
        $filteredItems = collect($items)->map(function ($item) {
            return array_filter($item);
        })->filter();

        return $filteredItems->isEmpty() ? null : $filteredItems;
    }

    /**
     * Filtering array request with nested arrays
     *
     * @param $items
     * @return \Illuminate\Support\Collection|null
     */
    public static function filterArrayWithNested($items)
    {
        $prepareData = collect($items)->map(function ($item) {
            $filteredItem = collect($item)->map(function ($el) {
                return is_array($el) ? self::filterArray($el) : $el;
            })->toArray();

            return array_filter($filteredItem);
        })->toArray();

        $filteredData = array_filter($prepareData);

        return $filteredData ? $filteredData : null;
    }
}