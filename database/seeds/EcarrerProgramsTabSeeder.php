<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EcarrerProgramsTabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		$slabs = [
		    [
		        'title_en' => 'Strategic Assistant Program',
		        'title_bn' => 'কৌশলগত সহকারী প্রোগ্রাম',
		        'slug' => 'strategic-assistant-program',
		        'category' => 'programs_top_tab_title',
		        'category_type' => 'sap',
		        'is_active' => 1,
		        'has_items' => 0,
		        'created_at' => Carbon::now()->toDateTimeString(),
		        'updated_at' => Carbon::now()->toDateTimeString(),
		    ],
		    [
		        'title_en' => 'Ennovators',
		        'title_bn' => 'উদ্ভাবনক্ষম',
		        'slug' => 'ennovators',
		        'category' => 'programs_top_tab_title',
		        'category_type' => 'ennovators',
		        'is_active' => 1,
		        'has_items' => 0,
		        'created_at' => Carbon::now()->toDateTimeString(),
		        'updated_at' => Carbon::now()->toDateTimeString(),
		    ],
		    [
		        'title_en' => 'Advanced Internship Program',
		        'title_bn' => 'কৌশলগত সহকারী প্রোগ্রাম',
		        'slug' => 'advanced-internship-program',
		        'category' => 'programs_top_tab_title',		        
		        'category_type' => 'aip',
		        'is_active' => 1,
		        'has_items' => 0,
		        'created_at' => Carbon::now()->toDateTimeString(),
		        'updated_at' => Carbon::now()->toDateTimeString(),
		    ],
		    
		];
		DB::table('ecarrer_portals')->insert($slabs);
    }
}
