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
    public function storeOrUpdate(Request $request, $pageId, $id = null)
    {
        $this->pgComponentService->storeUpdatePageComponent($request->all(), $id);
        return Redirect::route('page-components', $pageId)->with('success', 'Page Component Saved Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($pageId, $id)
    {
        $componentTypes = ComponentHelper::pageComponents();
        $component = $this->pgComponentService->findOne($id, 'componentData');
        $componentData = [];
        foreach ($component->componentData as $data){

            if ($data->parent_id == 0) {
                $componentData[$data->group][$data->key] = [
                    'id' => $data->id,
                    'value_en' => $data->value_en,
                    'value_bn' => $data->value_bn,
                    'group' => $data->group,
                ];
            }
            $tabComponents = [
                "tab_component_with_image_card_one",
                "tab_component_with_image_card_two",
                "tab_component_with_image_card_three",
                "tab_component_with_image_card_four"
            ];
            $tabItemData = [];
            if (!empty($data->children) && in_array($component->type, $tabComponents)) {
                foreach ($data->children as $childData) {
                    $tabItemData["$childData->group"][$childData->key] = [
                        'id' => $childData->id,
                        'parent_id' => $childData->parent_id,
                        'value_en' => $childData->value_en,
                        'value_bn' => $childData->value_bn,
                        'group' => $childData->group,
                    ];
                }
                if (!empty($tabItemData)){
                    $componentData[$data->group]['data'] = array_values($tabItemData);
                }
            }
        }

        $component->component_data_mod = array_values($componentData);
        return $component;
        dd($component);
//        unset($component->componentData);
//
//        if ($component->type == "tab_component_with_image_card_one"){
//            $component =  $this->pgComponentService->findOne($id, ['componentData' => function($q) {
//                $q->where('parent_id', 0);
//                $q->with('children');
//            }]);
//
//        }
        return view('admin.new-pages.components.edit', compact('component', 'componentTypes', 'pageId'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($parentId, $id)
    {
        $this->pgComponentService->destroy($id);
        return url("/page-components/$parentId");
    }

    public function componentDataItemDelete(Request $request)
    {
        return $this->pgComponentService->deleteDataItem($request->all());
    }
    public function componentOrderingSave(Request $request)
    {
        $this->pgComponentService->saveSortedData($request->all());
        return "Success";
    }
}
