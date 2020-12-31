<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessHomeBanner;

class BusinessHomeBannerRepository extends BaseRepository {

    public $modelName = BusinessHomeBanner::class;

    public function getHomeBanners() {
        $banners = $this->model->get();
        return $banners;
    }

    public function saveBannerPhoto($filePath,$filePathMob, $request)
    {
        $update = [];
        $update['alt_text'] = $request['alt_text'];
        $update['alt_text_bn'] = $request['alt_text_bn'];
        $update['image_name_en'] = $request['image_name_en'];
        $update['image_name_bn'] = $request['image_name_bn'];
        if($filePath != ""){
            $update['image_name'] = $filePath;
        }
        if($filePathMob != ""){
            $update['image_name_mobile'] = $filePathMob;
        }

        $this->model->where('home_sort', $request['home_sort'])->update($update);
        return $filePath;


    }


}
