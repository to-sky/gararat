<?php

use App\Models\EquipmentGroup;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EquipmentGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' => 'Belarus-90/92'],
            ['name' => 'Belarus-80/82']
        ])->each(function($item) {
            EquipmentGroup::create($item);
        });
    }
}
