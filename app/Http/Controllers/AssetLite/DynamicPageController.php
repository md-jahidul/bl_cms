<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\DynamicPageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DynamicPageController extends Controller
{

    /**
     * @var DynamicPageService
     */
    private $pageService;
    /**
     * DynamicPageController constructor.
     * @param DynamicPageService $pageService
     */
    public function __construct(DynamicPageService $pageService)
    {
        $this->pageService = $pageService;
    }

    protected $componentTypes = [
//        'large_title_with_text' => 'Large Title With Text',
//        'large_title_text_button' => 'Large Title With Text And Button',
//        'medium_title_with_text' => 'Medium Title With Text',
//        'small_title_with_text' => 'Small Title With Text',
//        'text_and_button' => 'Text And Button',
//        'text_component' => 'Text Component',
//        'features_component' => 'Features Component',
        'table_component' => 'Table Component',
        'bullet_text' => 'Bullet Text',
        'accordion_text' => 'Accordion Text',
        'multiple_image' => 'Multiple Image',
    ];


    public function index()
    {
        $pages = $this->pageService->getList();
        return view('admin.dynamic-pages.list', compact('pages'));
    }

    public function create()
    {
        return view('admin.dynamic-pages.create');
    }

    public function edit($id)
    {
        $page = $this->pageService->getPage($id);
        return view('admin.dynamic-pages.create', compact('page'));
    }

    public function savePage(Request $request)
    {
        $request->validate([
            'page_name_en' => 'required',
            'page_name_bn' => 'required',
            'url_slug' => 'required',
        ]);

        $response = $this->pageService->savePage($request->all());

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Page is saved!');
        } else {
            Session::flash('error', $response['message']);
        }

        return redirect('/dynamic-pages');
    }

    public function componentList($pageId)
    {
        $page = $this->pageService->findOne($pageId);
        $components = $this->pageService->getComponents($pageId);
        return view('admin.dynamic-pages.components.index', compact('components', 'page'));
    }

    public function componentCreateForm($pageId)
    {
        $componentTypes = $this->componentTypes;
        return view('admin.dynamic-pages.components.create', compact('componentTypes', 'pageId'));
    }

    public function deletePage($id)
    {
        $response = $this->pageService->deletePage($id);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Page is delete!');
        } else {
            Session::flash('error', 'Page deleting process failed!');
        }

        return redirect('/dynamic-pages');
    }


}
