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
 * Translate element from array
 *
 * @param array $array
 * @return string
 */
if (! function_exists('translateArrayItem'))
{
    function translateArrayItem(array $array, $key)
    {
        return isLocaleEn() ? $array[$key] : $array[$key. '_ar'];
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
 * Returns "By request" text when product current price is 0
 *
 * @param null|integer|float $currentPrice
 * @param bool $isSpecial
 * @param integer|float $specialPrice
 * @param integer|float $price
 * @return string A HTML formatted version of price.
 */
if (! function_exists('displayPrice'))
{
    function displayPrice($currentPrice, $isSpecial = false, $specialPrice = false, $price = false)
    {
        if (! $currentPrice) {
            return __('By request');
        }

        $currency = __('EGP');

        $currentPrice = getFormattedPrice($currentPrice);

        if ($isSpecial) {
            $specialPrice = getFormattedPrice($specialPrice);
            $price = getFormattedPrice($price);

            return sprintf(
                '<span class="text-muted">%1$s</span> %2$s <small><s>%3$s</s></small>',
                $currency, $specialPrice, $price
            );
        }

        return sprintf('<span class="text-muted">%1$s</span> %2$s', $currency, $currentPrice);
    }
}
