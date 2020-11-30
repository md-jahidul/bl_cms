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
        $titleEn = ['CR Strategy','Initiative', 'Case Study & Report'];
        $titleBn = ['সিআর কৌশল', 'উদ্যোগ', 'কেস স্টাডি এবং রিপোর্ট'];

        foreach ($titleEn as $key => $item) {
            CorporateRespSection::create([
                'title_en' => $item,
                'title_bn' => $titleBn[$key],
                'banner_image_url' => null,
                'banner_mobile_view' => null,
                'alt_text_en' => null,
                'alt_text_bn' => null,
                'banner_image_name' => null,
                'slug' => str_replace(' ', '_', strtolower($item)),
                'url_slug_en' => str_replace(' ', '-', strtolower($item)),
                'url_slug_bn' => null,
                'page_header' => null,
                'schema_markup' => null,
                'status' => 1,
            ]);
        }
    }
}
