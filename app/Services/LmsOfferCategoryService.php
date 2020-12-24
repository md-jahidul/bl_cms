<?php

namespace App\Services;

use App\Repositories\AlSliderRepository;
use App\Repositories\LmsOfferCategoryRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class LmsOfferCategoryService
{
    use CrudTrait;

    /**
     * @var $alSliderRepository
     */
    protected $alSliderRepository;
    /**
     * @var LmsOfferCategoryRepository
     */
    private $lmsOfferCategoryRepository;

    /**
     * LmsOfferCategoryService constructor.
     * @param LmsOfferCategoryRepository $lmsOfferCategoryRepository
     */
    public function __construct(LmsOfferCategoryRepository $lmsOfferCategoryRepository)
    {
        $this->lmsOfferCategoryRepository = $lmsOfferCategoryRepository;
        $this->setActionRepository($lmsOfferCategoryRepository);
    }

    public function shortCodeSliders($shortCode)
    {
        return $this->alSliderRepository->findByProperties(['short_code' => $shortCode]);
    }

    /**
     * Storing the slider resource
     * @return Response
     */
    public function storeLmsOfferCat($data)
    {
        $this->save($data);
        return new Response('Lms offer category added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateSlider($data, $id)
    {
        $slider = $this->findOne($id);
        $slider->update($data);
        return Response('Slider updated successfully !');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteLmsOfferCat($id)
    {
        $lmsOfferCat = $this->findOne($id);
//        dd($lmsOfferCat);
        $lmsOfferCat->delete();
        return Response('LMS offer category deleted successfully !');
    }
}
