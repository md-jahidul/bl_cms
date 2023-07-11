<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\NonBlComponentRepository;
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
    protected $sliderRepository;
    protected $contentComponentRepository;
    protected $nonBlComponentRepository;
    protected $contentComponentService;
    protected $commerceComponentRepository;
    protected $commerceComponentService;
    protected $nonBlOfferService;
    protected $nonBLComponentService;
    public function __construct(
        GenericSliderRepository $genericSliderRepository,
        MyblHomeComponentService $myblHomeComponentService,
        ContentComponentRepository $contentComponentRepository,
        NonBlComponentRepository $nonBlComponentRepository,
        ContentComponentService $contentComponentService,
        SliderRepository $sliderRepository,
        MyBlCommerceComponentRepository $commerceComponentRepository,
        MyBlCommerceComponentService  $commerceComponentService,
        NonBlOfferService $nonBlOfferService,
        NonBlComponentService $nonBlComponentService
    ) {
        $this->genericSliderRepository = $genericSliderRepository;
        $this->myblHomeComponentService = $myblHomeComponentService;
        $this->sliderRepository = $sliderRepository;
        $this->contentComponentRepository = $contentComponentRepository;
        $this->nonBlComponentRepository = $nonBlComponentRepository;
        $this->contentComponentService = $contentComponentService;
        $this->commerceComponentRepository = $commerceComponentRepository;
        $this->commerceComponentService = $commerceComponentService;
        $this->nonBlOfferService = $nonBlOfferService;
        $this->nonBLComponentService = $nonBlComponentService;
        $this->setActionRepository($genericSliderRepository);
    }


    public function storeSlider($data)
    {
        try {
            DB::beginTransaction();

            if (isset($data['icon'])) {
                $data['icon'] = 'storage/' . $data['icon']->store('generic_sliders_icons');
            }

            $data['status'] = 1;
            $genericSlider = $this->save($data);

            $homeComponentData['title_en'] = $data['title_en'];
            $homeComponentData['title_bn'] = $data['title_bn'];
            $homeComponentData['display_order'] = $this->displayOrder($data['component_for']);
            $homeComponentData['component_key'] = "generic_slider_" . $genericSlider->id;
            $homeComponentData['is_api_call_enable'] = 1;
            $homeComponentData['is_eligible'] = 0;

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
            elseif ($data['component_for'] == 'non_bl') {
                $this->nonBlComponentRepository->save($homeComponentData);
                Redis::del('non_bl_component');
            }
            elseif ($data['component_for'] == 'non_bl_offer') {
                $this->nonBlOfferService->save($homeComponentData);
                Redis::del('non_bl_offer');
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
                $homeComponent = $this->myblHomeComponentService->findBy(['component_key' =>'generic_slider_' . $slider->id])[0];
                $homeComponent->update($homeComponentData);
                Redis::del('mybl_home_component');
            }
            elseif ($slider['component_for'] == 'content') {
                $contentComponent = $this->contentComponentRepository->findBy(['component_key' =>'generic_slider_' . $slider->id])[0];
                $contentComponent->update($homeComponentData);
                Redis::del('content_component');
            }
            elseif ($slider['component_for'] == 'commerce') {
                $commerceComponent = $this->commerceComponentRepository->findBy(['component_key' =>'generic_slider_' . $slider->id])[0];
                $commerceComponent->update($homeComponentData);
                Redis::del('mybl_commerce_component');
            }
            elseif ($slider['component_for'] == 'non_bl') {
                $nonBlComponent = $this->nonBlComponentRepository->findBy(['component_key' =>'generic_slider_' . $slider->id])[0];
                $nonBlComponent->update($homeComponentData);
                Redis::del('non_bl_component');
            }
            elseif ($slider['component_for'] == 'non_bl_offer') {
                $nonBlComponent = $this->nonBlOfferService->findBy(['component_key' =>'generic_slider_' . $slider->id])[0];
                $nonBlComponent->update($homeComponentData);
                Redis::del('non_bl_offer');
            }

            if (isset($data['icon']) && $data['icon'] != 'not-updated' && $data['icon'] != 'removed') {
                $data['icon'] = 'storage/' . $data['icon']->store('generic_sliders_icons');
                if (isset($slider) && file_exists($slider->icon)) {
                    unlink($slider->icon);
                }
            } else if (isset($data['icon']) && $data['icon'] == 'removed') {
                if (isset($slider) && file_exists($slider->icon)) {
                    unlink($slider->icon);
                }
                if (isset($slider)) {
                    $data['icon'] = null;
                }
            } else {
                unset($data['icon']);
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
        elseif ($type == 'non_bl')
        {
            $nonBlComponentCount = $this->nonBlComponentRepository->findAll()->count();
            $contentSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();

            return $contentSecondarySliderCount + $nonBlComponentCount + 1;
        }
        elseif ($type == 'non_bl_offer')
        {
            $nonBlofferCount = $this->nonBlOfferService->findAll()->count();
            $contentSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();

            return $contentSecondarySliderCount + $nonBlofferCount + 1;
        }

        return 1;
    }

    public function deleteComponent($id)
    {
        try {
            $slider = $this->findOne($id);
            $componentFor = $slider['component_for'];

            if ($componentFor == 'home') {
                $homeComponent = $this->myblHomeComponentService->findBy(['component_key' => 'generic_slider_' . $slider->id])->first();
                $this->myblHomeComponentService->deleteComponent($homeComponent->id);
            }
            else if ($componentFor == 'content') {
                $contentComponent = $this->contentComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])->first();
                $this->contentComponentService->deleteComponent($contentComponent->id);
            }
            else if ($componentFor == 'commerce') {
                $commerceComponent = $this->commerceComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])->first();
                $this->commerceComponentService->deleteComponent($commerceComponent->id);
            }
            else if ($componentFor == 'non_bl') {
                $nonBlComponent = $this->nonBlComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])->first();
                $this->nonBLComponentService->deleteComponent($nonBlComponent);
            }
            else if ($componentFor == 'non_bl_offer') {
                $nonBlOffer = $this->nonBlOfferService->findBy(['component_key' => 'generic_slider_' . $slider->id])->first();
                $this->nonBlOfferService->deleteComponent($nonBlOffer);
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
