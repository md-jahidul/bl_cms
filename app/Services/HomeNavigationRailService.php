<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\HomeNavigationRailRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class HomeNavigationRailService
{
    use CrudTrait;

    /**
     * @var HomeNavigationRailRepository
     */
    private $homeNavigationRailRepository;


    /**
     * HomeNavigationRailService constructor.
     * @param HomeNavigationRailRepository $homeNavigationRailRepository
     */
    public function __construct(HomeNavigationRailRepository $homeNavigationRailRepository)
    {
        $this->homeNavigationRailRepository = $homeNavigationRailRepository;
        $this->setActionRepository($homeNavigationRailRepository);
    }

    public function getNavigationRail()
    {
        return $this->homeNavigationRailRepository->getNavigationRail();
    }

    public function allDefaultNone()
    {
        foreach ($this->findAll() as $data) {
            $data['is_default'] = false;
            $data->update($data->toArray());
        }
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeNavigationMenu($data)
    {
        if ($data['is_default']) {
            $this->allDefaultNone();
        }
        $data['display_order'] = $this->findAll()->count() + 1;
        $this->save($data);
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
        if ($request['is_default']) {
            $this->allDefaultNone();
        }
        $navigationMenu->update($request);

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
        return Response('Navigation rail has been successfully deleted');
    }


    /**
     * @param $request
     * @return Response
     */
    public function tableSortable($request)
    {
        $this->homeNavigationRailRepository->sortData($request->position);
        return new Response('update successfully');
    }
}
