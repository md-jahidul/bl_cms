<?php

use Illuminate\Database\Seeder;
use \App\Models\LeadProduct;

class LeadProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lead_products')->truncate();
        $items = [
            "SAP", "Ennovators", "AIP", "IT incubator",
            "National Hackathon", "Digigeek meetup"
        ];

        foreach ($items as $title) {
            LeadProduct::updateOrCreate([
                "title" => $title,
                "slug" => str_replace([' ','-'], "_", strtolower($title))
            ]);
        }
    }
}
