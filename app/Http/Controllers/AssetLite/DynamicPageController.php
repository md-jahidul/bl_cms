<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\DynamicPageStoreRequest;
use App\Services\Assetlite\ComponentService;
use App\Services\DynamicPageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class DynamicPageController extends Controller
{

    /**
     * @var DynamicPageService
     */
    private $pageService;

    /**
     * @var ComponentService
     */
    private $componentService;

    protected const PAGE_TYPE = "other_dynamic_page";

    /**
     * DynamicPageController constructor.
     * @param DynamicPageService $pageService
     * @param ComponentService $componentService
     */
    public function __construct(DynamicPageService $pageService, ComponentService $componentService)
    {
        $this->pageService = $pageService;
        $this->componentService = $componentService;
    }

    protected $componentTypes = [
//        'large_title_with_text' => 'Large Title With Text',
//        'medium_title_with_text' => 'Medium Title With Text',
//        'small_title_with_text' => 'Small Title With Text',
//        'text_and_button' => 'Text And Button',
//        'text_component' => 'Text Component',
//        'features_component' => 'Features Component',
        'title_with_text_and_right_image' => 'Title with text and right Image',
        'title_with_video_and_text' => 'Title with Video and text',
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

    public function savePage(DynamicPageStoreRequest $request)
    {
        $response = $this->pageService->savePage($request->all());
        if ($response['success'] == 1) {
            Session::flash('success', $response['message']);
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

    public function componentStore(Request $request, $pageId)
    {
        $response = $this->componentService->componentStore($request->all(), $pageId, self::PAGE_TYPE);
        Session::flash('success', $response->content());
        return redirect(route('other-components', [$pageId]));
    }

    public function componentEditForm($pageId, $id)
    {
        $componentTypes = $this->componentTypes;
        $component = $this->componentService->findOne($id, ['componentMultiData']);
        $multipleImage = $component['multiple_attributes'];
        return view('admin.dynamic-pages.components.edit', compact('component', 'multipleImage', 'componentTypes', 'pageId'));
    }

    /**
     * @param Request $request
     * @param $pageId
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function componentUpdate(Request $request, $pageId, $id)
    {
        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('success', $response->content());
        return redirect(route('other-components', [$pageId]));
    }

    public function componentSortable(Request $request)
    {
        $this->componentService->tableSortable($request);
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


    /**
     * @param $pageId
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function componentDestroy($pageId, $id)
    {
        $this->componentService->deleteComponent($id);
        return url(route('other-components', [$pageId]));
    }


}
