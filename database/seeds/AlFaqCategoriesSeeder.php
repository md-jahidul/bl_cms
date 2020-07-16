<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AlFaqCategory;

class AlFaqCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('al_faq_categories')->truncate();
        $items = [
            "Prepaid Voice", "Prepaid Internet", "Prepaid Bundle","Prepaid Package", "Postpaid Internet",
            "About Priyojon", "About Reward Point Priyojon", "Priyojon Campaign",
            "E-Career SAP", "E-Career Enovator", "E-Career AIP","E-Career We at campus",
            "CR IT incubator", "CR National Hackathon", "CR Digigeek meetup",
            "Banglalink 4g", "Banglalink 3g"
        ];

        foreach ($items as $title) {
            AlFaqCategory::updateOrCreate([
                "title" => $title,
                "slug" => str_replace(" ", "_", strtolower($title))
            ]);
        }
    }
}
