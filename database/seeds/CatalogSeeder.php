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
            array('cat_number' => '11', 'parent_cat' => '1', 'cat_name_en' => 'Tractors', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '111', 'parent_cat' => '11', 'cat_name_en' => 'MTW', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1111', 'parent_cat' => '111', 'cat_name_en' => 'BELARUS90', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1112', 'parent_cat' => '111', 'cat_name_en' => 'BELARUS92', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '12', 'parent_cat' => '1', 'cat_name_en' => 'Combines', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '121', 'parent_cat' => '12', 'cat_name_en' => 'Gomselmash', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '1211', 'parent_cat' => '121', 'cat_name_en' => 'Model1', 'created_at' => Carbon::now(), 'cat_type' => 0),
            array('cat_number' => '21', 'parent_cat' => '2', 'cat_name_en' => 'Tractors', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '211', 'parent_cat' => '21', 'cat_name_en' => 'MTW', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '2111', 'parent_cat' => '211', 'cat_name_en' => 'BELARUS90', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '21111', 'parent_cat' => '2111', 'cat_name_en' => 'The moving part', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '211111', 'parent_cat' => '21111', 'cat_name_en' => 'Front axle', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '2111111', 'parent_cat' => '211111', 'cat_name_en' => 'Drawing details', 'created_at' => Carbon::now(), 'cat_type' => 1),
            array('cat_number' => '22', 'parent_cat' => '2', 'cat_name_en' => 'Combines', 'created_at' => Carbon::now(), 'cat_type' => 1),
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
