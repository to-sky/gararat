<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UsersTableSeeder::class);
//        $this->call(CountriesTableSeeder::class);
//        $this->call(ManufacturersTableSeeder::class);
        $this->call(CatalogsTableSeeder::class);
        $this->call(EquipmentGroupsTableSeeder::class);
        $this->call(EquipmentTableSeeder::class);
        $this->call(PartsTableSeeder::class);
    }
}
