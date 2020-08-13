<?php

namespace App\Http\Controllers\CMS;

use App\Enums\FeedAvailability;
use App\Http\Controllers\Controller;
use App\Services\FeedCategoryService;
use App\Services\FeedService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
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

    /**
     * Store feed
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        session()->flash('message', $this->feedService->store($request->all())->getContent());
        return redirect(route('feeds.index'));
    }

    /**
     * Edit view page
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $categories = $this->feedCategoryService->getAll();
        $feed = $this->feedService->findOne($id);
        return view('admin.feed.edit', compact('categories', 'feed'));
    }

    /**
     * Update feed
     *
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        session()->flash('message', $this->feedService->feedUpdate($request->all(), $id)->getContent());
        return redirect(route('feeds.index'));
    }

    /**
     * Delete feed
     *
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        session()->flash('error', $this->feedService->destroy($id)->getContent());
        return redirect(route('feeds.index'));
    }
}
