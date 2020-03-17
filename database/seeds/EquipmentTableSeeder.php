<?php

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipment = [
            [
                'name' => 'Belarus-90',
                'manufacturer_id' => 1,
                'equipment_group_id' => 1,
                'price' => 999,
            ],
            [
                'name' => 'Belarus-90S',
                'manufacturer_id' => 1,
                'equipment_group_id' => 1,
                'price' => 1028,
            ],
            [
                'name' => 'Belarus-92',
                'manufacturer_id' => 1,
                'equipment_group_id' => 1,
                'price' => 1299,
            ],
            [
                'name' => 'Belarus-80',
                'manufacturer_id' => 1,
                'equipment_group_id' => 2,
                'price' => 899,
            ],
            [
                'name' => 'Belarus-82',
                'manufacturer_id' => 1,
                'equipment_group_id' => 2,
                'price' => 1395,
            ],
        ];

        foreach ($equipment as $equipmentItem) {
            Equipment::create($equipmentItem);
        }
    }
}
