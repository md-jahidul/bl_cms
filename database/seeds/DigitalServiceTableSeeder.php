<?php

use Illuminate\Database\Seeder;

class DigitalServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\DigitalService', 10)->create();
    }
}
