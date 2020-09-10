<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use \App\Models\BeAPartner;

class BeAPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('be_a_partners')->truncate();
        BeAPartner::create([
            'title_en' => 'Demo Title En',
            'title_bn' => 'Demo Title Bn',
            'description_en' => 'Description En',
            'description_bn' => 'Description Bn',
            'banner_image' => []
        ]);
    }
}
