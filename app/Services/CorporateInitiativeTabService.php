<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\CorporateInitiativeTabRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class CorporateInitiativeTabService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var CorporateInitiativeTabRepository
     */
    private $initiativeTabRepository;

    /**
     * DigitalServicesService constructor.
     * @param CorporateInitiativeTabRepository $initiativeTabRepository
     */
    public function __construct(CorporateInitiativeTabRepository $initiativeTabRepository)
    {
        $this->initiativeTabRepository = $initiativeTabRepository;
        $this->setActionRepository($initiativeTabRepository);
    }

    /**
     * Storing the alFaq resource
     * @param $data
     * @return Response
     */
    public function storeTab($data)
    {
        $sections = $this->findAll();
        $sectionCount = count($sections);
        $data['display_order'] = $sectionCount;
        $this->save($data);
        return new Response("Tab has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateTab($data, $id)
    {
        $tab = $this->findOne($id);
        $tab->update($data);
        return Response('Tab has been successfully updated');
    }

    /**
     * @param $request
     * @return string
     */
    public function tableSort($request)
    {
        $positions = $request->position;
//        dd($positions);
        foreach ($positions as $position) {
            $tab_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->findOne($tab_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteTab($id)
    {
        $tab = $this->findOne($id);
        $tab->delete();
        return Response('Tab has been successfully deleted');
    }
}
