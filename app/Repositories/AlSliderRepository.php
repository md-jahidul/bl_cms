<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlSlider;

class AlSliderRepository extends BaseRepository
{
    public $modelName = AlSlider::class;

    public function singleSlider()
    {
        return $this->model->where('slider_type', 'single')->get();
    }

    public function multiSlider()
    {
        return $this->model->where('slider_type', 'multiple')->get();
    }
}
