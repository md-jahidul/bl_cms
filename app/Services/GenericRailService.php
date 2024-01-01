<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\GenericRailRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class GenericRailService
{
    use CrudTrait;
    public  $genericRailRepository;
    public $genericSliderService;
    public function __construct(
        GenericRailRepository $genericRailRepository,
        GenericSliderService $genericSliderService
    ) {
        $this->genericRailRepository = $genericRailRepository;
        $this->genericSliderService = $genericSliderService;
        $this->setActionRepository($genericRailRepository);

    }

    public function findAll()
    {
        return $this->genericRailRepository->findAll();
    }

    public function save($data)
    {
        try {
            DB::beginTransaction();

            $data = $this->parseVersionCode($data);

            $rail = $this->genericRailRepository->save($data);
            $homeComponentData = $this->formatDataForHomeComponent($rail);

            if ($data['component_for'] == 'home') {
                $this->genericSliderService->myblHomeComponentService->save($homeComponentData);
                Helper::removeVersionControlRedisKey('home');
            }
            elseif ($data['component_for'] == 'content') {
                $this->genericSliderService->contentComponentRepository->save($homeComponentData);
                Helper::removeVersionControlRedisKey('content');
            }
            elseif ($data['component_for'] == 'commerce') {
                $this->genericSliderService->commerceComponentRepository->save($homeComponentData);
                Helper::removeVersionControlRedisKey('commerce');
            }
            elseif ($data['component_for'] == 'lms') {
                $this->genericSliderService->lmsHomeComponentService->save($homeComponentData);
                Helper::removeVersionControlRedisKey('lms');
            }
            elseif ($data['component_for'] == 'non_bl') {
                $this->genericSliderService->nonBlComponentRepository->save($homeComponentData);
                Helper::removeVersionControlRedisKey('nonbl');
            }
            DB::commit();
            return true;

        } catch (\Exception $exception) {

            DB::rollback();
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function update($genericRailId, $data)
    {
        try {
            DB::beginTransaction();
            $rail = $this->genericRailRepository->findOne($genericRailId);
            $data = $this->parseVersionCode($data);
            $homeComponentData = $this->formatDataForHomeComponent($data, true);

            if ($rail['component_for'] == 'home') {
                $homeComponent = $this->genericSliderService->myblHomeComponentService->findBy(['other_component_id' => $genericRailId])[0];
                $homeComponent->update($homeComponentData);
                Helper::removeVersionControlRedisKey('home');

            } elseif ($rail['component_for'] == 'content') {

                $contentComponent = $this->genericSliderService->contentComponentRepository->findBy(['other_component_id' => $genericRailId])[0];
                $contentComponent->update($homeComponentData);
                Helper::removeVersionControlRedisKey('content');

            } elseif ($rail['component_for'] == 'commerce') {
                $commerceComponent = $this->genericSliderService->commerceComponentRepository->findBy(['other_component_id' => $genericRailId])[0];
                $commerceComponent->update($homeComponentData);
                Helper::removeVersionControlRedisKey('commerce');

            } elseif ($rail['component_for'] == 'lms') {
                $lmsComponent = $this->genericSliderService->lmsHomeComponentService->findBy(['other_component_id' => $genericRailId])[0];
                $lmsComponent->update($homeComponentData);
                Helper::removeVersionControlRedisKey('lms');

            } elseif ($rail['component_for'] == 'non_bl') {

                $nonBlComponent = $this->genericSliderService->nonBlComponentRepository->findBy(['other_component_id' => $genericRailId])[0];
                $nonBlComponent->update($homeComponentData);
                Helper::removeVersionControlRedisKey('nonbl');
            }

            $rail->update($data);

            DB::commit();
            return true;

        } catch (\Exception $e) {

            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }
    }

    public function delete($genericRailId)
    {
        try {
            DB::beginTransaction();
            $rail = $this->genericRailRepository->findOne($genericRailId);


            if ($rail['component_for'] == 'home') {
                $homeComponent = $this->genericSliderService->myblHomeComponentService->findBy(['other_component_id' => $genericRailId])[0];
                $homeComponent->delete();

                Helper::removeVersionControlRedisKey('home');

            } elseif ($rail['component_for'] == 'content') {

                $contentComponent = $this->genericSliderService->contentComponentRepository->findBy(['other_component_id' => $genericRailId])[0];
                $contentComponent->delete();

                Helper::removeVersionControlRedisKey('content');

            } elseif ($rail['component_for'] == 'commerce') {
                $commerceComponent = $this->genericSliderService->commerceComponentRepository->findBy(['other_component_id' => $genericRailId])[0];
                $commerceComponent->delete();

                Helper::removeVersionControlRedisKey('commerce');

            } elseif ($rail['component_for'] == 'lms') {
                $lmsComponent = $this->genericSliderService->lmsHomeComponentService->findBy(['other_component_id' => $genericRailId])[0];
                $lmsComponent->delete();

                Helper::removeVersionControlRedisKey('lms');

            } elseif ($rail['component_for'] == 'non_bl') {

                $nonBlComponent = $this->genericSliderService->nonBlComponentRepository->findBy(['other_component_id' => $genericRailId])[0];
                $nonBlComponent->delete();

                Helper::removeVersionControlRedisKey('nonbl');
            }

            $rail->delete();

            DB::commit();
            return [
                'message' => 'Slider delete successfully',
            ];

        } catch (\Exception $e) {

            DB::rollback();
            Log::info($e->getMessage());
            return [
                'message' => 'Slider delete failed',
            ];
        }
    }
    public function parseVersionCode($data)
    {
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);

        return $data;
    }

    public function formatDataForHomeComponent($rail, $flag = false)
    {
        $data =  [
            'title_en' => $rail['title_en'],
            'title_bn' => $rail['title_bn'],
            'android_version_code_min' => $rail['android_version_code_min'],
            'android_version_code_max' => $rail['android_version_code_max'],
            'ios_version_code_min' => $rail['ios_version_code_min'],
            'ios_version_code_max' => $rail['ios_version_code_max'],
            'cta_name_en' => $rail['cta_name_en'],
            'cta_name_bn' => $rail['cta_name_bn'],
            'deeplink' => $rail['deeplink'],
            'icon' => $rail['icon']

        ];

        if (!$flag){
            $data['display_order'] = $this->genericSliderService->displayOrder($rail['component_for']);
            $data['is_api_call_enable'] = 1;
            $data['is_eligible'] = 0;
            $data['component_key'] = "generic_rail";
            $data['other_component_id'] = $rail['id'];
        }

        return $data;
    }
}
