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

    public function findLangWiseRoute()
    {
        return $this->dynamicRouteRepository->findByProperties(['lang_type' => 'en'], ['key', 'url']);
    }

    /**
     * @param $data
     * @return ResponseFactory|Response
     */
    public function saveRoute($data)
    {
        $data['key'] = isset($data['is_dynamic_page']) ? $data['dynamic_page_key'] : $data['key'];
        $data['is_dynamic_page'] = isset($data['is_dynamic_page']) ? 1 : 0;
        unset($data['dynamic_page_key']);
        foreach ($data['url'] as $index => $item) {
            $data['code'] = str_replace(' ', '', $data['code']);
            $data['url'] = $item;
            $data['lang_type'] = ($index == 0) ? 'en' : 'bn';
            $this->save($data);
        }
        return Response('Route add successfully');
    }

    /**
     * @param $request
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateRoute($request, $id)
    {
        request()->validate([
            'url' => 'required|unique:front_end_dynamic_routes,url,' . $id,
        ]);

        $data = $request->all();
        $route = $this->findOne($id);
        $data['code'] = str_replace(' ', '', $data['code']);
        $data['key'] = isset($data['is_dynamic_page']) ? $data['dynamic_page_key'] : $data['key'];
        $data['is_dynamic_page'] = isset($data['is_dynamic_page']) ? 1 : 0;
        unset($data['dynamic_page_key']);
        $route->update($data);
        return Response('Updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteDynamicRoute($id)
    {
        $route = $this->findOne($id);
        $route->delete();
        return Response('Route move to trashed successfully !');
    }
}
