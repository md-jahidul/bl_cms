<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedCategoryRequest;
use App\Services\FeedCategoryService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
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

    /**
     * Store feed category
     *
     * @param FeedCategoryRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(FeedCategoryRequest $request)
    {
        session()->flash('message', $this->feedCategoryService->store($request->all())->getContent());
        return redirect(route('feeds.categories.index'));
    }

    /**
     * Category edit view page
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $categories = $this->feedCategoryService->getAll();
        $category = $this->feedCategoryService->findOne($id, 'parent');
        return view('admin.feed.category.edit', compact('categories', 'category'));
    }

    /**
     * Update feed category
     *
     * @param FeedCategoryRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(FeedCategoryRequest $request, $id)
    {
        session()->flash('message', $this->feedCategoryService->categoryUpdate($request->all(), $id)->getContent());
        return redirect(route('feeds.categories.index'));
    }

    /**
     * Delete feed category
     *
     * @param $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id)
    {
        session()->flash('error', $this->feedCategoryService->destroy($id)->getContent());
        return redirect(route('feeds.categories.index'));
    }


    public function updatePosition(Request $request)
    {
        dd($request->all());
    }
}
