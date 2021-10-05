<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::set('facebook', 'https://www.facebook.com/gararatcom');
        Setting::set('youtube', 'https://www.youtube.com/channel/UCoBI2FCQzx4tMEUbMpVphJw');
        Setting::set('whatsapp', '00201016200599');
        Setting::set('email', 'sales@belmach.com');
        Setting::set('phone', '+20-225412782');
        Setting::set('footer_address', 'Villa 318, Al Showaifat region, Al Tagamoa AL Khames, 90th st., New Cairo-Egypt');
        Setting::set('footer_address_ar', 'Villa 318, Al Showaifat region, Al Tagamoa AL Khames, 90th st., New Cairo-Egypt');
        Setting::set('footer_slogan', 'Belmach – the first e-hypermarket for agricultural tractors, equipment and spare parts!');
        Setting::set('footer_slogan_ar', 'جرارات هو أول سوق إليكترونى للجرارات الزراعية و المعدات وقطع الغيار');
        Setting::set('header_logo', 'images/header_logo.png');
        Setting::set('footer_logo', 'images/footer_logo.png');
        Setting::set('instagram', 'https://www.instagram.com/gararat.belarus');
        Setting::set('linkedin', 'https://www.linkedin.com/company/gararat-com');
        Setting::set('twitter', 'https://twitter.com/GararatC');

        $menu = [
            [
                'is_dynamic' => false,
                'name' => 'Catalog',
                'route' => 'catalog.index',
                'route_group' => 'catalog.*'
            ],
            [
                'is_dynamic' => false,
                'name' => 'Parts',
                'route' => 'parts.index',
                'route_group' => 'parts.*'
            ],
            [
                'is_dynamic' => false,
                'name' => 'Promotions',
                'route' => 'promotions',
                'route_group' => 'promotions'
            ],
            [
                'is_dynamic' => false,
                'name' => 'Blog',
                'route' => 'posts.index',
                'route_group' => 'posts.*'
            ],
            [
                'is_dynamic' => false,
                'name' => 'Contacts',
                'route' => 'contacts',
                'route_group' => 'contacts'
            ],
        ];

        foreach (Page::getAllPageWithoutHome() as $page) {
            $menu[] = [
                'is_dynamic' => true,
                'name' => $page->name,
                'name_ar' => $page->name_ar,
                'slug' => $page->slug
            ];
        }

        Setting::set('menu', json_encode($menu));

        Setting::save();
    }
}
