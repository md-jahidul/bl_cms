<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Repositories\CorporateCrStrategySectionRepository;
use App\Repositories\MediaPressNewsEventRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CorporateCrStrategySectionService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var CorporateCrStrategySectionRepository
     */
    private $corpCrStrategy;

    /**
     * DigitalServicesService constructor.
     * @param CorporateCrStrategySectionRepository $corporateCrStrategySectionRepository
     */
    public function __construct(CorporateCrStrategySectionRepository $corporateCrStrategySectionRepository)
    {
        $this->corpCrStrategy = $corporateCrStrategySectionRepository;
        $this->setActionRepository($corporateCrStrategySectionRepository);
    }

    /**
     * Storing the alFaq resource
     * @param $data
     * @return Response
     */
    public function storeSection($data)
    {
        $sections = $this->findAll();
        $sectionCount = count($sections);
        $data['display_order'] = $sectionCount;
        $this->save($data);
        return new Response("Section has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSection($data, $id)
    {
        $section = $this->findOne($id);
        $section->update($data);
        return Response('Section has been successfully updated');
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
            $section_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->findOne($section_id);
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
    public function deleteSection($id)
    {
        $section = $this->findOne($id);
        $section->delete();
        return Response('Section has been successfully deleted');
    }
}
