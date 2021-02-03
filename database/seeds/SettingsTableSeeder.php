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
        Setting::set('email', 'sales@gararat.com');
        Setting::set('phone', '+20-101-620-05-99');
        Setting::set('footer_address', 'Villa 318, Al Showaifat region, Al Tagamoa AL Khames, 90th st., New Cairo-Egypt');
        Setting::set('footer_address_ar', 'Villa 318, Al Showaifat region, Al Tagamoa AL Khames, 90th st., New Cairo-Egypt');
        Setting::set('footer_slogan', 'GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!');
        Setting::set('footer_slogan_ar', 'جرارات هو اول سوق إليكترونى للجرارات الزراعية و المعدات وقطع الغيار');
        Setting::set('header_logo', 'images/header_logo.png');
        Setting::set('footer_logo', 'images/footer_logo.png');

        $menu = [
            [
                'is_dynamic' => false,
                'name' => 'Equipment',
                'route' => 'equipment.index',
                'route_group' => 'equipment.*'
            ],
            [
                'is_dynamic' => false,
                'name' => 'Parts',
                'route' => 'parts.index',
                'route_group' => 'parts.*'
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
