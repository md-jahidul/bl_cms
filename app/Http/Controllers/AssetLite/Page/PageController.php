<?php

namespace App\Http\Controllers\AssetLite\Page;

use App\Helpers\ComponentHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DynamicPageStoreRequest;
use App\Models\PageComponent;
use App\Services\Page\PageService;
use App\Services\Page\PgComponentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    private $pageService;
    /**
     * @var PgComponentService
     */
    private $pgComponentService;

    /**
     * @param PageService $pageService
     */
    public function __construct(
        PageService $pageService,
        PgComponentService $pgComponentService
    ) {
        $this->pageService = $pageService;
        $this->pgComponentService = $pgComponentService;
    }

    public function index()
    {
        $pages = $this->pageService->findAll();
        return view('admin.new-pages.list', compact('pages'));
    }

    public function create()
    {
        return view('admin.new-pages.create');
    }

    public function edit($id)
    {
        $page = $this->pageService->findOne($id);
        return view('admin.new-pages.create', compact('page'));
    }

    public function store(Request $request)
    {
        $response = $this->pageService->storePage($request->all());
        Session::flash('success', $response->getContent());
        return redirect('/pages');
    }

    public function deletePage($id)
    {
        $this->pageService->destroy($id);
        return url('/pages');
    }


//    public function componentCreateForm()
//    {
//        // $componentTypes = $this->componentTypes;
//        // $pageId = 1;
//        // return view('admin.new-pages.components.create', compact('componentTypes', 'pageId'));
//
//        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
//        $storeAction = 'other-component-store';
//        $listAction = 'other-components';
//        $pageType = self::PAGE_TYPE;
//        return view('admin.components.create', compact('componentList', 'storeAction', 'listAction', 'pageType'));
//
//    }

//    public function componentStore(Request $request)
//    {
//
//        // return $request->all();
//        $pageId = $request->sections['id'];
//        $response = $this->componentService->componentStore($request->all(), $pageId, self::PAGE_TYPE);
//        Session::flash('success', $response->content());
//        return redirect(route('other-components', [$pageId]));
//    }

//    public function componentEditForm(Request $request, $id)
//    {
//        // $componentTypes = $this->componentTypes;
//        // $component = $this->componentService->findOne($id);
//        // $multipleImage = $component['multiple_attributes'];
//        // return view('admin.new-pages.components.edit', compact('component', 'multipleImage', 'componentTypes', 'pageId'));
//
//        $component = $this->componentService->findOne($id);
//        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
//        $updateAction = 'other-component-update';
//        $listAction = 'other-components';
//        return view('admin.components.edit', compact('component', 'componentList', 'updateAction', 'listAction'));
//    }

//    /**
//     * @param Request $request
//     * @param $pageId
//     * @param $id
//     * @return Application|RedirectResponse|Redirector
//     */
//    public function componentUpdate(Request $request,  $id)
//    {
//        // $response = $this->componentService->componentUpdate($request->all(), $id);
//        // Session::flash('success', $response->content());
//        // return redirect(route('other-components', [$pageId]));
//
//        // return $request->all();
//        $request['page_type'] = self::PAGE_TYPE;
//        $pageId = $request->sections['id'];
//
//        $response = $this->componentService->componentUpdate($request->all(), $id);
//        Session::flash('message', $response->getContent());
//        return redirect(route('other-components', [$pageId]));
//    }
//
//    public function componentSortable(Request $request)
//    {
//        $this->componentService->tableSortable($request);
//    }

//    /**
//     * @param $pageId
//     * @param $id
//     * @return string
//     * @throws \Exception
//     */
//    public function componentDestroy($id)
//    {
//        $this->componentService->deleteComponent($id);
//        // return url(route('other-components', [$pageId]));
//        return url()->previous();
//    }

}
