<?php

namespace App\Services;

use App\Repositories\AboutUsRepository;
use App\Repositories\MyblHomeComponentRepository;
use App\Repositories\MyblSliderRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblHomeComponentService
{
    use CrudTrait;

    /**
     * @var MyblHomeComponentRepository
     */
    private $componentRepository;
    /**
     * @var MyblSliderRepository
     */
    private $sliderRepository;


    /**
     * MyblHomeComponentService constructor.
     * @param MyblHomeComponentRepository $componentRepository
     */
    public function __construct(
        MyblHomeComponentRepository $componentRepository,
        MyblSliderRepository $sliderRepository
    ) {
        $this->componentRepository = $componentRepository;
        $this->sliderRepository = $sliderRepository;
        $this->setActionRepository($componentRepository);
    }

    public function findAllComponents()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $homeFixedComponents = $this->findBy(['is_fixed_position' => true], null, $orderBy);
        $homeSortableComponents = $this->findBy(['is_fixed_position' => false], null, $orderBy)->toArray();

        $homeSecondarySliderCom = $this->sliderRepository->findByProperties(['component_id' => 18], [
            'id', 'component_id', 'title as title_en', 'short_code', 'position as display_order'
        ])->toArray();

        $allMergeComponents = array_merge($homeSortableComponents, $homeSecondarySliderCom);
        $allMergeComponents = collect($allMergeComponents)->sortBy('display_order')->values()->all();

        return [
            'fixed_components' => $homeFixedComponents,
            'sortable_components' => $allMergeComponents
        ];
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
                    $update_menu['display_order'] = $new_position + 4;
                    $update_menu->update();
                } else {
                    $update_menu = $this->sliderRepository->findOneByProperties([
                        'id' => $menu_id, 'component_id' => $componentId
                    ]);
                    $update_menu['position'] = $new_position + 4;
                    $update_menu->update();
                }
            }
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
        $component->is_eligible = $component->is_eligible ? 0 : 1;
        $component->save();
        return response("Successfully status changed");
    }

    public function updateComponent($data)
    {
        $component = $this->findOne($data['id']);
//        dd($request->all());
//        dd($component);
//        $component->is_eligible = $component->is_eligible ? 0 : 1;
        $component->update($data);
        return response("Component update successfully!");
    }
}
