<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\MyBlServiceRepository;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MyBlServiceComponentService
{
    use CrudTrait;

    /**
     * @var MyBlServiceRepository
     */
    private $blServiceRepository;

    public function __construct(
        MyBlServiceRepository $blServiceRepository
    )
    {
        $this->blServiceRepository = $blServiceRepository;
        $this->setActionRepository($blServiceRepository);
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $service_data = $this->blServiceRepository->serviceSequence();
            if (empty($service_data)) {
                $i = 1;
            } else {
                $i = $service_data->sequence + 1;
            }

//            if (isset($data['icon'])) {
//                $data['icon'] = 'storage/' . $data['icon']->store('generic_sliders_icons');
//            }
            $data['status'] = 1;
            $data['sequence'] = $i;

            /**
             * Version Control
             */
            $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
            $data = array_merge($data, $version_code);
            unset($data['android_version_code'], $data['ios_version_code']);

            $service = $this->save($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }

    }

    public function sliderImageTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->blServiceRepository->findOrFail($menu_id);
            $update_menu['sequence'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }

    public function getServices()
    {
        return $this->blServiceRepository->getServices();
    }

    public function updateService($data, $id)
    {
        try {
            DB::beginTransaction();
            $service = $this->blServiceRepository->findOne($id);


//            $homeComponentData['title_en'] = $data['title_en'];
//            $homeComponentData['title_bn'] = $data['title_bn'];
//
//            if (!in_array($data['component_for'], config('generic-slider.top_most_visited_page'))) {
//                if ($slider['component_for'] == 'home') {
//                    $homeComponent = $this->myblHomeComponentService->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
//                    $homeComponent->update($homeComponentData);
//                    Helper::removeVersionControlRedisKey('home');
//                } elseif ($slider['component_for'] == 'content') {
//                    $contentComponent = $this->contentComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
//                    $contentComponent->update($homeComponentData);
//                    Helper::removeVersionControlRedisKey('content');
//                } elseif ($slider['component_for'] == 'commerce') {
//                    $commerceComponent = $this->commerceComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
//                    $commerceComponent->update($homeComponentData);
//                    Helper::removeVersionControlRedisKey('commerce');
//                } elseif ($slider['component_for'] == 'lms') {
//                    $lmsComponent = $this->lmsHomeComponentService->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
//                    $lmsComponent->update($homeComponentData);
//
//                    Helper::removeVersionControlRedisKey('lms');
//                } elseif ($slider['component_for'] == 'toffee' || $slider['component_for'] == 'toffee_section') {
//                    Redis::del('toffee_banner');
//                } elseif ($slider['component_for'] == 'non_bl') {
//                    $nonBlComponent = $this->nonBlComponentRepository->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
//                    $nonBlComponent->update($homeComponentData);
//                    Helper::removeVersionControlRedisKey('nonbl');
//                } elseif ($slider['component_for'] == 'non_bl_offer') {
//                    $nonBlComponent = $this->nonBlOfferService->findBy(['component_key' => 'generic_slider_' . $slider->id])[0];
//                    $nonBlComponent->update($homeComponentData);
//                    Redis::del('non_bl_offer');
//                }
//            }

//            if (isset($data['icon']) && $data['icon'] != 'not-updated' && $data['icon'] != 'removed') {
//                $data['icon'] = 'storage/' . $data['icon']->store('my-bl-services');
//                if (isset($service) && file_exists($service->icon)) {
//                    unlink($service->icon);
//                }
//            } else if (isset($data['icon']) && $data['icon'] == 'removed') {
//                if (isset($service) && file_exists($service->icon)) {
//                    unlink($service->icon);
//                }
//                if (isset($service)) {
//                    $data['icon'] = null;
//                }
//            } else {
//                unset($data['icon']);
//            }

            /**
             * Version Control
             */
            $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
            $data = array_merge($data, $version_code);
            unset($data['android_version_code'], $data['ios_version_code']);

            $service->update($data);
//            Redis::del('top_visit_slider');

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }
    }


    public function deleteService($id): array
    {
        try {
            $this->delete($id);
            return [
                'message' => 'Service deleted successfully',
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'Service delete failed',
            ];
        }
    }


}
