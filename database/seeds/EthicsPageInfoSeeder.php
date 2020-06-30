<?php

use Illuminate\Database\Seeder;

class EthicsPageInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('ethics_page_info')->truncate();
        
        DB::table('ethics_page_info')->insert(array (
            0 =>
            array (
                'page_name_en' => 'Ethics and Compliance',
                'page_name_bn' => 'নৈতিকতা এবং সম্মতি',
            )      
        ));
    }
}
