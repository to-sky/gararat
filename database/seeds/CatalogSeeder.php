<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalogs = array(
            array('cat_number' => '1', 'parent_cat' => '0', 'cat_name_en' => 'Equipment', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '2', 'parent_cat' => '0', 'cat_name_en' => 'Parts', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '1.1', 'parent_cat' => '1', 'cat_name_en' => 'Tractors', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1.1.1', 'parent_cat' => '1.1', 'cat_name_en' => 'MTW', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1.1.1.1', 'parent_cat' => '1.1.1', 'cat_name_en' => 'BELARUS90', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1.1.1.2', 'parent_cat' => '1.1.1', 'cat_name_en' => 'BELARUS92', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1.2', 'parent_cat' => '1', 'cat_name_en' => 'Combines', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1.2.1', 'parent_cat' => '1.2', 'cat_name_en' => 'Gomselmash', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1.2.1.1', 'parent_cat' => '1.2.1', 'cat_name_en' => 'Model1', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '2.1', 'parent_cat' => '2', 'cat_name_en' => 'Tractors', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '2.1.1', 'parent_cat' => '2.1', 'cat_name_en' => 'MTW', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '2.1.1.1', 'parent_cat' => '2.1.1', 'cat_name_en' => 'BELARUS90', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '2.1.1.1.1', 'parent_cat' => '2.1.1.1', 'cat_name_en' => 'The moving part', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '2.1.1.1.1.1', 'parent_cat' => '2.1.1.1.1', 'cat_name_en' => 'Front axle', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '2.1.1.1.1.1.1', 'parent_cat' => '2.1.1.1.1.1', 'cat_name_en' => 'Drawing details', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '2.2', 'parent_cat' => '2', 'cat_name_en' => 'Combines', 'created_at' => Carbon::now(), 'cat_type' => 1),
        );

        foreach($catalogs as $catalog) {
            DB::table('catalog')->insert([
                'cat_number' => $catalog['cat_number'],
                'parent_cat' => $catalog['parent_cat'],
                'cat_type' => $catalog['cat_type'],
                'cat_name_en' => $catalog['cat_name_en'],
                'created_at' => $catalog['created_at']
            ]);
        }
    }
}
