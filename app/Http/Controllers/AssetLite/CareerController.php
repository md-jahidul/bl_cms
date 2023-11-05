<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\ComponentHelper;
use App\Http\Requests\DynamicPageStoreRequest;
use App\Services\Assetlite\ComponentService;
use App\Services\DynamicPageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AlBannerService;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class CareerController extends Controller
{

    /**
     * @var DynamicPageService
     */
    private $pageService;

    /**
     * @var ComponentService
     */
    private $componentService;

    protected $alBannerService;
    protected const PAGE_TYPE = "other_dynamic_page";


    /**
     * DynamicPageController constructor.
     * @param DynamicPageService $pageService
     * @param ComponentService $componentService
     */
    public function __construct(DynamicPageService $pageService, ComponentService $componentService, AlBannerService $alBannerService)
    {
        $this->pageService = $pageService;
        $this->componentService = $componentService;
        $this->alBannerService = $alBannerService;

    }

    // protected $componentTypes = [
    //     // 'large_title_with_text' => 'Large Title With Text',
    //     // 'medium_title_with_text' => 'Medium Title With Text',
    //     // 'small_title_with_text' => 'Small Title With Text',
    //     // 'text_and_button' => 'Text And Button',
    //     // 'text_component' => 'Text Component',
    //     // 'features_component' => 'Features Component',

    //     // 'title_with_text_and_right_image' => 'Title with text and right Image',
    //     // 'bullet_text' => 'Bullet Text',
    //     // 'accordion_text' => 'Accordion Text',
    //     // 'table_component' => 'Table Component',
    //     'title_with_video_and_text' => 'Title with Video and text',
    //     'button_component' => 'Button Component',
    //     'multiple_image' => 'Multiple Image',
    //     'customer_complaint' => 'Customer Complaint',
    // ];


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

        $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
        $components = $this->componentService->findBy(['page_type' => self::PAGE_TYPE, 'section_details_id' => $pageId], '', $orderBy);


        $page = $this->pageService->findOne($pageId);
        // $components = $this->pageService->getComponents($pageId);
        $banner = $this->alBannerService->findBanner(self::PAGE_TYPE, $pageId);
        $pageType = self::PAGE_TYPE;

        return view('admin.dynamic-pages.components.index', compact('components', 'page', 'banner', 'pageType'));
    }

    public function componentCreateForm()
    {
        // $componentTypes = $this->componentTypes;
        // $pageId = 1;
        // return view('admin.dynamic-pages.components.create', compact('componentTypes', 'pageId'));

        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
        $storeAction = 'other-component-store';
        $listAction = 'other-components';
        $pageType = self::PAGE_TYPE;
        return view('admin.components.create', compact('componentList', 'storeAction', 'listAction', 'pageType'));

    }

    public function componentStore(Request $request)
    {

        // return $request->all();
        $pageId = $request->sections['id'];
        $response = $this->componentService->componentStore($request->all(), $pageId, self::PAGE_TYPE);
        Session::flash('success', $response->content());
        return redirect(route('other-components', [$pageId]));
    }

    public function componentEditForm(Request $request, $id)
    {

        // $componentTypes = $this->componentTypes;
        // $component = $this->componentService->findOne($id);
        // $multipleImage = $component['multiple_attributes'];
        // return view('admin.dynamic-pages.components.edit', compact('component', 'multipleImage', 'componentTypes', 'pageId'));

        $component = $this->componentService->findOne($id);
        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
        $updateAction = 'other-component-update';
        $listAction = 'other-components';
        return view('admin.components.edit', compact('component', 'componentList', 'updateAction', 'listAction'));


    }

    /**
     * @param Request $request
     * @param $pageId
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function componentUpdate(Request $request,  $id)
    {
        // $response = $this->componentService->componentUpdate($request->all(), $id);
        // Session::flash('success', $response->content());
        // return redirect(route('other-components', [$pageId]));

        // return $request->all();
        $request['page_type'] = self::PAGE_TYPE;
        $pageId = $request->sections['id'];

        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
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
    public function componentDestroy($id)
    {
        $this->componentService->deleteComponent($id);
        // return url(route('other-components', [$pageId]));
        return url()->previous();
    }


}
