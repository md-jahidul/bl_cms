<?php

namespace App\Services;

use App\Repositories\MyblSliderRepository;
use App\Repositories\NonBlComponentRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class NonBlComponentService
{
    use CrudTrait;

    private $componentRepository;
    /**
     * @var MyblSliderRepository
     */
    private $sliderRepository;
    private $myblHomeComponentService;

    protected const REDIS_KEY = "non_bl_component";

    public function __construct(
        NonBlComponentRepository $componentRepository,
        MyblSliderRepository $sliderRepository,
        MyblHomeComponentService $myblHomeComponentService
    ) {
        $this->componentRepository = $componentRepository;
        $this->sliderRepository = $sliderRepository;
        $this->myblHomeComponentService = $myblHomeComponentService;
        $this->setActionRepository($componentRepository);
    }

    public function findAllComponents()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $nonBlSortableComponents = $this->findBy(['is_fixed_position' => false], null, $orderBy)->toArray();

        $homeSecondarySliderCom = $this->sliderRepository->findByProperties(['component_for' => 'non_bl'], [
            'id', 'component_id', 'title as title_en', 'short_code', 'position as display_order'
        ])->toArray();

        $allMergeComponents = array_merge($nonBlSortableComponents, $homeSecondarySliderCom);
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
            $this->myblHomeComponentService->removeVersionControlRedisKey('nonbl');
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
        $component->is_api_call_enable = $component->is_api_call_enable ? 0 : 1;
        $component->save();
        $this->myblHomeComponentService->removeVersionControlRedisKey('nonbl');
        return response("Successfully status changed");
    }

    public function storeComponent($data)
    {
        $homeSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();
        $nonBlComponentCount = $this->findAll()->count();

        $data['component_key'] = str_replace(' ', '_', strtolower($data['title_en']));;
        $data['display_order'] = $nonBlComponentCount + $homeSecondarySliderCount + 1;
        $data['is_eligible'] = 0;

        $this->save($data);
        $this->myblHomeComponentService->removeVersionControlRedisKey('nonbl');
        return response("Component update successfully!");
    }

    public function updateComponent($data)
    {
        $component = $this->findOne($data['id']);
        $component->update($data);
        $this->myblHomeComponentService->removeVersionControlRedisKey('nonbl');
        return response("Component update successfully!");
    }

    public function deleteComponent($id)
    {
        $component = $this->findOne($id);
        $component->delete();
        $this->myblHomeComponentService->removeVersionControlRedisKey('nonbl');
        return [
            'message' => 'Component delete successfully',
        ];
    }
}
