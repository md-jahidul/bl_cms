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

        $android_version_code = explode('-', $data['android_version_code']);
        $ios_version_code = explode('-', $data['ios_version_code']);
        
        $data['android_version_code_min'] = $android_version_code[0] ?? 0;
        $data['android_version_code_max'] = $android_version_code[1]?? 999999999;
        $data['ios_version_code_min'] = $ios_version_code[0] ?? 0;
        $data['ios_version_code_max'] = $ios_version_code[1] ?? 999999999;

        unset($data['android_version_code'], $data['ios_version_code']);

        $this->save($data);
        Redis::del(self::REDIS_KEY);
        return new Response("Navigation rail has been successfully created");
    }

    public function editNavigationMenu($id)
    {
        $navigationMenu = $this->findOne($id);
        $android_version_code = implode('-', [$navigationMenu['android_version_code_min'], $navigationMenu['android_version_code_max']]);
        $ios_version_code = implode('-', [$navigationMenu['ios_version_code_min'], $navigationMenu['ios_version_code_max']]);
        $navigationMenu->android_version_code = $android_version_code;
        $navigationMenu->ios_version_code = $ios_version_code;

        return $navigationMenu;
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

        $android_version_code = explode('-', $request['android_version_code']);
        $ios_version_code = explode('-', $request['ios_version_code']);

        $request['android_version_code_min'] = $android_version_code[0] ?? 0;
        $request['android_version_code_max'] = $android_version_code[1]?? 999999999;
        $request['ios_version_code_min'] = $ios_version_code[0] ?? 0;
        $request['ios_version_code_max'] = $ios_version_code[1] ?? 999999999;

        unset($request['android_version_code'], $request['ios_version_code']);
        
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
