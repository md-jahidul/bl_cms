<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\DynamicPageStoreRequest;
use App\Repositories\CorpCaseStudyDetailsBannerRepository;
use App\Services\Assetlite\ComponentService;
use App\Services\CorpCaseStudyComponentService;
use App\Services\DynamicPageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class CorpCaseStudyComponentDetailsController extends Controller
{
    /**
     * @var ComponentService
     */
    private $componentService;

    protected const PAGE_TYPE = "case_study_component_details";
    /**
     * @var CorpCaseStudyComponentService
     */
    private $corpCaseStudyComponentService;
    /**
     * @var CorpCaseStudyDetailsBannerRepository
     */
    private $bannerRepository;

    /**
     * DynamicPageController constructor.
     * @param CorpCaseStudyComponentService $corpCaseStudyComponentService
     * @param ComponentService $componentService
     * @param CorpCaseStudyDetailsBannerRepository $bannerRepository
     */
    public function __construct(
        CorpCaseStudyComponentService $corpCaseStudyComponentService,
        ComponentService $componentService,
        CorpCaseStudyDetailsBannerRepository $bannerRepository
    )
    {
        $this->corpCaseStudyComponentService = $corpCaseStudyComponentService;
        $this->componentService = $componentService;
        $this->bannerRepository = $bannerRepository;
    }

    protected $componentTypes = [
        'large_title_and_image_with_text' => 'Large Title And Image With Text',
        'medium_title_with_text' => 'Medium Title With Text',
        'small_title_with_text' => 'Small Title With Text',
        'text_component' => 'Text Component',
        'order_list' => 'Order List',
        'card_component' => 'Card Component',
    ];

    public function componentList($componentId)
    {
        $sectionComponent = $this->corpCaseStudyComponentService->findOne($componentId);
        $components = $this->componentService->componentList($componentId, self::PAGE_TYPE);
        $banner = $this->bannerRepository->findOneByProperties(['details_id' => $componentId]);
        return view('admin.corporate-responsibility.case-study-and-report.details-components.index',
            compact('components', 'sectionComponent', 'banner'));
    }

    public function componentCreateForm($sectionComId)
    {
        $componentTypes = $this->componentTypes;
        return view('admin.corporate-responsibility.case-study-and-report.details-components.create', compact('componentTypes', 'sectionComId'));
    }

    public function componentStore(Request $request, $sectionComId)
    {
        $response = $this->componentService->componentStore($request->all(), $sectionComId, self::PAGE_TYPE);
        Session::flash('success', $response->content());

        return redirect(route('case-study-details.index', [$sectionComId]));
    }

    public function componentEditForm($sectionComId, $id)
    {
        $componentTypes = $this->componentTypes;
        $component = $this->componentService->findOne($id);
        $multipleItems = $component['multiple_attributes'];
        return view('admin.corporate-responsibility.case-study-and-report.details-components.edit', compact('component', 'multipleItems', 'componentTypes', 'sectionComId'));
    }

    /**
     * @param Request $request
     * @param $pageId
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function componentUpdate(Request $request, $sectionComId, $id)
    {
        $response = $this->componentService->componentUpdate($request->all(), $id, self::PAGE_TYPE);
        Session::flash('success', $response->content());
        return redirect(route('case-study-details.index', [$sectionComId]));
    }

    public function componentSortable(Request $request)
    {
        $this->componentService->tableSortable($request);
    }

    public function detailsBannerUpload(Request $request)
    {
        $response = $this->corpCaseStudyComponentService->bannerImageUpload($request->all());
        Session::flash('success', $response->content());
        return redirect(route('case-study-details.index', [$request->section_component_id]));
    }

    /**
     * @param $sectionComId
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function componentDestroy($sectionComId, $id)
    {
        $this->componentService->deleteComponent($id);
        return url(route('case-study-details.index', [$sectionComId]));
    }
}
