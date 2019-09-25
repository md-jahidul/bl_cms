<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\Slider;
use DB;

class SliderRepository extends BaseRepository
{
    public $modelName = Slider::class;

    public function getAppSlider(){
        return $this->modelName::with('sliderImages')->where('platform','App')->get();
    }
}
