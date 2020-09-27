<?php

use App\Models\CorporateRespSection;
use Illuminate\Database\Seeder;

class CorporateRespSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('corporate_resp_sections')->truncate();
        $titleEn = ['CR Strategy Copy','Initiative', 'Case Study & Report'];
        $titleBn = ['সিআর কৌশল কপি', 'উদ্যোগ', 'কেস স্টাডি এবং রিপোর্ট'];

        foreach ($titleEn as $key => $item) {
            CorporateRespSection::create([
                'title_en' => $item,
                'title_bn' => $titleBn[$key],
                'banner_image_url' => null,
                'banner_mobile_view' => null,
                'alt_text_en' => null,
                'alt_text_bn' => null,
                'banner_image_name' => null,
                'url_slug' => null,
                'slug' => str_replace(' ', '_', strtolower($item)),
                'page_header' => null,
                'schema_markup' => null,
                'status' => 1,
            ]);
        }
    }
}
