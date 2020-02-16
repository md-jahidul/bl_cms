<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UniversityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('universities')->truncate();
		
		$slabs = [
		    [
		        'university_name' => 'American International University-Bangladesh',
		        'university_slug' => 'AIUB',
		        'is_active' => 1,
		        'created_at' => Carbon::now()->toDateTimeString(),
		        'updated_at' => Carbon::now()->toDateTimeString(),
		    ],
		    [
		        'university_name' => 'Brac University',
		        'university_slug' => 'Brac',
		        'is_active' => 1,
		        'created_at' => Carbon::now()->toDateTimeString(),
		        'updated_at' => Carbon::now()->toDateTimeString(),
		    ],
		    [
		        'university_name' => 'North South University',
		        'university_slug' => 'NSU',
		        'is_active' => 1,
		        'created_at' => Carbon::now()->toDateTimeString(),
		        'updated_at' => Carbon::now()->toDateTimeString(),
		    ],
		    
		];
		DB::table('universities')->insert($slabs);
    }
}
