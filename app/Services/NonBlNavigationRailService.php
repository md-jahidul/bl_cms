<?php

namespace App\Services;

use App\Repositories\NonBlNavigationRailRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class NonBlNavigationRailService
{
    use CrudTrait;
    private $nonblNavigationRailRepository;

    protected const REDIS_KEY = "non_bl_component";

    public function __construct(NonBlNavigationRailRepository $nonblNavigationRailRepository)
    {
        $this->nonblNavigationRailRepository = $nonblNavigationRailRepository;
        $this->setActionRepository($nonblNavigationRailRepository);
    }

    public function getNavigationRail()
    {
        return $this->nonblNavigationRailRepository->getNavigationRail();
    }

    public function storeNavigationMenu($data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;
        $this->save($data);
        Redis::del(self::REDIS_KEY);
        return new Response("Navigation rail has been successfully created");
    }

    /**
     * Updating the banner
     * @param $request
     * @param $id
     * @return Response
     */
    public function updateNavigationMenu($request, $id)
    {
        $navigationMenu = $this->findOne($id);
        $navigationMenu->update($request);
        Redis::del(self::REDIS_KEY);
        return new Response("Navigation rail has been successfully updated");
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function destroyNavigationMenu($id)
    {
        $navigationRail = $this->findOne($id);
        $navigationRail->delete();
        Redis::del(self::REDIS_KEY);
        return Response('Navigation rail has been successfully deleted');
    }


    /**
     * @param $request
     * @return Response
     */
    public function tableSortable($request)
    {
        $this->nonblNavigationRailRepository->sortData($request->position);
        Redis::del(self::REDIS_KEY);
        return new Response('update successfully');
    }
}
