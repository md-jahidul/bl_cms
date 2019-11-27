<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\DurationCategoryRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class DurationCategoryService
{
    use CrudTrait;

    /**
     * @var $DurationCategoryRepository
     */
    protected $durationCategoryRepository;

    /**
     * DurationCategoryService constructor.
     * @param DurationCategoryRepository $durationCategoryRepository
     */
    public function __construct(DurationCategoryRepository $durationCategoryRepository)
    {
        $this->durationCategoryRepository = $durationCategoryRepository;
        $this->setActionRepository($durationCategoryRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeDurationCategory($data)
    {
        $data['alias'] = str_replace(" ", "_", strtolower($data['name_en']));
        $this->save($data);
        return new Response('Duration category added successfully');
    }

    /**
     * Updating the DurationCategory
     * @param $data
     * @return Response
     */
    public function updateDurationCategory($data, $id)
    {
        $durationCategory = $this->findOne($id);
        $data['alias'] = str_replace(" ", "_", strtolower($data['name_en']));
        $durationCategory->update($data);
        return Response('Duration category updated successfully');
    }


    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteDurationCategory($id)
    {
        $durationCategory = $this->findOne($id);
        $durationCategory->delete();
        return Response('Duration category deleted successfully !');
    }
}
