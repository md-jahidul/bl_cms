<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\MenuRepository;
use App\Repositories\MyblAppMenuRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class MyblAppMenuService
{
    use CrudTrait;
    use FileTrait;

    protected const REDIS_AUTH_USER_KEY = "mybl_auth_user_menus";
    protected const REDIS_GUEST_USER_KEY = "mybl_guest_user_menus";

    /**
     * @var $menuRepository
     */
    protected $menuRepository;
    /**
     * @var array
     */
    private $menuItems;
    /**
     * MenuService constructor.
     * @param MyblAppMenuRepository $menuRepository
     */
    public function __construct(MyblAppMenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->setActionRepository($menuRepository);
    }

    /**
     * @param $parent_id
     * @return mixed
     */
    public function menuList($parent_id)
    {
        return $this->menuRepository->allMenus($parent_id);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeMenu($data)
    {
        $menu_count = count($this->menuRepository->findByProperties(['parent_id' => $data['parent_id']]));
        $data['display_order'] = ++$menu_count;
        $data['key'] = str_replace(' ', '_', strtolower($data['title_en']));
        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('menu_icon');
        }
        if (request()->hasFile('parent_icon')) {
            $data['parent_icon'] = 'storage/' . $data['parent_icon']->store('menu_icon');
        }

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);


        $this->save($data);
        Helper::removeVersionControlRedisKey('navdrawer');

        return new Response('Menu added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->menuRepository->menuTableSort($data);
        Helper::removeVersionControlRedisKey('navdrawer');

        return new Response('Footer menu added successfully');
    }

    public function editMenu($id)
    {
        $menu = $this->findOne($id);
        $android_version_code = implode('-', [$menu['android_version_code_min'], $menu['android_version_code_max']]);
        $ios_version_code = implode('-', [$menu['ios_version_code_min'], $menu['ios_version_code_max']]);
        $menu->android_version_code = $android_version_code;
        $menu->ios_version_code = $ios_version_code;

        return $menu;
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateMenu($data, $id)
    {
        $menu = $this->findOne($id);
        if (request()->hasFile('icon')) {
            $data['icon'] = 'storage/' . $data['icon']->store('menu_icon');
            if (!empty($menu->icon)) {
                unlink($menu->icon);
            }
        }
        if (request()->hasFile('parent_icon')) {
            $data['parent_icon'] = 'storage/' . $data['parent_icon']->store('menu_icon');
            if (!empty($menu->parent_icon)) {
                unlink($menu->parent_icon);
            }
        }

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);


        $menu->update($data);
        Helper::removeVersionControlRedisKey('navdrawer');

        return Response('Menu updated successfully');
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteMenu($id)
    {
        $menu = $this->findOne($id);
        if (!empty($menu->icon)) {
            unlink($menu->icon);
        }
        $subMenus = $this->menuRepository->allMenus($menu->id);
        if (!$subMenus->isEmpty()) {
            foreach ($subMenus as $subMenu) {
                $subMenu->delete();
            }
        }
        $menu->delete();
        Helper::removeVersionControlRedisKey('navdrawer');

        return [
            'message' => 'Menu delete successfully',
        ];
    }
}
