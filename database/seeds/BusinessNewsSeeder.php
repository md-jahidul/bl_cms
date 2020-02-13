<?php

use Illuminate\Database\Seeder;

class BusinessNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_news')->truncate();

        DB::table('business_news')->insert(array(
            0 =>
            array(
                'image_url' => "",
                'title' => "This is text title",
                'body' => "All Banglalink subscribers are eligible for availing the service User will be charged for mobile data as per subscribed data plan SD, VAT and SC are applicable",
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s")
            )
        ));
    }
}
