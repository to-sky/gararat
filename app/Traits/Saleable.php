<?php

namespace App\Traits;

use App\Models\Part;

trait Saleable
{
    /**
     * Get current price
     *
     * @return mixed
     */
    public function getCurrentPriceAttribute()
    {
        return $this->is_special ? $this->special_price : $this->price;
    }

    /**
     * Display price with html structure
     *
     * @return string
     */
    public function displayPrice()
    {
        $currency = trans('EGP');

        if($this->is_special) {
            return sprintf(
                '%s %01.2f <small><s>%01.2f</s></small>',
                $currency, $this->special_price, $this->price
            );
        }

        return sprintf("%s %01.2f", $currency, $this->price);
    }

    /**
     * Show Yes or No if product in_stock
     *
     * @return string
     */
    public function displayInStock()
    {
        return $this->in_stock ? trans('Yes') : trans('No');
    }

    /**
     * Display price on the site
     *
     * @return string
     */
    public function displaySitePrice()
    {
        $condition = $this instanceof Part
            ? $this->qty
            : $this->in_stock;

        return $condition ? $this->displayPrice() : trans('By request');
    }
}