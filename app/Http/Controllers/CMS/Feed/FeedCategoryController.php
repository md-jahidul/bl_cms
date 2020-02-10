<?php

namespace App\Http\Controllers\CMS\Feed;

use App\Services\Feed\FeedCategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class FeedCategoryController
 * @package App\Http\Controllers\CMS\Feed
 */
class FeedCategoryController extends Controller
{

    /**
     * FeedCategoryController constructor.
     * @param FeedCategoryService $feedCategoryService
     */
    public function __construct(FeedCategoryService $feedCategoryService)
    {
        $this->feedCategoryService = $feedCategoryService;
        $this->middleware('auth');
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $categories = $this->feedCategoryService->getAll();

        return view('admin.feed.category.index', compact('categories'));
    }
}
