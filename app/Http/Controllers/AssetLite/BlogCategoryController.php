<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\BlogPostCategoryRequest;
use App\Services\MediaNewsCategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    /**
     * @var MediaNewsCategoryService
     */
    protected $mediaNewsCategoryService;

    /**
     * RolesController constructor.
     * @param MediaNewsCategoryService $mediaNewsCategoryService
     */
    public function __construct(
        MediaNewsCategoryService $mediaNewsCategoryService
    ) {
        $this->mediaNewsCategoryService = $mediaNewsCategoryService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $blogCategories = $this->mediaNewsCategoryService->findAll();
        return view('admin.blog.category.index', compact('blogCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogPostCategoryRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(BlogPostCategoryRequest $request)
    {
        $response = $this->mediaNewsCategoryService->storeCategory($request->all());
        Session::flash('success', $response->getContent());
        return redirect('blog-categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = $this->mediaNewsCategoryService->findOne($id);
        return view('admin.blog.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(BlogPostCategoryRequest $request, $id)
    {
        $response = $this->mediaNewsCategoryService->updateCategory($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('blog-categories');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->mediaNewsCategoryService->deleteCategory($id);
        return url('blog-categories');
    }
}
