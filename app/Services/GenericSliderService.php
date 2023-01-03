<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\GenericSliderRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenericSliderService
{
    use CrudTrait;

    protected $genericSliderRepository;
    protected $myblHomeComponentService;
    protected  $sliderRepository;
    public function __construct(
        GenericSliderRepository $genericSliderRepository,
        MyblHomeComponentService $myblHomeComponentService,
        SliderRepository $sliderRepository
    ) {
        $this->genericSliderRepository = $genericSliderRepository;
        $this->myblHomeComponentService = $myblHomeComponentService;
        $this->sliderRepository = $sliderRepository;
        $this->setActionRepository($genericSliderRepository);
    }


    public function storeSlider($data)
    {
        try {
            DB::beginTransaction();

            $homeComponentCount = $this->findAll()->count();
            $homeSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();
            $homeComponentData['component_key'] = "GENERIC" . str_replace(' ', '_', strtolower($data['title_en']));
            $homeComponentData['display_order'] = $homeComponentCount + $homeSecondarySliderCount + 1;
            $homeComponentData['title_en'] = $data['title_en'];
            $homeComponentData['title_bn'] = $data['title_en'];

            $this->myblHomeComponentService->save($homeComponentData);
            $this->genericSliderRepository->save($data);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();
            Log::info($e->getMessage());
        }

        return true;
    }

    public function getSlider()
    {
        return $this->genericSliderRepository->getSlider();
    }


    public function updateSlider($request, $slider)
    {
        $slider->update($request->all());
        return Response('Slider has been successfully updated');
    }

    public function deleteSlider($id)
    {
        $slider = $this->findOne($id);
        $slider->delete();
        return Response('Slider has been successfully deleted');
    }
}
