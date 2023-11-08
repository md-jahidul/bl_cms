<?php

namespace App\Services;

use App\Repositories\GenericComponentItemRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class GenericComponentItemService
{
    use CrudTrait;

    private $genericComponentItemRepository;

    protected const REDIS_KEY = "lms_component";

    public function __construct(
        GenericComponentItemRepository $genericComponentItemRepository
    ) {
        $this->genericComponentItemRepository = $genericComponentItemRepository;
        $this->setActionRepository($genericComponentItemRepository);
    }

    public function findAllItems($id)
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $contentSortableComponents = $this->findBy(['generic_component_id' => $id], null, $orderBy)->toArray();

        return collect($contentSortableComponents)->sortBy('display_order')->values()->all();

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

        return response("Successfully status changed");
    }

    public function storeComponent($data)
    {
        $msComponentCount = $this->findAll()->count();

        $data['component_key'] = str_replace(' ', '_', strtolower($data['title_en']));
        $data['display_order'] = $msComponentCount + 1;

        $this->save($data);

        return response("LMS Component update successfully!");
    }

    public function editComponent($id)
    {
        $component = $this->findOne($id);
        $android_version_code = implode('-', [$component['android_version_code_min'], $component['android_version_code_max']]);
        $ios_version_code = implode('-', [$component['ios_version_code_min'], $component['ios_version_code_max']]);
        $component->android_version_code = $android_version_code;
        $component->ios_version_code = $ios_version_code;

        return $component;
    }

    public function updateComponent($data)
    {
        $component = $this->findOne($data['id']);
        $component->update($data);

        return response("LMS Component update successfully!");
    }

    public function deleteComponent($id)
    {
        $this->genericComponentItemRepository->delete($id);

        return [
            'message' => 'Component delete successfully',
        ];
    }
}
