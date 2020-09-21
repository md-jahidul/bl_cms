<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\BanglalinkThreeG;
use App\Models\FourGLandingPage;
use App\Models\MediaLandingPage;

class BanglalinkThreeGRepository extends BaseRepository
{
    public $modelName = BanglalinkThreeG::class;

    public function findWithoutBanner()
    {
        return $this->model->where('type', '!=', 'banner_image')
            ->get();
    }
}
