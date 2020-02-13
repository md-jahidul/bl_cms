<?php

use Illuminate\Database\Seeder;

class BusinessProductCategorySeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('business_product_categories')->truncate();
        
        DB::table('business_product_categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Packages',
                'home_show' => 1,
                'home_sort' => 1
              
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Internet',
                'home_show' => 1,
                'home_sort' => 2
              
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Business Solutions',
                'home_show' => 1,
                'home_sort' => 3
              
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'IOT',
                'home_show' => 1,
                'home_sort' => 4
              
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Others',
                'home_show' => 1,
                'home_sort' => 5
              
            ),
            
        ));
    }
}
