<?php

namespace App\Services;

use App\Repositories\ContentComponentRepository;
use App\Repositories\GroupComponentRepository;
use App\Repositories\MyBlCommerceComponentRepository;
use App\Repositories\MyblSliderRepository;
use App\Repositories\NonBlComponentRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class GroupComponentService
{
    use CrudTrait;

    protected $componentRepository;
    protected $genericSliderRepository;
    protected $myblHomeComponentService;
    protected $sliderRepository;
    protected $contentComponentRepository;
    protected $nonBlComponentRepository;
    protected $contentComponentService;
    protected $commerceComponentRepository;
    protected $commerceComponentService;

    protected const REDIS_KEY = "group_component";

    public function __construct(
        GroupComponentRepository $componentRepository,
        MyblHomeComponentService $myblHomeComponentService,
        ContentComponentRepository $contentComponentRepository,
        NonBlComponentRepository $nonBlComponentRepository,
        ContentComponentService $contentComponentService,
        MyblSliderRepository $sliderRepository,
        MyBlCommerceComponentRepository $commerceComponentRepository,
        MyBlCommerceComponentService  $commerceComponentService
    ) {
        $this->componentRepository = $componentRepository;
        $this->sliderRepository = $sliderRepository;
        $this->myblHomeComponentService = $myblHomeComponentService;
        $this->sliderRepository = $sliderRepository;
        $this->contentComponentRepository = $contentComponentRepository;
        $this->nonBlComponentRepository = $nonBlComponentRepository;
        $this->contentComponentService = $contentComponentService;
        $this->commerceComponentRepository = $commerceComponentRepository;
        $this->commerceComponentService = $commerceComponentService;
        $this->setActionRepository($componentRepository);
    }

    public function findAllComponents()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $allMergeComponents = $this->findBy(['is_fixed_position' => false], null, $orderBy)->toArray();

        return collect($allMergeComponents)->sortBy('display_order')->values()->all();
    }

    /**
     * @param $request
     * @return array
     */
    public function tableSort($request)
    {
        try {
            $positions = $request->position;
            foreach ($positions as $position) {
                $menu_id = $position['id'];
                $new_position = $position['serial'];
                $componentId = $position['component_id'];
                if ($componentId == 0) {
                    $update_menu = $this->findOne($menu_id);
                    $update_menu['display_order'] = $new_position;
                    $update_menu->update();
                } else {
                    $update_menu = $this->sliderRepository->findOneByProperties([
                        'id' => $menu_id, 'component_id' => $componentId
                    ]);
                    $update_menu['position'] = $new_position;
                    $update_menu->update();
                }
            }
            Redis::del(self::REDIS_KEY);
            return [
                'status' => "success",
                'massage' => "Order Changed successfully"
            ];
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
            return [
                'status' => "error",
                'massage' => $error
            ];
        }
    }

    /**
     * @param $id
     * @return Application|ResponseFactory|Response
     */
    public function changeStatus($id)
    {
        $component = $this->findOne($id);
        $component->active = $component->active ? 0 : 1;
        $component->is_api_call_enable = $component->active;
        $component->save();
        Redis::del(self::REDIS_KEY);
        return response("Successfully status changed");
    }

    public function storeComponent($data)
    {
        try {
            DB::beginTransaction();
            
            $member_1 = json_decode($data['member_1'], true);
            $member_2 = json_decode($data['member_2'], true);
            $data['member_1_id'] = $member_1['id'];
            $data['member_1_type'] = $member_1['type'];
            $data['member_2_id'] = $member_2['id'];
            $data['member_2_type'] = $member_2['type'];
            $data['is_api_call_enable'] = $data['active'];
            $data['display_order'] = $this->displayOrder($data['component_for']);
            
            unset($data['member_1'], $data['member_2']);

            $component = $this->save($data);

            $data['component_key'] = 'group' . '-' . $component->id;
    
            if ($data['component_for'] == 'home') {
                $this->myblHomeComponentService->save($data);
                Redis::del('mybl_home_component');
            }
            elseif ($data['component_for'] == 'content') {
                $this->contentComponentRepository->save($data);
                Redis::del('content_component');
            }
            elseif ($data['component_for'] == 'commerce') {
                $this->commerceComponentRepository->save($data);
                Redis::del('mybl_commerce_component');
            }
            elseif ($data['component_for'] == 'non_bl') {
                $this->nonBlComponentRepository->save($data);
                Redis::del('non_bl_component');
            }
            
            $homeSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();
            $groupComponentCount = $this->findAll()->count();
            $data['display_order'] = $groupComponentCount + $homeSecondarySliderCount + 1;
    
            Redis::del(self::REDIS_KEY);

            DB::commit();

            return true;
        } catch(\Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }
        
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

        return 1;
    }

    public function updateComponent($data, $id)
    {
        try {
            DB::beginTransaction();

            $component = $this->findOne($id);

            $member_1 = json_decode($data['member_1'], true);
            $member_2 = json_decode($data['member_2'], true);
            $data['member_1_id'] = $member_1['id'];
            $data['member_1_type'] = $member_1['type'];
            $data['member_2_id'] = $member_2['id'];
            $data['member_2_type'] = $member_2['type'];
            $data['is_api_call_enable'] = $data['active'];
            $data['display_order'] = $this->displayOrder($data['component_for']);
            
            unset($data['member_1'], $data['member_2']);

            $componentKey = str_replace(' ', '_', strtolower($component['title_en'])) . '-' . $component->id;

            if ($component['component_for'] == 'home') {
                $homeComponent = $this->myblHomeComponentService->findBy(['component_key' => $componentKey])[0];
                $homeComponent->update($data);
                Redis::del('mybl_home_component');
            }
            elseif ($component['component_for'] == 'content') {
                $contentComponent = $this->contentComponentRepository->findBy(['component_key' => $componentKey])[0];
                $contentComponent->update($data);
                Redis::del('content_component');
            }
            elseif ($component['component_for'] == 'commerce') {
                $commerceComponent = $this->commerceComponentRepository->findBy(['component_key' => $componentKey])[0];
                $commerceComponent->update($data);
                Redis::del('mybl_commerce_component');
            }
            elseif ($component['component_for'] == 'non_bl') {
                $nonBlComponent = $this->nonBlComponentRepository->findBy(['component_key' => $componentKey])[0];
                $nonBlComponent->update($data);
                Redis::del('non_bl_component');
            }
            $component->update($data);
            DB::commit();
            
            Redis::del(self::REDIS_KEY);

            return true;
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }
    }

    public function deleteComponent($id)
    {
        try {
            DB::beginTransaction();

            $component = $this->findOne($id);
            $componentFor = $component['component_for'];
            
            $componentKey = str_replace(' ', '_', strtolower($component['title_en'])) . '-' . $component->id;
            
            if ($componentFor == 'home') {
                $homeComponent = $this->myblHomeComponentService->findBy(['component_key' => $componentKey])->first();
                $this->myblHomeComponentService->deleteComponent($homeComponent->id);
            }
            else if ($componentFor == 'content') {
                $contentComponent = $this->contentComponentRepository->findBy(['component_key' => $componentKey])->first();
                $this->contentComponentService->deleteComponent($contentComponent->id);
            }
            else if ($componentFor == 'commerce') {
                $commerceComponent = $this->commerceComponentRepository->findBy(['component_key' => $componentKey])->first();
                $this->commerceComponentService->deleteComponent($commerceComponent->id);
            }
            else if ($componentFor == 'non_bl') {
                $nonBlComponent = $this->nonBlComponentRepository->findBy(['component_key' => $componentKey])->first();
                $this->nonBlComponentRepository->delete($nonBlComponent);
            }
            $component->delete();
            DB::commit();
            Redis::del(self::REDIS_KEY);
            return true;
        } catch (\Exception $e)
        {
            DB::rollBack();
            return false;
        }
    }
}
