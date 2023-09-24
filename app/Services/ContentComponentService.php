<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\ContentComponentRepository;
use App\Repositories\MyblSliderRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class ContentComponentService
{
    use CrudTrait;

    private $componentRepository;
    private $sliderRepository;

    public function __construct(
        ContentComponentRepository $componentRepository,
        MyblSliderRepository $sliderRepository

    ) {
        $this->componentRepository = $componentRepository;
        $this->sliderRepository = $sliderRepository;
        $this->setActionRepository($componentRepository);
    }

    public function findAllComponents()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $contentSortableComponents = $this->findBy(['is_fixed_position' => false], null, $orderBy)->toArray();

        $homeSecondarySliderCom = $this->sliderRepository->findByProperties(['component_for' => 'content'], [
            'id', 'component_id', 'title as title_en', 'short_code', 'position as display_order'
        ])->toArray();

        $allMergeComponents = array_merge($contentSortableComponents, $homeSecondarySliderCom);
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

            Helper::removeVersionControlRedisKey('content');

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
        Helper::removeVersionControlRedisKey('content');
        return response("Successfully status changed");
    }

    public function storeComponent($data)
    {
        $homeSecondarySliderCount = $this->sliderRepository->findByProperties(['component_id' => 18])->count();
        $contentComponentCount = $this->findAll()->count();

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);

        $data['component_key'] = str_replace(' ', '_', strtolower($data['title_en']));
        $data['display_order'] = $contentComponentCount + $homeSecondarySliderCount + 1;

        $this->save($data);
        Helper::removeVersionControlRedisKey('content');

        return response("Component update successfully!");
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

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);

        $component->update($data);
        Helper::removeVersionControlRedisKey('content');

        return response("Component update successfully!");
    }

    public function deleteComponent($id)
    {
        $component = $this->findOne($id);
        $component->delete();
        Helper::removeVersionControlRedisKey('content');

        return [
            'message' => 'Component delete successfully',
        ];
    }
}
