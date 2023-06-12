<?php

namespace App\Services;

use App\Repositories\CommerceNavigationRailRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class CommerceNavigationRailService
{
    use CrudTrait;
    private $commerceNavigationRailRepository;

    protected const REDIS_KEY = "mybl_commerce_navigation_rail";

    public function __construct(CommerceNavigationRailRepository $commerceNavigationRailRepository)
    {
        $this->commerceNavigationRailRepository = $commerceNavigationRailRepository;
        $this->setActionRepository($commerceNavigationRailRepository);
    }

    public function getNavigationRail()
    {
        return $this->commerceNavigationRailRepository->getNavigationRail();
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
        $this->commerceNavigationRailRepository->sortData($request->position);
        Redis::del(self::REDIS_KEY);
        return new Response('update successfully');
    }
}
