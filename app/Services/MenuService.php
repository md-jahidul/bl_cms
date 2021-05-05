<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class MenuService
{
    use CrudTrait;

    /**
     * @var $menuRepository
     */
    protected $menuRepository;

    /**
     * MenuService constructor.
     * @param MenuRepository $menuRepository
     */
    public function __construct(MenuRepository $menuRepository)
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
        return $this->menuRepository->getChildMenus($parent_id);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeMenu($data)
    {
//        request()->validate([
//            'url' => 'required|regex:/^\S*$/u|unique:menus',
//            'url_bn' => 'required|regex:/^\S*$/u|unique:menus',
//        ]);

        $menu_count = count($this->menuRepository->getChildMenus($data['parent_id']));
        $data['display_order'] = ++$menu_count;
        $data['external_site'] = isset($data['external_site']) ? 1 : 0;
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
        request()->validate([
//            'url' => 'unique:menus,url,' . $id,
//            'url_bn' => 'required|regex:/^\S*$/u|unique:menus,url_bn,' . $id,
        ]);

        $menu = $this->findOne($id);
        $data['external_site'] = isset($data['external_site']) ? 1 : 0;
        $menu->update($data);
        return Response('Menu updated successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteMenu($id)
    {
        $menu = $this->findOne($id);
        $menu->delete();

        return [
            'message' => 'Menu delete successfully',
            'parent_id' => $menu->parent_id
        ];
    }
}
