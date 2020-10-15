<?php

use App\Models\CorpResContactUsPage;
use Illuminate\Database\Seeder;

class CorpResContactUsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('corp_res_contact_us_pages')->truncate();

        $pages = [
            'cr_strategy', 'cr_strategy_details','initiative','case_study_and_report', 'case_study_and_report_details'
        ];

        foreach ($pages as $key => $item) {
            CorpResContactUsPage::create([
                'page_type' => $item,
                'component_title_en' => "Contact Us",
                'component_title_bn' => "Contact Us",
                'send_button_en' => "Send",
                'send_button_bn' => "Send",
                'status' => 1,
            ]);
        }
    }
}
