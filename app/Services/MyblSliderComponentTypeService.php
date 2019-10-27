<?php

namespace App\Services;

use App\Repositories\MyblSliderComponentTypeRepository;
use App\Traits\CrudTrait;

class MyblSliderComponentTypeService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $myblSliderTypeRepository;

    /**
     * MyblSliderComponentTypeService constructor.
     * @param MyblSliderComponentTypeRepository $sliderTypeRepository
     */
    public function __construct(MyblSliderComponentTypeRepository $myblSliderComponentTypeRepository)
    {
        $this->myblSliderTypeRepository = $myblSliderComponentTypeRepository;
        $this->setActionRepository($myblSliderComponentTypeRepository);
    }
}
