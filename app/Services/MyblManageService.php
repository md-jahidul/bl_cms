<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use App\Repositories\MyblAppMenuRepository;
use App\Repositories\MyblManageItemRepository;
use App\Repositories\MyblManageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class MyblManageService
{
    use CrudTrait;
    use FileTrait;

    protected const REDIS_KEY = "mybl_manage";

    /**
     * @var MyblManageRepository
     */
    private $manageRepository;
    /**
     * @var MyblManageItemRepository
     */
    private $manageItemRepository;

    /**
     * MenuService constructor.
     * @param MyblManageRepository $manageRepository
     */
    public function __construct(
        MyblManageRepository $manageRepository,
        MyblManageItemRepository $manageItemRepository
    ) {
        $this->manageRepository = $manageRepository;
        $this->manageItemRepository = $manageItemRepository;
        $this->setActionRepository($manageRepository);
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
    public function storeCategory($data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;
        $this->save($data);
        Redis::del(self::REDIS_KEY);
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
        Redis::del(self::REDIS_KEY);
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
        Redis::del(self::REDIS_KEY);
        return new Response('Item update successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->manageRepository->manageTableSort($data);
        Redis::del(self::REDIS_KEY);
        return new Response('Sorted successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function itemTableSort($data)
    {
        $this->manageItemRepository->itemTableSort($data);
        Redis::del(self::REDIS_KEY);
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
        Redis::del(self::REDIS_KEY);
        return Response('Manage category updated successfully');
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
        Redis::del(self::REDIS_KEY);
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
        Redis::del(self::REDIS_KEY);
        return [
            'message' => 'Item deleted successfully',
        ];
    }
}
