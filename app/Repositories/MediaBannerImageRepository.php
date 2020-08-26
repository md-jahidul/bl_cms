<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\MediaBannerImage;
use App\Models\Prize;

class MediaBannerImageRepository extends BaseRepository
{
    public $modelName = MediaBannerImage::class;

    public function getBannerImage()
    {
        return $this->model->whereIn('module_type', ['press_release', 'news_event'])
            ->get();
    }

    public function bannerUpload($data)
    {
        return $this->model->updateOrCreate(['module_type' => $data['module_type']], $data);
    }
}
