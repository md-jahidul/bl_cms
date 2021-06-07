<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use App\Repositories\MyblAppMenuRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class MyblAppMenuService
{
    use CrudTrait;
    use FileTrait;

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

    public function getBreadcrumbInfo($parent_id)
    {
//        dd($parent_id);
        $temp = $this->menuRepository->findOneByProperties(['id' => $parent_id],
            ['id', 'title_en', 'parent_id']
        )->toArray();
        $this->menuItems[] = $temp;
//        dd($this->menuItems);
        return $temp['parent_id'];
    }

    /**
     * @param $parent_id
     * @return mixed
     */
    public function menuList($parent_id)
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $menu = $this->menuRepository->findAll(null, null, $orderBy);
        while ($parent_id != 0) {
            $parentMenu = $this->getBreadcrumbInfo($parent_id);
//            dd($parentMenu);
        }
        $menu_items = $parentMenu ?? [];
        return [
            'menus' => $menu,
            'menu_items' => $menu_items
        ];
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
        $this->save($data);
        return new Response('Menu added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->menuRepository->menuTableSort($data);
        return new Response('Footer menu added successfully');
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
        $menu->update($data);
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
        $menu->delete();
        return [
            'message' => 'Menu delete successfully',
        ];
    }
}
