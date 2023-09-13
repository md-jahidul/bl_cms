<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\MetaTagService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class MetaTagController extends Controller
{

    /**
     * @var MetaTagService
     */
    private $metaTagService;


    public function __construct(MetaTagService $metaTagService)
    {
        $this->metaTagService = $metaTagService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metaTags = $this->metaTagService->findAll('', 'page:id,title');
        return view('admin.meta-tag.index', compact('metaTags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.meta-tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'dynamic_route_key' => 'required|regex:/^\S*$/u|unique:meta_tags,dynamic_route_key',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        session()->flash('message', $this->metaTagService->storeFixedPageTag($request->all())->getContent());
        return $request->redirect_to ? redirect($request->redirect_to) : redirect(route('meta-tag.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $metaTag = $this->metaTagService->findOne($id);
        return view('admin.meta-tag.create', compact('metaTag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $metaTag = $this->metaTagService->findOne($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'dynamic_route_key' => 'required|regex:/^\S*$/u|unique:meta_tags,dynamic_route_key,' . $metaTag->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        session()->flash('message', $this->metaTagService->updateMetaTag($request->all(), $id)->getContent());
        return $request->redirect_to ? redirect($request->redirect_to) : redirect(route('meta-tag.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Http\Response|string
     */
    public function destroy($id)
    {
        session()->flash('message', $this->metaTagService->deleteFixedPage($id)->getContent());
        return url(route('meta-tag.index'));
    }
}
