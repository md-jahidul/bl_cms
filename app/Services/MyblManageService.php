<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use App\Repositories\MyblAppMenuRepository;
use App\Repositories\MyblManageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class MyblManageService
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
     * @param MyblManageRepository $menuRepository
     */
    public function __construct(MyblManageRepository $menuRepository)
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
    public function storeCategory($data)
    {
        $this->save($data);
        return new Response('Category added successfully!');
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
        $subMenus = $this->menuRepository->allMenus($menu->id);
        if (!$subMenus->isEmpty()) {
            foreach ($subMenus as $subMenu) {
                $subMenu->delete();
            }
        }
        $menu->delete();
        return [
            'message' => 'Menu delete successfully',
        ];
    }
}
