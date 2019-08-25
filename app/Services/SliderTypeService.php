<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 25/08/19
 * Time: 13:05
 */

namespace App\Services;


use App\Repositories\SliderTypeRepository;
use App\Traits\CrudTrait;

class SliderTypeService
{
    use CrudTrait;

    private $sliderTypeRepository;

    public function __construct(SliderTypeRepository $sliderTypeRepository)
    {
        $this->sliderTypeRepository = $sliderTypeRepository;
        $this->setActionRepository($sliderTypeRepository);
    }

}