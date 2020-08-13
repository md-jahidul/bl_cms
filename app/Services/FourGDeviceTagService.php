<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\FourGDeviceTagRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class FourGDeviceTagService
{
    use CrudTrait;

    /**
     * @var FourGDeviceTagRepository
     */
    private $fourGDeviceTagRepository;

    /**
     * TagCategoryService constructor.
     * @param FourGDeviceTagRepository $fourGDeviceTagRepository
     */
    public function __construct(FourGDeviceTagRepository $fourGDeviceTagRepository)
    {
        $this->fourGDeviceTagRepository = $fourGDeviceTagRepository;
        $this->setActionRepository($fourGDeviceTagRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeTagCategory($data)
    {
        $data['alias'] = str_replace(" ", "_", strtolower($data['name_en']));
        $this->save($data);
        return new Response('Tag added successfully');
    }

    /**
     * Updating the TagCategory
     * @param $data
     * @return Response
     */
    public function updateTagCategory($data, $id)
    {
        $TagCategory = $this->findOne($id);
        $data['alias'] = str_replace(" ", "_", strtolower($data['name_en']));
        $TagCategory->update($data);
        return Response('Tag updated successfully');
    }


    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteTagCategory($id)
    {
        $TagCategory = $this->findOne($id);
        $TagCategory->delete();
        return Response('Tag deleted successfully !');
    }
}
