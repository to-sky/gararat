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
                'title_ar' => 'خدمات',
                'body' => '<p>High quality maintenance is an important for any equipment. Our service team is able to
                            provide scheduled maintenance for your equipment to guarantee best performance and in the
                            event of any breakdown quickly come to your site to repair your equipment in shortest time.</p>',
                'body_ar' => '<p>الصيانة عالية الجودة مهمة لأي معدة. يستطيع &nbsp;يقوم فريق الصيانة التابع لنا بتقديم الصيانة طبقا لجدول الطلبات لمعداتك لضمان أفضل أداء ، وفي حال حدوث أي عطل ، فانتقل سريعًا إلى موقعك لإصلاح أجهزتك في أقصر وقت ممكن.</p>',
            ]
        ];

        collect($pages)->each(function ($page) {
            Page::firstOrcreate(['slug' => $page['slug']], $page);
        });
    }
}
