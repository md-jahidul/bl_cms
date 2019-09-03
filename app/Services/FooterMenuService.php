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

    public function footerMenuParent()
    {
        return $this->footerMenuRepository->parentFooter();
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeFooterMenu($data)
    {
        $name = ucwords( strtolower( $data['name'] )  );
        $search = [" ", "&"];
        $replace   = ["", "And"];
        $data['code'] = str_replace($search, $replace, $name);
        $this->save($data);
        return new Response('Footer menu added successfully');
    }

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

    public function deleteFooterMenu($id)
    {
        $footerMenu = $this->findOne($id);
        $footerMenu->delete();
        return Response('Footer delete successfully');
    }

}
