<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Setting;

class SettingService
{
    /**
     * Get header or footer logo url
     *
     * @param $type
     * @return string
     */
    public static function getLogoUrl($type)
    {
        $logoName = $type.'_logo';

        $fileExists = Storage::disk('public')->exists(setting($logoName));

        return asset($fileExists ? 'storage/'.setting($logoName) : 'images/'.$logoName.'.png');
    }

    /**
     * Get menu from settings
     *
     * @param bool $assoc
     * @return array|null
     */
    public static function getMenu($assoc = true)
    {
        $menu = json_decode(Setting::get('menu'), $assoc);

        return $menu ? array_values($menu) : null;
    }

    /**
     * Store menu
     *
     * @param array $menu
     * @return bool
     */
    public static function storeMenu(array $menu)
    {
        Setting::set('menu', json_encode(array_values($menu)));

        Setting::save();

        return true;
    }

    /**
     * Add new page to the menu
     *
     * @param Page $page
     * @return bool
     */
    public static function addPageToMenu(Page $page)
    {
        $menu = self::getMenu();

        $menu[] = [
            'is_dynamic' => true,
            'name' => $page->name,
            'name_ar' => $page->name_ar,
            'slug' => $page->slug
        ];

        return self::storeMenu($menu);
    }

    /**
     * Update page data into menu
     *
     * @param $page
     * @return bool
     */
    public static function updatePageIntoMenu($page)
    {
        $menu = self::getMenu();

        $key = array_search($page->getOriginal('name'), array_column($menu, 'name'));

        $menu[$key] = [
            'is_dynamic' => true,
            'name' => $page->name,
            'name_ar' => $page->name_ar,
            'slug' => $page->slug
        ];

        return self::storeMenu($menu);
    }

    /**
     * Delete page from menu
     *
     * @param Page $page
     * @return bool
     */
    public static function deletePageFromMenu(Page $page)
    {
        $menu = self::getMenu();

        $key = array_search($page->name, array_column($menu, 'name'));

        unset($menu[$key]);

        return self::storeMenu($menu);
    }

    /**
     * Array with page names
     *
     * @param array $newMenuItems
     * @return bool
     */
    public static function reindexMenuItems(array $newMenuItems)
    {
        $menu = self::getMenu();

        $updatedMenu = [];
        foreach($newMenuItems as $menuItem) {
            $key = array_search($menuItem, array_column($menu, 'name'));

            $updatedMenu[] = $menu[$key];
        }

        return SettingService::storeMenu($updatedMenu);
    }

    /**
     * Show phone without dashes
     *
     * @return mixed
     */
    public static function getFormattedPhone()
    {
        return str_replace('-', '', setting('phone', '+20-101-620-05-99'));
    }
}