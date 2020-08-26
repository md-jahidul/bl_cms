<?php

use Illuminate\Database\Seeder;
use \App\Models\LeadCategory;

class LeadCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lead_categories')->truncate();
        $items = [
            "Postpaid package", "Business package", "Business enterprise solution",
            "eCareer programs", 'Corporate responsibility'
        ];

        foreach ($items as $title) {
            LeadCategory::updateOrCreate([
                "title" => $title,
                "slug" => str_replace([' ','-'], "_", strtolower($title))
            ]);
        }
    }
}
