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
        return $this->menuRepository->parentMenu($parent_id);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeMenu($data)
    {
        $menu_count = count($this->menuRepository->findAll());
        $name = ucwords( strtolower( $data['name'] )  );
        $search = [" ", "&"];
        $replace   = ["", "And"];
        $data['code'] = str_replace($search, $replace, $name);
        $data['display_order'] = ++$menu_count;
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
        return Response('Menu delete successfully');
    }

}
