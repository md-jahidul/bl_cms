<?php

namespace App\Http\Controllers\CMS;

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
    public function index()
    {
        $footerMenus = $this->footerMenuService->findAll();
        return view('admin.footer-menu.index', compact('footerMenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.footer-menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->footerMenuService->storeFooterMenu($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/footer-menu');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->footerMenuService->deleteFooterMenu($id);
        Session::flash('message', $response->getContent());
        return redirect('footer-menu');
    }
}
