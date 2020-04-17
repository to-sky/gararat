<?php
/**
 * Check locale
 *
 * @return bool
 */
if (! function_exists('isLocaleEn'))
{
    function isLocaleEn()
    {
        return app()->getLocale() == 'en';
    }
}

/**
 * Translate attribute
 *
 * @param string $value
 * @return string
 */
if (! function_exists('translate'))
{
    function translate($value)
    {
        return isLocaleEn() ? $value : $value. '_ar';
    }
}

/**
 * Show formatted price from cart config file
 *
 * @param integer|float $price
 * @return string A formatted version of price.
 */
if (! function_exists('getFormattedPrice'))
{
    function getFormattedPrice($price)
    {
        list($decimal, $decimal_point, $thousand_separator) = [
            config('cart.format.decimals'),
            config('cart.format.decimals_point'),
            config('cart.format.thousand_seperator')
        ];

        return number_format($price, $decimal, $decimal_point, $thousand_separator);
    }
}

/**
 * Show product price with currency and with special price if exists
 * Returns "By request" text when product is not in stock
 *
 * @param null|integer|float $price
 * @param bool $model \App\Models\{Model} instance
 * @param bool $is_special
 * @param integer|integer|float $specialPrice
 * @return string A HTML formatted version of price.
 */
if (! function_exists('displayPrice'))
{
    function displayPrice($price, $model = false, $is_special = false, $specialPrice = false)
    {
        if ($model && ! $model->in_stock) {
            return __('By request');
        }

        $currency = __('EGP');

        $price = getFormattedPrice($price);

        if ($is_special) {
            $specialPrice = getFormattedPrice($specialPrice);

            return sprintf(
                '<span class="text-muted">%1$s</span> %2$s <small><s>%3$s</s></small>',
                $currency, $specialPrice, $price
            );
        }

        return sprintf('<span class="text-muted">%1$s</span> %2$s', $currency, $price);
    }
}
