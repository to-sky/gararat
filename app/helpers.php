<?php
/**
 * Check locale
 */
if (! function_exists('isLocaleEn')) {
    function isLocaleEn()
    {
        return app()->getLocale() == 'en';
    }
}

/**
 * Translate item
 */
if (! function_exists('translate')) {
    function translate($value)
    {
        return isLocaleEn() ? $value : $value. '_ar';
    }
}