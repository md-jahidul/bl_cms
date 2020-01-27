<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\TagCategoryRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class TagCategoryService
{
    use CrudTrait;

    /**
     * @var $TagCategoryRepository
     */
    protected $tagCategoryRepository;

    /**
     * TagCategoryService constructor.
     * @param TagCategoryRepository $tagCategoryRepository
     */
    public function __construct(TagCategoryRepository $tagCategoryRepository)
    {
        $this->tagCategoryRepository = $tagCategoryRepository;
        $this->setActionRepository($tagCategoryRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeTagCategory($data)
    {
        $data['alias'] = str_replace(" ", "_", strtolower($data['name_en']));
        $this->save($data);
        return new Response('Tag category added successfully');
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
        return Response('Tag category updated successfully');
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
        return Response('Tag category deleted successfully !');
    }
}
