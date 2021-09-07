<?php

use App\Models\EquipmentGroup;
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
            ['name' => 'BELARUS-800/820/90S/92S/92SL'],
            ['name' => 'BELARUS-90/92'],
            ['name' => 'BELARUS-321']
        ])->each(function($item) {
            EquipmentGroup::create($item);
        });
    }
}
