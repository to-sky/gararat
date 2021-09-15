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

    /**
     * Get products with promotion attribute
     *
     * @return mixed
     */
    public static function getPromotions()
    {
        $parts = Part::promotion()->get();
        $equipment = Equipment::promotion()->get();

        return $parts->merge($equipment);
    }

    /**
     * Get product with best selling attribute
     *
     * @return mixed
     */
    public static function getBestSelling()
    {
        $parts = Part::bestSelling()->get();
        $equipment = Equipment::bestSelling()->get();

        return $parts->merge($equipment);
    }

    /**
     * Get promotion or best selling products
     *
     * @return mixed
     */
    public static function getPromotionOrBestSelling($productType = null)
    {
        $parts = Part::promotionOrBestSelling()->get();
        $equipment = Equipment::promotionOrBestSelling()->get();

        switch ($productType) {
            case 'equipment':
                return $equipment;
            case 'parts':
                return $parts;
            default:
                return $parts->merge($equipment);
        }
    }
}
