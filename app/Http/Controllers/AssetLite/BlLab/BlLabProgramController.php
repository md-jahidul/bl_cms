<?php

namespace App\Http\Controllers\AssetLite\BlLab;

use App\Http\Controllers\Controller;
use App\Models\BlLab\BlLabApplyingFor;
use App\Services\BlLab\BlLabApplyingForService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlLabEventListController extends Controller
{
    /**
     * @var BlLabApplyingForService
     */
    private $applyingForService;

    /**
     * BlLabEventListController constructor.
     * @param BlLabApplyingForService $applyingForService
     */
    public function __construct(
        BlLabApplyingForService $applyingForService
    ) {
        $this->applyingForService = $applyingForService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $tags = $this->tagCategoryService->findAll();
        return view('admin.category.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.category.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->tagCategoryService->storeTagCategory($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/tag-category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $tag = $this->tagCategoryService->findOne($id);
        return view('admin.category.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->tagCategoryService->updateTagCategory($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/tag-category');
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->tagCategoryService->deleteTagCategory($id);
        Session::flash('message', $response->getContent());
        return url('/tag-category');
    }
}
