<?php

use Illuminate\Database\Seeder;
use App\Models\AppServiceCategory;
use Illuminate\Support\Facades\DB;

class AppServiceCategoryTableSeeder extends Seeder
{

    protected function insertAppServiceCat($data, $dataBn, $parentId)
    {
        foreach ($data as $key => $item) {
            AppServiceCategory::create([
                'app_service_tab_id' => $parentId,
                'title_en' => $item,
                'title_bn' => $dataBn[$key],
                'alias' => str_replace(' ', '_', strtolower($item))
            ]);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS =0;');
        AppServiceCategory::truncate();

        $appEn = ['Devotional', 'Fun & Entertainment', 'Lifestyle', 'Sports'];
        $appBn = ['ভক্তিমূলক', 'মজা এবং বিনোদন', 'লাইফস্টাইল', 'ক্রীড়া'];

        $vasEn = ['Devotional'];
        $vasBn = ['ভক্তিমূলক'];

        $financialEn = ['DFS Recharge Offers', 'Card Offers', 'MFS Offers', 'Card Offers'];
        $financialBn = ['ডিএফএস রিচার্জ অফার', 'কার্ড অফার', 'এমএফএস অফার', 'কার্ড অফার'];

        $otherEn = ['Social Media Offers'];
        $otherBn = ['সোশ্যাল মিডিয়া অফার'];

        $this->insertAppServiceCat($appEn, $appBn, 1);

        $this->insertAppServiceCat($vasEn, $vasBn, 2);

        $this->insertAppServiceCat($financialEn, $financialBn, 3);

        $this->insertAppServiceCat($otherEn, $otherBn, 4);

        DB::statement('SET FOREIGN_KEY_CHECKS =1;');
    }
}
