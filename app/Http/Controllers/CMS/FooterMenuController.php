<?php

namespace App\Http\Controllers\CMS;

use App\Models\FooterMenu;
use App\Models\Menu;
use App\Services\FooterMenuService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FooterMenuController extends Controller
{
    private $footerMenuService;

    /**
     * FooterMenuController constructor.
     * @param FooterMenuService $footerMenuService
     */
    public function __construct(FooterMenuService $footerMenuService)
    {
        $this->footerMenuService = $footerMenuService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id = 0)
    {
        $footerMenus = $this->footerMenuService->footerMenuParent($parent_id);
        return view('admin.footer-menu.index', compact('footerMenus', 'parent_id'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function footerChildList($id)
//    {
//        $footerChildLists = $this->footerMenuService->findOne($id, 'children');
//
//        return view('admin.footer-menu.footer-child.index', compact('footerChildLists'));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id = 0)
    {
        return view('admin.footer-menu.create', compact('parent_id'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createChildMenu($id)
    {
        $parentId = $id;
        return view('admin.footer-menu.footer-child.create', compact('parentId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parentId = $request->parent_id;

        $response = $this->footerMenuService->storeFooterMenu($request->all());
        Session::flash('message', $response->getContent());
        return redirect( ($parentId == 0) ? '/footer-menu' : "/footer-menu/$parentId/child-footer");
    }

    public function storeChildMenu(Request $request)
    {
        $parentId = $request->parent_id;
        $response = $this->footerMenuService->storeFooterMenu($request->all());
        Session::flash('message', $response->getContent());
        return redirect("child-footer/$parentId");
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $footerMenu = $this->footerMenuService->findOrFail($id);
       return view('admin.footer-menu.edit', compact('footerMenu'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function childEdit($id, $parentId)
    {
       $footerChildMenu = $this->footerMenuService->findOrFail($id);
       return view('admin.footer-menu.footer-child.edit', compact('footerChildMenu', 'parentId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $response = $this->footerMenuService->updateFooterMenu($request->all(), $id);
       Session::flash('message', $response->getContent());
       return redirect('footer-menu');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function childUpdate(Request $request, $id)
    {
        $parentId = $request->parent_id;

        $response = $this->footerMenuService->updateFooterMenu($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("child-footer/$parentId");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function parentFooterSortable(Request $request)
    {
       return $this->footerMenuService->tableSort($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($parentId, $id)
    {
        $response = $this->footerMenuService->deleteFooterMenu($id);
        Session::flash('message', $response->getContent());
        return redirect(($parentId == 0) ? '/footer-menu' : "/footer-menu/$parentId/child-footer");
    }
}
