<?php

namespace App\Services;

use App\Repositories\FooterMenuRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class FooterMenuService
{
    use CrudTrait;

    /**
     * @var FooterMenuRepository
     */
    protected $footerMenuRepository;

    /**
     * FooterMenuService constructor.
     * @param FooterMenuRepository $footerMenuRepository
     */
    public function __construct(FooterMenuRepository $footerMenuRepository)
    {
        $this->footerMenuRepository = $footerMenuRepository;
        $this->setActionRepository($footerMenuRepository);
    }

    /**
     * @param $parent_id
     * @return mixed
     */
    public function footerMenuList($parent_id)
    {
        return $this->footerMenuRepository->getChildMenus($parent_id);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeFooterMenu($data)
    {
        $menu_count = count($this->footerMenuRepository->getChildMenus($data['parent_id']));
        $data['display_order'] = ++$menu_count;
        $data['external_site'] = strpos($data['url'], 'http') !== false ? 1 : 0;
        $this->save($data);
        return new Response('Footer menu added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->footerMenuRepository->footerTableSort($data);
        return new Response('Footer menu added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateFooterMenu($data, $id)
    {
        $footerMenu = $this->findOne($id);
        $data['external_site'] = strpos($data['url'], 'http') !== false ? 1 : 0;
        $data['is_dynamic_page'] = isset($data['is_dynamic_page']) ? 1 : 0;
        $footerMenu->update($data);
        return Response('Footer menu updated successfully');
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function deleteFooterMenu($id)
    {
        $footerMenu = $this->findOne($id);
        $footerMenu->delete();
        return [
            'message' => 'Footer menu delete successfully',
            'parent_id' => $footerMenu->parent_id
        ];
    }
}
