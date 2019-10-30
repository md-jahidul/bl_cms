<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\SimCategoryRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class SimCategoryService
{
    use CrudTrait;

    /**
     * @var $SimCategoryRepository
     */
    protected $simCategoryRepository;

    /**
     * SimCategoryService constructor.
     * @param SimCategoryRepository $simCategoryRepository
     */
    public function __construct(SimCategoryRepository $simCategoryRepository)
    {
        $this->simCategoryRepository = $simCategoryRepository;
        $this->setActionRepository($simCategoryRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeSimCategory($data)
    {
        $data['alias'] = str_replace(" ", "_", strtolower($data['name']));
        $this->save($data);
        return new Response('Sim category added successfully');
    }

    /**
     * Updating the SimCategory
     * @param $data
     * @return Response
     */
    public function updateSimCategory($data, $id)
    {
        $simCategory = $this->findOne($id);
        $data['alias'] = str_replace(" ", "_", strtolower($data['name']));
        $simCategory->update($data);
        return Response('Sim category updated successfully');
    }


    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteSimCategory($id)
    {
        $simCategory = $this->findOne($id);
        $simCategory->delete();
        return Response('Sim category deleted successfully !');
    }
}
