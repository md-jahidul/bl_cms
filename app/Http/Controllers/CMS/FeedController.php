<?php

namespace App\Http\Controllers\CMS;

use App\Enums\FeedAvailability;
use App\Http\Controllers\Controller;
use App\Services\FeedCategoryService;
use App\Services\FeedService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedController extends Controller
{
    /**
     * @var FeedService
     */
    protected $feedService;
    /**
     * @var FeedCategoryService
     */
    protected $feedCategoryService;

    /**
     * FeedController constructor.
     * @param FeedService $feedService
     * @param FeedCategoryService $feedCategoryService
     */
    public function __construct(FeedService $feedService, FeedCategoryService $feedCategoryService)
    {
        $this->feedService = $feedService;
        $this->feedCategoryService = $feedCategoryService;
    }

    /**
     * List of feeds
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $feeds = $this->feedService->getAll();
        return view('admin.feed.index', compact('feeds'));
    }

    /**
     * Feed create page view
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = $this->feedCategoryService->getAll();
        return view('admin.feed.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->feedService->store($request->all());
        return redirect(route('feeds.index'));
    }
}
