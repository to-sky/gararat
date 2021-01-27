<?php

use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governorates = [
            ['name' => 'Alexandria', 'name_ar' => 'الإسكندرية'],
            ['name' => 'Aswan', 'name_ar' => 'أسوان'],
            ['name' => 'Asyut', 'name_ar' => 'أسيوط'],
            ['name' => 'Beheira', 'name_ar' => 'البحيرة'],
            ['name' => 'Beni Suef', 'name_ar' => 'بني سويف'],
            ['name' => 'Cairo', 'name_ar' => 'القاهرة'],
            ['name' => 'Dakahlia', 'name_ar' => 'الدقهلية'],
            ['name' => 'Damietta', 'name_ar' => 'دمياط'],
            ['name' => 'Faiyum', 'name_ar' => 'الفيوم'],
            ['name' => 'Gharbia', 'name_ar' => 'الغربية'],
            ['name' => 'Giza', 'name_ar' => 'الجيزة'],
            ['name' => 'Ismailia', 'name_ar' => 'الإسماعيلية'],
            ['name' => 'Kafr El Sheikh', 'name_ar' => 'كفر الشيخ'],
            ['name' => 'Luxor', 'name_ar' => 'الأقصر'],
            ['name' => 'Matruh', 'name_ar' => 'مطروح'],
            ['name' => 'Minya', 'name_ar' => 'المنيا'],
            ['name' => 'Monufia', 'name_ar' => 'المنوفية'],
            ['name' => 'New Valley', 'name_ar' => 'الوادي الجديد'],
            ['name' => 'North Sinai', 'name_ar' => 'شمال سيناء'],
            ['name' => 'Port Said', 'name_ar' => 'بورسعيد'],
            ['name' => 'Qalyubia', 'name_ar' => 'القليوبية'],
            ['name' => 'Qena', 'name_ar' => 'قنا'],
            ['name' => 'Red Sea', 'name_ar' => 'البحر الأحمر'],
            ['name' => 'Sharqia', 'name_ar' => 'الشرقية'],
            ['name' => 'Sohag', 'name_ar' => 'سوهاج'],
            ['name' => 'South Sinai', 'name_ar' => 'جنوب سيناء'],
            ['name' => 'Suez', 'name_ar' => 'السويس'],
        ];

        foreach ($governorates as $governorate) {
            Governorate::create([
                'name' => $governorate['name'],
                'name_ar' => $governorate['name_ar']
            ]);
        }
    }
}
