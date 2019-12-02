<?php

use Illuminate\Database\Seeder;
use \App\Models\Campaign;
use \App\Models\Prize;

class CampaignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory('App\Campaign', 10)->create();


        factory(Campaign::class, 10)->create()->each(function ($company) {
            $company->prizes()->save(factory(Prize::class)->make());
        });
    }
}
