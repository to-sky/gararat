<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'slug' => 'home',
                'name' => 'Home',
                'name_ar' => 'الصفحة الرئيسية'
            ],
            [
                'slug' => 'services',
                'name' => 'Services',
                'name_ar' => 'خدمات',
                'title' => 'Services',
                'title_ar' => 'خدمات'
            ]
        ];

        collect($pages)->each(function ($page) {
            Page::create($page);
        });
    }
}
