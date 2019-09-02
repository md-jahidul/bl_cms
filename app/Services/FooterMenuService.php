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
     * @param $data
     * @return Response
     */
    public function storeFooterMenu($data)
    {
        $code = ucwords($data['name']);
        $code = str_replace(' ','', $code);
        $code = str_replace('&','And', $code);
        $data['code'] = $code."Page";
        $this->save($data);
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
