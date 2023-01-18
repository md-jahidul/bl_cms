<?php

namespace App\Repositories;

use App\Models\GenericSlider;

class GenericSliderRepository extends BaseRepository
{
    public $modelName = GenericSlider::class;

    public function getSlider()
    {
        return $this->modelName::where('status', 1)->get();
    }

}
