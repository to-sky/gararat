<?php

namespace App\Services;

use App\Models\Equipment;
use App\Models\Part;

class ProductService
{
    /**
     * Search products from search query
     *
     * @param $query
     * @return mixed
     */
    public static function searchProduct($query)
    {
        $parts = Part::whereLike(['name', 'name_ar', 'producer_id'], $query)->get();
        $equipment = Equipment::whereLike(['name', 'name_ar'], $query)->get();

        return $parts->merge($equipment);
    }
}