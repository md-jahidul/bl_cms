<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\ContentComponentRepository;
use App\Repositories\GenericSliderRepository;
use App\Repositories\MyBlCommerceComponentRepository;
use App\Repositories\SliderRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class GenericSliderService
{
    use CrudTrait;

    protected $genericSliderRepository;
    protected $myblHomeComponentService;
    protected  $sliderRepository;
    protected $contentComponentRepository;
    protected $contentComponentService;
    protected $commerceComponentRepository;
    protected $commerceComponentService;

    protected $lmsHomeComponentService;
    public function __construct(
        GenericSliderRepository $genericSliderRepository,
        MyblHomeComponentService $myblHomeComponentService,
        ContentComponentRepository $contentComponentRepository,
        ContentComponentService $contentComponentService,
        SliderRepository $sliderRepository,
        MyBlCommerceComponentRepository $commerceComponentRepository,
        MyBlCommerceComponentService  $commerceComponentService,
        LmsHomeComponentService $lmsHomeComponentService

    ) {
        $this->genericSliderRepository = $genericSliderRepository;
        $this->myblHomeComponentService = $myblHomeComponentService;
        $this->sliderRepository = $sliderRepository;
        $this->contentComponentRepository = $contentComponentRepository;
        $this->contentComponentService = $contentComponentService;
        $this->commerceComponentRepository = $commerceComponentRepository;
        $this->commerceComponentService = $commerceComponentService;
        $this->lmsHomeComponentService = $lmsHomeComponentService;
        $this->setActionRepository($genericSliderRepository);
    }


    public function storeSlider($data)
    {
        try {
            DB::beginTransaction();
            $data['status'] = 1;
            $homeComponentData['title_en'] = $data['title_en'];
            $homeComponentData['title_bn'] = $data['title_en'];
            $homeComponentData['display_order'] = $this->displayOrder($data['component_for']);
            $genericSlider = $this->save($data);
            $homeComponentData['component_key'] = "generic-" . $genericSlider->id;
            $homeComponentData['is_api_call_enable'] = 1;

            if ($data['component_for'] == 'home') {
                $this->myblHomeComponentService->save($homeComponentData);
                Redis::del('mybl_home_component');
            }
            elseif ($data['component_for'] == 'content') {
                $this->contentComponentRepository->save($homeComponentData);
                Redis::del('content_component');
            }
            elseif ($data['component_for'] == 'commerce') {
                $this->commerceComponentRepository->save($homeComponentData);
                Redis::del('mybl_commerce_component');
            }
            elseif ($data['component_for'] == 'lms') {
                $this->lmsHomeComponentService->save($homeComponentData);
                Redis::del('lms_component_prepaid');
                Redis::del('lms_component_postpaid');
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {

            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }

    }

    public function getSlider()
    {
        return $this->genericSliderRepository->getSlider();
    }


    public function updateSlider($data, $id)
    {
        try {
            DB::beginTransaction();
            $slider = $this->genericSliderRepository->findOne($id);
            $homeComponentData['title_en'] = $data['title_en'];
            $homeComponentData['title_bn'] = $data['title_bn'];
            if ($slider['component_for'] == 'home') {
                $homeComponent = $this->myblHomeComponentService->findBy(['component_key' =>'generic-' . $slider->id])[0];
                $homeComponent->update($homeComponentData);
                Redis::del('mybl_home_component');
            }
            elseif ($slider['component_for'] == 'content') {
                $contentComponent = $this->contentComponentRepository->findBy(['component_key' =>'generic-' . $slider->id])[0];
                $contentComponent->update($homeComponentData);
                Redis::del('content_component');
            }
            elseif ($slider['component_for'] == 'commerce') {
                $commerceComponent = $this->commerceComponentRepository->findBy(['component_key' =>'generic-' . $slider->id])[0];
                $commerceComponent->update($homeComponentData);
                Redis::del('mybl_commerce_component');
            }
            elseif ($slider['component_for'] == 'lms') {
                $lmsComponent = $this->lmsHomeComponentService->findBy(['component_key' =>'generic-' . $slider->id])[0];
                $lmsComponent->update($homeComponentData);
                Redis::del('lms_component_prepaid');
                Redis::del('lms_component_postpaid');
            }

            $slider->update($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }
    }

    public function deleteSlider($id)
    {
        $slider = $this->findOne($id);
        $slider->delete();
        return Response('Slider has been successfully deleted');
    }

    public function displayOrder($type)
    {
        if ($type == 'home')
        {
            $homeComponentCount = $this->myblHomeComponentService->findAll()->count();
            $homeSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();

            return $homeComponentCount + $homeSecondarySliderCount + 1;
        }

        elseif ($type == 'content')
        {
            $contentComponentCount = $this->contentComponentRepository->findAll()->count();
            $contentSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();

            return $contentSecondarySliderCount + $contentComponentCount + 1;
        }
        elseif ($type == 'commerce')
        {
            $commerceComponentCount = $this->commerceComponentRepository->findAll()->count();
            $contentSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();

            return $contentSecondarySliderCount + $commerceComponentCount + 1;
        }
        elseif ($type == 'lms')
        {
            $lmsHomeComponentCount = $this->lmsHomeComponentService->findAll()->count();

            return $lmsHomeComponentCount + 1;
        }

        return 1;
    }

    public function deleteComponent($id)
    {
        try {
            $slider = $this->findOne($id);
            $componentFor = $slider['component_for'];

            if ($componentFor == 'home') {
                $homeComponent = $this->myblHomeComponentService->findBy(['component_key' => 'generic-' . $slider->id])->first();
                $this->myblHomeComponentService->deleteComponent($homeComponent->id);
            }
            else if ($componentFor == 'content') {
                $contentComponent = $this->contentComponentRepository->findBy(['component_key' => 'generic-' . $slider->id])->first();
                $this->contentComponentService->deleteComponent($contentComponent->id);
            }
            else if ($componentFor == 'commerce') {
                $commerceComponent = $this->commerceComponentRepository->findBy(['component_key' => 'generic-' . $slider->id])->first();
                $this->commerceComponentService->deleteComponent($commerceComponent->id);
            }
            else if ($componentFor == 'lms') {
                $lmsComponent = $this->lmsHomeComponentService->findBy(['component_key' => 'generic-' . $slider->id])->first();
                $this->lmsHomeComponentService->deleteComponent($lmsComponent->id);
                Redis::del('lms_component_prepaid');
                Redis::del('lms_component_postpaid');
            }
            $slider->delete();

            return [
                'message' => 'Slider delete successfully',
            ];
        } catch (\Exception $e)
        {
            return [
                'message' => 'Slider delete failed',
            ];
        }

    }
}
