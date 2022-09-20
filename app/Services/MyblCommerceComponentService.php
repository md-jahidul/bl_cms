<?php

namespace App\Services;

use App\Repositories\AboutUsRepository;
use App\Repositories\MyblCommerceComponentRepository;
use App\Repositories\MyblSliderRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class MyblCommerceComponentService
{
    use CrudTrait;

    private $componentRepository;
    /**
     * @var MyblSliderRepository
     */
    private $sliderRepository;

    protected const REDIS_KEY = "mybl_home_component";

    public function __construct(
        MyblCommerceComponentRepository $componentRepository,
        MyblSliderRepository $sliderRepository
    ) {
        $this->componentRepository = $componentRepository;
        $this->sliderRepository = $sliderRepository;
        $this->setActionRepository($componentRepository);
    }

    public function findAllComponents()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $commerceSortableComponents = $this->findBy(['is_fixed_position' => false], null, $orderBy)->toArray();

        $homeSecondarySliderCom = $this->sliderRepository->findByProperties(['component_id' => 19], [
            'id', 'component_id', 'title as title_en', 'short_code', 'position as display_order'
        ])->toArray();

        $allMergeComponents = array_merge($commerceSortableComponents, $homeSecondarySliderCom);
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
        $component->is_api_call_enable = $component->is_api_call_enable ? 0 : 1;
        $component->save();
        Redis::del(self::REDIS_KEY);
        return response("Successfully status changed");
    }

    public function storeComponent($data)
    {
        $homeSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();
        $commerceComponentCount = $this->findAll()->count();

        $data['component_key'] = str_replace(' ', '_', strtolower($data['title_en']));
        $data['display_order'] = $commerceComponentCount + $homeSecondarySliderCount + 1;

        $this->save($data);
        Redis::del(self::REDIS_KEY);
        return response("Component update successfully!");
    }

    public function updateComponent($data)
    {
        $component = $this->findOne($data['id']);
        $component->update($data);
        Redis::del(self::REDIS_KEY);
        return response("Component update successfully!");
    }

    public function deleteComponent($id)
    {
        $component = $this->findOne($id);
        $component->delete();
        Redis::del(self::REDIS_KEY);
        return [
            'message' => 'Component delete successfully',
        ];
    }
}
