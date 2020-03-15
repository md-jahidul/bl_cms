<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ComponentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('components')->insert(array (
            0 => 
            array (                
					'section_details_id' => 1,
					'page_type' => 'home_sales_service_center',
					'title_en' => 'Sales & Service center',
					'title_bn' => 'Sales & Service center',
					'slug' => 'sales_service_center',
					'description_en' => 'Locate our monobrand shops near you',
					'description_bn' => 'Locate our monobrand shops near you',
					'editor_en' => NULL,
					'editor_bn' => NULL,
					'image' => NULL,
					'alt_text' => NULL,
					'alt_links' => NULL,
					'video' => NULL,
					'component_type' => NULL,
					'component_order' => NULL,
					'multiple_attributes' => NULL,
					'status' => 1,
					'is_default' => 0,
					'other_attributes' => json_encode(['label_en' => 'Search','label_bn' => 'Search','links' => '#']),
					'created_at' => Carbon::now()->toDateTimeString(),
					'updated_at' => Carbon::now()->toDateTimeString(),
					'deleted_at' => NULL,
            )
         ));   
    }		
}
