<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use App\Repositories\MyblAppMenuRepository;
use App\Repositories\MyblManageItemRepository;
use App\Repositories\MyblManageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblManageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var MyblManageRepository
     */
    private $manageRepository;
    /**
     * @var MyblManageItemRepository
     */
    private $manageItemRepository;

    /**
     * MenuService constructor.
     * @param MyblManageRepository $manageRepository
     */
    public function __construct(
        MyblManageRepository $manageRepository,
        MyblManageItemRepository $manageItemRepository
    ) {
        $this->manageRepository = $manageRepository;
        $this->manageItemRepository = $manageItemRepository;
        $this->setActionRepository($manageRepository);
    }

    /**
     * @param $parent_id
     * @return mixed
     */
    public function itemList($parent_id)
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        return $this->manageItemRepository->findBy(['manage_categories_id' => $parent_id], null, $orderBy);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeCategory($data)
    {
        $data['display_order'] = $this->findAll()->count() + 1;
        $this->save($data);
        return new Response('Category added successfully!');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->manageRepository->manageTableSort($data);
        return new Response('Sorted successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateCategory($data, $id)
    {
        $category = $this->findOne($id);
        $category->update($data);
        return Response('Manage category updated successfully');
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteCategory($id)
    {
        $category = $this->findOne($id);
        $category->delete();
        return [
            'message' => 'Category deleted successfully',
        ];
    }
}
