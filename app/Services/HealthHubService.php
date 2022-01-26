<?php

namespace App\Services;

use App\Repositories\HealthHubRepository;
use App\Repositories\MenuRepository;
use App\Repositories\MyblAppMenuRepository;
use App\Repositories\MyblManageItemRepository;
use App\Repositories\MyblManageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class HealthHubService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var HealthHubRepository
     */
    private $healthHubRepository;

    /**
     * HealthHubService constructor.
     * @param HealthHubRepository $healthHubRepository
     */
    public function __construct(
        HealthHubRepository $healthHubRepository
    ) {
        $this->healthHubRepository = $healthHubRepository;
        $this->setActionRepository($healthHubRepository);
    }


    /**
     * @param $parent_id
     * @return mixed
     */
    public function itemList($parent_id)
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        return $this->manageItemRepository->findBy(['manage_categories_id' => $parent_id], null, $orderBy);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeHealthHub($data)
    {
        $itemCount = $this->findAll()->count();
        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('health-hub');
        }
        $data['display_order'] = $itemCount + 1;
        $this->save($data);
        return new Response('Category added successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeItem($data)
    {
        if ($data['category_type'] == "slider" && $data['slider_type'] == 'video') {
            $data['component_identifier'] = $data['slider_type'];
            $data['other_info']['slider_type'] = $data['slider_type'];
        } elseif ($data['category_type'] == "slider" && $data['slider_type'] == 'image') {
            $data['other_info']['slider_type'] = $data['slider_type'];
        }

        if (request()->hasFile('image_url')) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('manage_image');
        }

        if (isset($data['other_info']['content'])) {
            $data['other_info']['type'] = $data['component_identifier'];
            $data['other_info']['navigation_title'] = str_replace(' ', '_', strtolower($data['title_en']));
            $data['other_info']['url_navigation_type'] = 'inapp';
        }

        $data['display_order'] = $this->manageItemRepository
                ->findByProperties(['manage_categories_id' => $data['manage_categories_id']], ['id'])->count() + 1;
        $this->manageItemRepository->save($data);
        Redis::del([
            self::REDIS_GUEST_USER_KEY,
            self::REDIS_PREPAID_USER_KEY,
            self::REDIS_POSTPAID_USER_KEY
        ]);
        return new Response('Category added successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function updateItem($data, $id)
    {
        $item = $this->manageItemRepository->findOne($id);

        if ($data['category_type'] == "slider" && $data['slider_type'] == 'video') {
            $data['component_identifier'] = $data['slider_type'];
            $data['other_info']['slider_type'] = $data['slider_type'];
        } elseif ($data['category_type'] == "slider" && $data['slider_type'] == 'image') {
            $data['other_info']['slider_type'] = $data['slider_type'];
        }

        if (request()->hasFile('image_url')) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('manage_image');
            if (!empty($item->image_url)) {
                unlink($item->image_url);
            }
        }

        if (isset($data['other_info']['content'])) {
            $data['other_info']['type'] = $data['component_identifier'];
            $data['other_info']['navigation_title'] = str_replace(' ', '_', strtolower($data['title_en']));
            $data['other_info']['url_navigation_type'] = 'inapp';
        }

        if ($data['category_type'] == "service") {
            if (!isset($data['other_info'])) {
                $data['other_info'] = null;
            }
            $data['show_for_guest'] = isset($data['show_for_guest']) ? 1 : 0;
        }
        $item->update($data);
        Redis::del([
            self::REDIS_GUEST_USER_KEY,
            self::REDIS_PREPAID_USER_KEY,
            self::REDIS_POSTPAID_USER_KEY
        ]);
        return new Response('Item update successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->manageRepository->manageTableSort($data);
        Redis::del([
            self::REDIS_GUEST_USER_KEY,
            self::REDIS_PREPAID_USER_KEY,
            self::REDIS_POSTPAID_USER_KEY
        ]);
        return new Response('Sorted successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function itemTableSort($data)
    {
        $this->manageItemRepository->itemTableSort($data);
        Redis::del([
            self::REDIS_GUEST_USER_KEY,
            self::REDIS_PREPAID_USER_KEY,
            self::REDIS_POSTPAID_USER_KEY
        ]);
        return new Response('Sorted successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateCategory($data, $id)
    {
        $category = $this->findOne($id);
        $category->update($data);
        Redis::del([
            self::REDIS_GUEST_USER_KEY,
            self::REDIS_PREPAID_USER_KEY,
            self::REDIS_POSTPAID_USER_KEY
        ]);
        return Response('Explore category updated successfully');
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteCategory($id)
    {
        $category = $this->findOne($id);
        $category->delete();
        Redis::del([
            self::REDIS_GUEST_USER_KEY,
            self::REDIS_PREPAID_USER_KEY,
            self::REDIS_POSTPAID_USER_KEY
        ]);
        return [
            'message' => 'Category deleted successfully',
        ];
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteItem($id)
    {
        $item = $this->manageItemRepository->findOne($id);
        if (!empty($item->image_url)) {
            unlink($item->image_url);
        }
        $item->delete();
        Redis::del([
            self::REDIS_GUEST_USER_KEY,
            self::REDIS_PREPAID_USER_KEY,
            self::REDIS_POSTPAID_USER_KEY
        ]);
        return [
            'message' => 'Item deleted successfully',
        ];
    }
}
