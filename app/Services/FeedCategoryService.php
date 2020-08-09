<?php

namespace App\Services;

use App\Repositories\FeedCategoryRepository;
use Illuminate\Support\Collection;

class FeedCategoryService
{
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
    }

    /**
     * Get all categories
     * @return FeedCategoryRepository|Collection|null
     */
    public function getAll()
    {
        return $this->feedCategoryRepository->getAll();
    }
}
