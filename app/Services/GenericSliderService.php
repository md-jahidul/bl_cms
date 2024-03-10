<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Helpers\Helper;
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

    public $genericSliderRepository;
    public $myblHomeComponentService;
    public $sliderRepository;
    public $contentComponentRepository;
    public $nonBlComponentRepository;
    public $contentComponentService;
    public $commerceComponentRepository;
    public $commerceComponentService;

    public $lmsHomeComponentService;
    public $nonBlOfferService;
    public $nonBLComponentService;
    protected $genericComponentService, $genericComponentItemService;
    public function __construct(
        GenericSliderRepository $genericSliderRepository,
        MyblHomeComponentService $myblHomeComponentService,
        ContentComponentRepository $contentComponentRepository,
        NonBlComponentRepository $nonBlComponentRepository,
        ContentComponentService $contentComponentService,
        SliderRepository $sliderRepository,
        MyBlCommerceComponentRepository $commerceComponentRepository,
        MyBlCommerceComponentService  $commerceComponentService,
        LmsHomeComponentService $lmsHomeComponentService,
        NonBlOfferService $nonBlOfferService,
        NonBlComponentService $nonBlComponentService,
        GenericComponentService $genericComponentService,
        GenericComponentItemService $genericComponentItemService
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
        $this->lmsHomeComponentService = $lmsHomeComponentService;
        $this->genericComponentService = $genericComponentService;
        $this->genericComponentItemService = $genericComponentItemService;

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
            /**
             * Version Control
             */
            $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
            $data = array_merge($data, $version_code);
            unset($data['android_version_code'], $data['ios_version_code']);

            $genericSlider = $this->save($data);

            $homeComponentData = $this->formatHomeComponentData($data, $genericSlider);

            $genericComponent = $this->genericComponentService->findAll();
            $genericComponentKeys = $genericComponent->pluck('component_key')->toArray();

            if (in_array($data['component_for'], $genericComponentKeys)) {
                $genericComponentId = $this->findGenericComponentId($genericComponent, $data['component_for']);
                $homeComponentData['other_component_name'] = 'generic_slider';
                $homeComponentData['other_component_id'] = $genericSlider->id;
                $homeComponentData['other_component_table_name'] = 'generic_sliders';
                $homeComponentData['generic_component_id'] = $genericComponentId;

                $this->genericComponentItemService->storeComponent($homeComponentData);
            }

            else if (!in_array($data['component_for'], config('generic-slider.top_most_visited_page'))) {
                if ($data['component_for'] == 'home') {
                    $this->myblHomeComponentService->save($homeComponentData);
                    Helper::removeVersionControlRedisKey('home');
                }
                elseif ($data['component_for'] == 'content') {
                    $this->contentComponentRepository->save($homeComponentData);
                    Helper::removeVersionControlRedisKey('content');
                }
                elseif ($data['component_for'] == 'commerce') {
                    $this->commerceComponentRepository->save($homeComponentData);
                    Helper::removeVersionControlRedisKey('commerce');
                }
                elseif ($data['component_for'] == 'lms') {
                    $this->lmsHomeComponentService->save($homeComponentData);
                    $keys = ['lms_component_prepaid', 'lms_component_postpaid', 'lms_old_user_postpaid', 'lms_old_user_prepaid'];
                    Redis::del($keys);
                }
                elseif ($data['component_for'] == 'toffee' || $data['component_for'] == 'toffee_section') {
                    Redis::del('toffee_banner');
                }

                elseif ($data['component_for'] == 'non_bl') {
                    $this->nonBlComponentRepository->save($homeComponentData);
                    Helper::removeVersionControlRedisKey('nonbl');
                }
                elseif ($data['component_for'] == 'non_bl_offer') {
                    $this->nonBlOfferService->save($homeComponentData);
                    Redis::del('non_bl_offer');
                }
            }

            Redis::del(['top_visit_slider', 'generic_component_data']);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
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
        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);

        try {
            DB::beginTransaction();
            $slider = $this->genericSliderRepository->findOne($id);
            $homeComponentData = $this->formatHomeComponentData($data, $slider);
            $genericComponent = $this->genericComponentService->findAll();
            $genericComponentKeys = $genericComponent->pluck('component_key')->toArray();
            if (in_array($data['component_for'], $genericComponentKeys)) {
                $genericItem = $slider['component_type'] == 'ad_inventory' ? $this->genericComponentItemService->findBy(['other_component_name' => 'ad_inventory', 'other_component_id' =>$slider->id])[0]:
                    $this->genericComponentItemService->findBy(['other_component_name' => 'generic_slider', 'other_component_id' =>$slider->id])[0];
                $homeComponentData['display_order'] = $genericItem['display_order'];

                $genericItem->update($homeComponentData);
                Redis::del('generic_component_data');
            }

            else if (!in_array($data['component_for'], config('generic-slider.top_most_visited_page'))) {
                if ($slider['component_for'] == 'home') {
                    $homeComponent = $slider['component_type'] == 'ad_inventory' ? $this->myblHomeComponentService->findBy(['other_component_id' => $slider->id])[0] :
                        $this->myblHomeComponentService->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
                    $homeComponent->update($homeComponentData);
                    Helper::removeVersionControlRedisKey('home');
                } elseif ($slider['component_for'] == 'content') {
                    $contentComponent =  $slider['component_type'] == 'ad_inventory' ? $this->contentComponentRepository->findBy(['other_component_id' => $slider->id])[0] :
                        $this->contentComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
                    $contentComponent->update($homeComponentData);
                    Helper::removeVersionControlRedisKey('content');
                } elseif ($slider['component_for'] == 'commerce') {
                    $commerceComponent =  $slider['component_type'] == 'ad_inventory' ? $this->commerceComponentRepository->findBy(['other_component_id' => $slider->id])[0] :
                        $this->commerceComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
                    $commerceComponent->update($homeComponentData);
                    Helper::removeVersionControlRedisKey('commerce');
                } elseif ($slider['component_for'] == 'lms') {
                    $lmsComponent =  $slider['component_type'] == 'ad_inventory' ? $this->lmsHomeComponentService->findBy(['other_component_id' => $slider->id])[0] : $this->lmsHomeComponentService->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
                    $lmsComponent->update($homeComponentData);

                    $keys = [
                        'lms_component_prepaid',
                        'lms_component_postpaid',
                        'lms_old_user_postpaid',
                        'lms_old_user_prepaid'
                    ];
                    Redis::del($keys);
                } elseif ($slider['component_for'] == 'toffee' || $slider['component_for'] == 'toffee_section') {
                    Redis::del('toffee_banner');
                } elseif ($slider['component_for'] == 'non_bl') {
                    $nonBlComponent =  $slider['component_type'] == 'ad_inventory' ? $this->nonBlComponentRepository->findBy(['other_component_id' => $slider->id])[0] : $this->nonBlComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
                    $nonBlComponent->update($homeComponentData);
                    Helper::removeVersionControlRedisKey('nonbl');
                } elseif ($slider['component_for'] == 'non_bl_offer') {
                    $nonBlComponent =  $slider['component_type'] == 'ad_inventory' ? $this->nonBlOfferService->findBy(['other_component_id' => $slider->id])[0] : $this->nonBlOfferService->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
                    $nonBlComponent->update($homeComponentData);
                    Redis::del('non_bl_offer');
                }
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

//            /**
//             * Version Control
//             */
//            $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
//            $data = array_merge($data, $version_code);
//            unset($data['android_version_code'], $data['ios_version_code']);

            $slider->update($data);
            Redis::del(['top_visit_slider', 'generic_component_data']);

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

            $genericComponent = $this->genericComponentService->findAll();
            $genericComponentKeys = $genericComponent->pluck('component_key')->toArray();

            if (in_array($slider['component_for'], $genericComponentKeys)) {
                $id = $this->genericComponentItemService->findBy(['other_component_name' => 'generic_slider', 'other_component_id' =>$slider->id])[0]['id'];
                $this->genericComponentItemService->deleteComponent($id);
            }

            else if (!in_array($componentFor, config('generic-slider.top_most_visited_page'))) {
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
                else if ($componentFor == 'lms') {
                    $lmsComponent = $this->lmsHomeComponentService->findBy(['component_key' => 'generic_slider_' . $slider->id])->first();
                    $this->lmsHomeComponentService->deleteComponent($lmsComponent->id);
                    $keys = ['lms_component_prepaid', 'lms_component_postpaid', 'lms_old_user_postpaid', 'lms_old_user_prepaid'];
                    Redis::del($keys);
                }
                else if ($componentFor == 'non_bl') {
                    $nonBlComponent = $this->nonBlComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])->first();
                    $this->nonBLComponentService->deleteComponent($nonBlComponent->id);
                }
                else if ($componentFor == 'non_bl_offer') {
                    $nonBlOffer = $this->nonBlOfferService->findBy(['component_key' => 'generic_slider_' . $slider->id])->first();
                    $this->nonBlOfferService->deleteComponent($nonBlOffer->id);
                }
                elseif ($componentFor == 'toffee' || $componentFor == 'toffee_section') {
                    Redis::del('toffee_banner');
                }
            }
            $slider->delete();
            Redis::del(['top_visit_slider', 'generic_component_data']);

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

    public function findGenericComponentId($components, $keyName)
    {
        foreach ($components as $component){
            if ($component['component_key'] == $keyName) {
                return $component['id'];
            }
        }
    }

    public function formatHomeComponentData($data, $genericSlider)
    {
        $homeComponentData = [
            'title_en' => $data['title_en'],
            'title_bn' => $data['title_bn'],
            'display_order' => $this->displayOrder($data['component_for']),
            'is_api_call_enable' => 1,
            'is_eligible' => 0,
            'android_version_code_min' => $data['android_version_code_min'],
            'android_version_code_max' => $data['android_version_code_max'],
            'ios_version_code_min' => $data['android_version_code_min'],
            'ios_version_code_max' => $data['android_version_code_max'],
        ];

        if (isset($data['component_type']) && $data['component_type'] == 'ad_inventory') {
            $homeComponentData['component_key'] = $data['component_type'];
            $homeComponentData['other_component_id'] = $genericSlider->id;
        }

        return $homeComponentData;
    }
}
