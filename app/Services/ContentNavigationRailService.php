<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\ContentNavigationRailRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class ContentNavigationRailService
{
    use CrudTrait;
    private $contentNavigationRailRepository;

    protected const REDIS_KEY = "mybl_content_navigation_rail";

    public function __construct(ContentNavigationRailRepository $contentNavigationRailRepository)
    {
        $this->contentNavigationRailRepository = $contentNavigationRailRepository;
        $this->setActionRepository($contentNavigationRailRepository);
    }

    public function getNavigationRail()
    {
        return $this->contentNavigationRailRepository->getNavigationRail();
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
        $this->contentNavigationRailRepository->sortData($request->position);
        Redis::del(self::REDIS_KEY);
        return new Response('update successfully');
    }
}
