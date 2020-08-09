<?php

namespace App\Http\Controllers\CMS;

use App\Services\FeedCategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class FeedCategoryController extends Controller
{
    /**
     * @var FeedCategoryService
     */
    protected $feedCategoryService;

    /**
     * FeedCategoryController constructor.
     * @param FeedCategoryService $feedCategoryService
     */
    public function __construct(FeedCategoryService $feedCategoryService)
    {
        $this->feedCategoryService = $feedCategoryService;
    }

    /**
     * List view of category
     *
     * @return Factory|View
     */
    public function index()
    {
        $categories = $this->feedCategoryService->getAll();
        return view('admin.feed.category.index', compact('categories'));
    }
}
