<?php

use App\Models\OfferFilterType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferFilterTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offer_filter_types')->truncate();

        $types = ['Price','Internet','Minute','SMS','Validation','Sort'];

        foreach ($types as $type){
            OfferFilterType::create([
                'name' => $type
            ]);
        }
    }
}
