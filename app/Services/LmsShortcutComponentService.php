<?php

namespace App\Services;

use App\Repositories\ContentComponentRepository;
use App\Repositories\LmsHomeComponentRepository;
use App\Repositories\LmsShortcutComponentRepository;
use App\Repositories\MyblSliderRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class LmsShortcutComponentService
{
    use CrudTrait;

    private $lmsShortcutComponentRepository;

    protected const REDIS_KEY_PREPAID = "lms_component_prepaid";
    protected const REDIS_KEY_POSTPAID = "lms_component_postpaid";

    public function __construct(
        LmsShortcutComponentRepository $lmsShortcutComponentRepository
    ) {
        $this->lmsShortcutComponentRepository = $lmsShortcutComponentRepository;
        $this->setActionRepository($lmsShortcutComponentRepository);
    }

    public function findAllComponents()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $contentSortableComponents = $this->findBy([], null, $orderBy)->toArray();

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
            Redis::del(self::REDIS_KEY_PREPAID);
            Redis::del(self::REDIS_KEY_POSTPAID);
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
        Redis::del(self::REDIS_KEY_PREPAID);
        Redis::del(self::REDIS_KEY_POSTPAID);
        return response("Successfully status changed");
    }

    public function storeComponent($data)
    {
        $msComponentCount = $this->findAll()->count();

        $data['icon'] = 'storage/' . $data['icon']->store('lms_shortcut');
        $data['component_key'] = str_replace(' ', '_', strtolower($data['title_en']));
        $data['display_order'] = $msComponentCount + 1;

        $this->save($data);
        Redis::del(self::REDIS_KEY_PREPAID);
        Redis::del(self::REDIS_KEY_POSTPAID);
        return response("Shortcut Component update successfully!");
    }

    public function updateComponent($data, $id)
    {
        if(isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('lms_shortcut');
        }

        $component = $this->findOne($id);
        $component->update($data);
        Redis::del(self::REDIS_KEY_PREPAID);
        Redis::del(self::REDIS_KEY_POSTPAID);
        return response("Shortcut Component update successfully!");
    }

    public function deleteComponent($id)
    {
        $component = $this->findOne($id);
        $component->delete();
        Redis::del(self::REDIS_KEY_PREPAID);
        Redis::del(self::REDIS_KEY_POSTPAID);
        return [
            'message' => 'Component delete successfully',
        ];
    }
}
