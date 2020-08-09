<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\FeedCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
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

    /**
     * Category create view page
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = $this->feedCategoryService->getAll();
        return view('admin.feed.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
