<?php


namespace App\Services;


use App\Repositories\FooterMenuRepository;
use App\Traits\CrudTrait;
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
    public function footerMenuParent($parent_id)
    {
        return $this->footerMenuRepository->parentFooter($parent_id);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeFooterMenu($data)
    {
        $footer_menu_count = count($this->footerMenuRepository->findAll());
        $name = ucwords( strtolower( $data['name'] )  );
        $search = [" ", "&"];
        $replace   = ["", "And"];
        $data['code'] = str_replace($search, $replace, $name);
        $data['display_order'] = ++$footer_menu_count;
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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateFooterMenu($data, $id)
    {
        $footerMenu = $this->findOne($id);
        $footerMenu->update($data);
        return Response('Footer menu updated successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteFooterMenu($id)
    {
        $footerMenu = $this->findOne($id);
        $footerMenu->delete();
        $response = [
            'message' => 'Footer menu delete successfully',
            'parent_id' => $footerMenu->parent_id
        ];
        return $response;
    }

}
