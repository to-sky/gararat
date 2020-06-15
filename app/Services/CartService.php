<?php

namespace App\Services;

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CartService
{
    /**
     * Store cart content to database and set timestamp
     *
     * @return bool|null
     */
    public static function storeCart()
    {
        $userToken = Cookie::get('userToken');

        if (Cart::content()->isNotEmpty()) {
            Cart::store($userToken);

            self::updateCartTimestamps($userToken);

            return true;
        }

        return null;
    }

    /**
     * Update cart created_at and updated_at columns
     *
     * @param $userToken
     * @param bool $created_at
     * @param bool $updated_at
     * @return int
     */
    private static function updateCartTimestamps($userToken, $created_at = true, $updated_at = true)
    {
        $timestamps = [];

        if ($created_at) {
            $timestamps['created_at'] = Carbon::now();
        }

        if ($updated_at) {
            $timestamps['updated_at'] = Carbon::now();
        }

        return DB::table(config('cart.database.table'))
            ->where('identifier', $userToken)
            ->update($timestamps);
    }

    /**
     * Get product models from cart
     *
     * @return mixed
     */
    public static function getProductModels()
    {
        return Cart::content()->map->model->filter();
    }

    /**
     * Get row ids for available products
     *
     * @return array
     */
    public static function getAvailableProductRowIds()
    {
        return array_keys(
            self::getProductModels()->map->in_stock->filter()->toArray()
        );
    }

    /**
     * Get total sum for all available products in the cart
     *
     * @return string
     */
    public static function total()
    {
        $total = 0;

        foreach (self::getAvailableProductRowIds() as $rowId) {
            $total += self::itemTotal($rowId);
        }

        return $total;
    }

    /**
     * Show total price
     * Total price can been "By request" even if one product not in stock
     */
    public static function displayTotal()
    {
        if (Cart::content()->count() !== count(self::getAvailableProductRowIds())) {
            return __('By request');
        }

        return displayPrice(self::total());
    }

    /**
     * Get product total sum in the cart
     *
     * @param $rowId
     * @param bool $formattedPrice
     * @return float|int|string
     */
    public static function itemTotal($rowId, $formattedPrice = false)
    {
        $cartItem = Cart::get($rowId);

        $total = $cartItem->model->current_price * $cartItem->qty;

        return $formattedPrice ? getFormattedPrice($total) : $total;
    }

    /**
     * Show formatted total price for product
     *
     * @param $rowId
     * @return float|int|string
     */
    public static function displayItemTotal($rowId)
    {
        return displayPrice(self::itemTotal($rowId));
    }

    /**
     * Update all products data in the stored cart
     *
     * @return bool
     */
    public static function updateProducts()
    {
        foreach (Cart::content() as $rowId => $cartItem) {
            self::updateProduct($cartItem, $rowId);
        }

        return true;
    }

    /**
     * Update product data in stored cart
     *
     * @param $cartItem
     * @param $rowId
     * @return bool
     */
    public static function updateProduct($cartItem, $rowId)
    {
        if (is_null($cartItem->model)) {
            return Cart::remove($rowId);
        }

        $productCurrentPrice = (float) $cartItem->model->current_price;

        if ($cartItem->price !== $productCurrentPrice) {
            return Cart::update($rowId, $cartItem->model);
        }

        return null;
    }
}