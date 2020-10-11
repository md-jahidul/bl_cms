<?php
namespace App\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Repositories\StoreCategoryRepository;


class StoreCategoryService
{
    use CrudTrait;

    /**
     * @var StoreCategoryRepository
     */
    protected $storeCategoryRepository;

    /**
     * StoreCategoryService constructor.
     * @param StoreCategoryRepository $storeCategoryRepository
     */
    public function __construct(StoreCategoryRepository $storeCategoryRepository)
    {
        $this->storeCategoryRepository = $storeCategoryRepository;
        $this->setActionRepository($storeCategoryRepository);
    }

    /**
     * Storing the StoreCategory resource
     * @param $data
     * @return Response
     */
    public function storeStoreCategory($data)
    {
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name_en']));

        $this->save($data);
        return new Response("Store Category has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateStoreCategory($data, $id)
    {
        $storeCategory = $this->findOne($id);
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name_en']));
        $storeCategory->update($data);
        return Response('Store Category has been successfully updated');
    }


    public function deleteStoreCategory($id)
    {
        $storeCategory = $this->findOne($id);
        $storeCategory->delete();
        return Response('Store Category has been successfully deleted');
    }


    /**
     * @param $request
     * @return Response
     */
    public function tableSortable($request)
    {
        $this->storeCategoryRepository->sortMyBlCategoryList($request);
        return new Response('update successfully');
    }

}
