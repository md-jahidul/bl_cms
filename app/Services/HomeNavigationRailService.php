<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\HomeNavigationRailRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class HomeNavigationRailService
{
    use CrudTrait;

    /**
     * @var HomeNavigationRailRepository
     */
    private $homeNavigationRailRepository;
    private $myblHomeComponentService;
    /**
     * HomeNavigationRailService constructor.
     * @param HomeNavigationRailRepository $homeNavigationRailRepository
     */
    public function __construct(HomeNavigationRailRepository $homeNavigationRailRepository, MyblHomeComponentService $myblHomeComponentService)
    {
        $this->homeNavigationRailRepository = $homeNavigationRailRepository;
        $this->myblHomeComponentService = $myblHomeComponentService;
        $this->setActionRepository($homeNavigationRailRepository);
    }

    public function getNavigationRail()
    {
        return $this->homeNavigationRailRepository->getNavigationRail();
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeNavigationMenu($data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
        $data = array_merge($data, $version_code);
        unset($data['android_version_code'], $data['ios_version_code']);

        $this->save($data);
        $this->myblHomeComponentService->removeVersionControlRedisKey('homenav');
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

        /**
         * Version Control
         */
        $version_code = Helper::versionCode($request['android_version_code'], $request['ios_version_code']);
        $request = array_merge($request, $version_code);
        unset($request['android_version_code'], $request['ios_version_code']);

        $navigationMenu->update($request);
        $this->myblHomeComponentService->removeVersionControlRedisKey('homenav');
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
        $this->myblHomeComponentService->removeVersionControlRedisKey('homenav');
        return Response('Navigation rail has been successfully deleted');
    }


    /**
     * @param $request
     * @return Response
     */
    public function tableSortable($request)
    {
        $this->homeNavigationRailRepository->sortData($request->position);
        $this->myblHomeComponentService->removeVersionControlRedisKey('homenav');
        return new Response('update successfully');
    }
}
