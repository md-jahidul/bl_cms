<?php

namespace App\Services;

use App\Repositories\FeedCategoryRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class FeedCategoryService
{
    use CrudTrait;

    /**
     * @var FeedCategoryRepository
     */
    protected $feedCategoryRepository;

    /**
     * FeedCategoryService constructor.
     * @param FeedCategoryRepository $feedCategoryRepository
     */
    public function __construct(FeedCategoryRepository $feedCategoryRepository)
    {
        $this->feedCategoryRepository = $feedCategoryRepository;
        $this->setActionRepository($feedCategoryRepository);
    }

    /**
     * Get all categories
     * @return FeedCategoryRepository|Collection|null
     */
    public function getAll()
    {
        return $this->feedCategoryRepository->getAllCategory();
    }

    /**
     * Get all active category
     * @return FeedCategoryRepository|Collection|null
     */
    public function getActiveAll()
    {
        return $this->feedCategoryRepository->getAllActiveCategory();
    }

    /**
     * Store feed category in db
     *
     * @param array $data
     * @return Response
     */
    public function store(array $data)
    {
        $this->feedCategoryRepository->save($data);
        return new Response("Feed category has been successfully created");
    }

    /**
     * Update feed category in db
     *
     * @param array $data
     * @return Response
     */
    public function categoryUpdate(array $data, $id)
    {
        $category = $this->feedCategoryRepository->findOne($id);
        $this->feedCategoryRepository->update($category, $data);
        return new Response("Feed category has been successfully updated");
    }

    /**
     * Delete feed category from db
     *
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->delete($id);
        return new Response("Feed category has been successfully deleted");
    }

    /**
     * Update ordering position
     *
     * @param $request
     * @return Response
     */
    public function updateOrdering($request)
    {
        $this->feedCategoryRepository->updateOrderingPosition($request);
        return new Response('Ordering has been successfully update');
    }
}
