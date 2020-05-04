<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\DynamicPageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DynamicPageController extends Controller {

    /**
     * @var AboutPageService
     */
    private $pageService;

    /**
     * DynamicPageController constructor.
     * @param DynamicPageService $pageService
     */
    public function __construct(DynamicPageService $pageService) {
        $this->pageService = $pageService;
    }

  
    public function index() {
        $pages = $this->pageService->getList();
        return view('admin.dynamic-pages.list', compact('pages'));
    }
  
    public function create() {
        return view('admin.dynamic-pages.create');
    }
  
    public function edit($id) {
         $page = $this->pageService->getPage($id);
        return view('admin.dynamic-pages.create', compact('page'));
    }
    
    public function savePage(Request $request) {
        
          $response = $this->pageService->savePage($request);
          
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Page is saved!');
        } else {
            Session::flash('error', 'Page saving process failed!');
        }

        return redirect('/dynamic-pages');
    }
    
    public function deletePage($id){
       $response = $this->pageService->deletePage($id); 
       
         if ($response['success'] == 1) {
            Session::flash('sussess', 'Page is delete!');
        } else {
            Session::flash('error', 'Page deleting process failed!');
        }

        return redirect('/dynamic-pages');
    }


}
