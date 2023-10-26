<?php

namespace App\Http\Controllers\AssetLite\Page;

use App\Helpers\ComponentHelper;
use App\Http\Controllers\Controller;
use App\Services\Page\PageService;
use App\Services\Page\PgComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PageComponentController extends Controller
{
    private $pgComponentService;

    /**
     * @param PgComponentService $pgComponentService
     */
    public function __construct(PgComponentService $pgComponentService)
    {
        $this->pgComponentService = $pgComponentService;
    }

    public function index($pageId)
    {

        $orderBy = ['column' => 'order', 'direction' => 'asc'];
        $components = $this->pgComponentService->findBy(['page_id' => $pageId], 'componentData', $orderBy);
//        $page = $this->pageService->findOne($pageId);
//        // $components = $this->pageService->getComponents($pageId);
//        $banner = $this->alBannerService->findBanner(self::PAGE_TYPE, $pageId);
//        $pageType = self::PAGE_TYPE;

        return view('admin.new-pages.components.index', compact('components', 'pageId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($pageId)
    {
        $componentTypes = ComponentHelper::pageComponents();
        return view('admin.new-pages.components.create', compact('pageId', 'componentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->pgComponentService->storeUpdatePageComponent($request->all());
        return Redirect::route('page-components', $request->pageId)->with('success', 'Page Component Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('Pages/Components/Create', [
            "pageId" => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $component = $this->pgComponentService->findOne($id, 'componentData');

        if ($component->type == "tab-component"){
            $component =  $this->pgComponentService->findOne($id, ['componentData' => function($q) {
                $q->where('parent_id', 0);
                $q->with('children');
            }]);
        }
        return Inertia::render('Pages/Components/Edit', [
            "component" => $component,
            'hostURL' => env('HOST_URL'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->pgComponentService->storeUpdatePageComponent($request->all(), $id);
        return Redirect::route('pages.show', $request->pageId)->with('success', 'Page Component Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->pgComponentService->destroy($id);
        return Redirect::back()->with('success', 'Page Component Deleted Successfully');
    }

    public function componentOrderingSave(Request $request)
    {
        $this->pgComponentService->saveSortedData($request->all());
        return Redirect::back()->with('success', 'Page Component Sorted Successfully');
    }
}
