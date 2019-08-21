<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;

class SliderService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $sliderRepository;

    /**
     * DigitalServicesService constructor.
     * @param SliderRepository $sliderRepository
     */
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
        $this->setActionRepository($sliderRepository);
    }

}
