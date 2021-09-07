<?php

use Illuminate\Database\Seeder;
use App\Models\EquipmentCategory;

class EquipmentCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = collect([
            [
                'name' => 'Tractors',
                'name_ar' => 'الجرارات',
                'slug' => 'tractors',
            ],
            [
                'name' => 'Attachments',
                'name_ar' => 'المرفقات',
                'slug' => 'attachments',
            ],
            [
                'name' => 'Air conditioning',
                'name_ar' => 'تكيف',
                'slug' => 'air-conditioning',
            ],
            [
                'name' => 'Construction',
                'name_ar' => 'بناء',
                'slug' => 'construction',
            ],
        ]);

        $items->each(function($item) {
            EquipmentCategory::create($item);
        });
    }
}
