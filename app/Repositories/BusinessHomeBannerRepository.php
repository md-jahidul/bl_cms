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
    
    public function saveBannerPhoto($filePath, $altText, $sort){
        $update = [];
        $update['alt_text'] = $altText;
        if($filePath != ""){
        $update['image_name'] = $filePath;
        }
        $this->model->where('home_sort', $sort)->update($update);
        return $filePath;
        
        
    }


}
