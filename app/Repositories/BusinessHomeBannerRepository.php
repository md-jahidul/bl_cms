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
    
    public function saveBannerPhoto($filePath, $sort){
        $this->model->where('home_sort', $sort)->update(array('image_name' => $filePath));
        return $filePath;
        
        
    }


}
