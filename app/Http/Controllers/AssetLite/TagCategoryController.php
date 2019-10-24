<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\TagCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class TagCategoryController extends Controller
{
    /**
     * @var $tagCategoryService
     */
    private $tagCategoryService;

    /**
     * TagController constructor.
     * @param TagCategoryService $tagCategoryService
     */
    public function __construct(TagCategoryService $tagCategoryService)
    {
        $this->tagCategoryService = $tagCategoryService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = $this->tagCategoryService->findAll();
        return view('admin.category.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.category.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $response = $this->tagCategoryService->storeTagCategory($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/tag-category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->tagCategoryService->findOne($id);
        return view('admin.category.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->tagCategoryService->updateTagCategory($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/tag-category');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->tagCategoryService->deleteTagCategory($id);
        Session::flash('message', $response->getContent());
        return url('/tag-category');
    }
}
