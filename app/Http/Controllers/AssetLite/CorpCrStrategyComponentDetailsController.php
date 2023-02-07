<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\DynamicPageStoreRequest;
use App\Services\Assetlite\ComponentService;
use App\Services\CorpCrStrategyComponentService;
use App\Services\DynamicPageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class CorpCrStrategyComponentDetailsController extends Controller
{
    /**
     * @var ComponentService
     */
    private $componentService;

    protected const PAGE_TYPE = "cr_strategy_component_details";
    /**
     * @var CorpCrStrategyComponentService
     */
    private $corpCrStrategyComponentService;

    /**
     * DynamicPageController constructor.
     * @param CorpCrStrategyComponentService $corpCrStrategyComponentService
     * @param ComponentService $componentService
     */
    public function __construct(
        CorpCrStrategyComponentService $corpCrStrategyComponentService,
        ComponentService $componentService
    ) {
        $this->corpCrStrategyComponentService = $corpCrStrategyComponentService;
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

    public function componentList($componentId)
    {
        $sectionComponent = $this->corpCrStrategyComponentService->findOne($componentId);
        $components = $this->componentService->componentList($componentId, self::PAGE_TYPE);
        return view('admin.corporate-responsibility.cr-strategy.details-components.index', compact('components', 'sectionComponent'));
    }

    public function componentCreateForm($sectionComId)
    {
        $componentTypes = $this->componentTypes;
        return view('admin.corporate-responsibility.cr-strategy.details-components.create', compact('componentTypes', 'sectionComId'));
    }

    public function componentStore(Request $request, $sectionComId)
    {
        $response = $this->componentService->componentStore($request->all(), $sectionComId, self::PAGE_TYPE);
        Session::flash('success', $response->content());

        return redirect(route('cr-strategy-details.index', [$sectionComId]));
    }

    public function componentEditForm($sectionComId, $id)
    {
        $componentTypes = $this->componentTypes;
        $component = $this->componentService->findOne($id, ['componentMultiData']);
        $multipleImage = $component['multiple_attributes'];
        return view('admin.corporate-responsibility.cr-strategy.details-components.edit', compact('component', 'multipleImage', 'componentTypes', 'sectionComId'));
    }

    /**
     * @param Request $request
     * @param $pageId
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function componentUpdate(Request $request, $sectionComId, $id)
    {
        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('success', $response->content());
        return redirect(route('cr-strategy-details.index', [$sectionComId]));
    }

    public function componentSortable(Request $request)
    {
        $this->componentService->tableSortable($request);
    }

    public function detailsBannerUpload(Request $request)
    {
        $response = $this->corpCrStrategyComponentService->bannerImageUpload($request->all());
        Session::flash('success', $response->content());
        return redirect(route('cr-strategy-details.index', [$request->section_component_id]));
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
        return url(route('cr-strategy-details.index', [$sectionComId]));
    }
}
