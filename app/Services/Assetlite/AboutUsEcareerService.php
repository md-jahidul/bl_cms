<?php

namespace App\Services\Assetlite;

use App\Http\Helpers;
use App\Repositories\AboutUsEcareerRepository;
use App\Repositories\AboutUsRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class AboutUsEcareerService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var AboutUsEcareerRepository
     */
    private $aboutUsEcareerRepository;

    /**
     * AboutUsService constructor.
     * @param AboutUsEcareerRepository $aboutUsEcareerRepository
     */
    public function __construct(AboutUsEcareerRepository $aboutUsEcareerRepository)
    {
        $this->aboutUsEcareerRepository = $aboutUsEcareerRepository;
        $this->setActionRepository($aboutUsEcareerRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function aboutCareerStore($data)
    {
        $this->save($data);
        return new Response('About career added successfully');
    }


    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function aboutUsEcareerupdate($data, $id)
    {
        $aboutCareer = $this->findOne($id);
        $aboutCareer->update($data);
        return Response('About career updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAboutUsInfo($id)
    {
        $aboutUs = $this->findOne($id);
        $aboutUs->delete();
        return Response('About career deleted successfully !');
    }
}
