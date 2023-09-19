<?php

namespace App\Services;

use App\Helpers\Helper;
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

    protected const REDIS_GUEST_USER_KEY = "mybl_guest_user_manage";
    protected const REDIS_PREPAID_USER_KEY = "mybl_prepaid_user_manage";
    protected const REDIS_POSTPAID_USER_KEY = "mybl_postpaid_user_manage";

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

    public function prepareCategoriesType($data)
    {
        return collect($data)->map(function ($category) {
            $type = collect($category->manageItems)->map(function ($item) use ($category) {
                if ($category->type == "slider") {
                    if ($item->component_identifier == "video") {
                        $typeText = "video";
                    } else {
                        $typeText = "image";
                    }
                } else {
                    $typeText = $category->type;
                }
                return $typeText;
            });

            // Slider Type Define Image or Video or Both
            if (in_array('image', $type->toArray()) && in_array('video', $type->toArray())) {
                $category['type'] = $category->type . " (Image/Video)";
            } elseif (in_array('video', $type->toArray())) {
                $category['type'] = $category->type . " (Video)";
            } elseif (in_array('image', $type->toArray())) {
                $category['type'] = $category->type . " (Image)";
            } else {
                $category['type'] = ($category->type == "game") ? $category->type . " (Redirect URL)" : $category->type . " (CTA Action)";
            }
            return $category;
        });
    }

    public function getCategories()
    {
        $categoriesWithItems = $this->manageRepository->categories();
        return $this->prepareCategoriesType($categoriesWithItems);
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

        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('manage_image');
        }

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code); 
        unset($data['android_version_code'], $data['ios_version_code']);

        $this->save($data);
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
        
        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code); 
        unset($data['android_version_code'], $data['ios_version_code']);

        
        $this->manageItemRepository->save($data);
        Redis::del([
            self::REDIS_GUEST_USER_KEY,
            self::REDIS_PREPAID_USER_KEY,
            self::REDIS_POSTPAID_USER_KEY
        ]);
        return new Response('Category added successfully!');
    }

    public function editItem($id)
    {
        $item = $this->manageItemRepository->findOne($id);
        $android_version_code = implode('-', [$item['android_version_code_min'], $item['android_version_code_max']]);
        $ios_version_code = implode('-', [$item['ios_version_code_min'], $item['ios_version_code_max']]);
        $item->android_version_code = $android_version_code;
        $item->ios_version_code = $ios_version_code;

        return $item;
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
        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code); 
        unset($data['android_version_code'], $data['ios_version_code']);

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

    public function editCategory($id)
    {
        $category = $this->findOne($id);
        $android_version_code = implode('-', [$category['android_version_code_min'], $category['android_version_code_max']]);
        $ios_version_code = implode('-', [$category['ios_version_code_min'], $category['ios_version_code_max']]);
        $category->android_version_code = $android_version_code;
        $category->ios_version_code = $ios_version_code;

        return $category;
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateCategory($data, $id)
    {
        $category = $this->findOne($id);
        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('manage_image');
            if (!empty($menu->icon)) {
                unlink($menu->icon);
            }
        }

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code); 
        unset($data['android_version_code'], $data['ios_version_code']);

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
