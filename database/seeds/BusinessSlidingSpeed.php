<?php

use Illuminate\Database\Seeder;

class BusinessSlidingSpeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_sliding_speed')->truncate();
        
        DB::table('business_sliding_speed')->insert(array (
            0 =>
            array (
                'id' => 1,
                'enterprise_speed' => 1,
                'news_speed' => 1
              
            )
        ));
    }
}
