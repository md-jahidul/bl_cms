<?php

namespace App\Services;

use App\Http\Helpers;
use App\Repositories\AboutUsRepository;
use App\Repositories\DynamicRouteRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class DynamicRouteService
{
    use CrudTrait;

    /**
     * @var DynamicRouteRepository
     */
    private $dynamicRouteRepository;

    /**
     * DynamicRouteRepository constructor.
     * @param DynamicRouteRepository $dynamicRouteRepository
     */
    public function __construct(DynamicRouteRepository $dynamicRouteRepository)
    {
        $this->dynamicRouteRepository = $dynamicRouteRepository;
        $this->setActionRepository($dynamicRouteRepository);
    }

    /**
     * @param $request
     * @param $aboutUs
     * @return ResponseFactory|Response
     */
    public function updateRoute($request, $id)
    {
        $data = $request->all();
        $route = $this->findOne($id);
        $route->update($data);
        return Response('Updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAboutUsInfo($id)
    {
        $aboutUs = $this->findOne($id);
        $this->deleteFile($aboutUs->content_image);
        $this->deleteFile($aboutUs->banner_image);
        $aboutUs->delete();
        return Response('About Us Info deleted successfully !');
    }
}
