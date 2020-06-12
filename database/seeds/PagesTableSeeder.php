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
        Page::create([
            'slug' => 'home',
            'name' => 'Home',
            'name_ar' => 'الصفحة الرئيسية'
        ]);
    }
}
