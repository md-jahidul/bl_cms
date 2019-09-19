<?php

use Illuminate\Database\Seeder;

class SliderComponentTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('slider_component_types')->delete();
        
        \DB::table('slider_component_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Home',
                'slug' => 'home',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Hero',
                'slug' => 'hero',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Dashboard',
                'slug' => 'Dashboard',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Digital Service',
                'slug' => 'digital_service',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}