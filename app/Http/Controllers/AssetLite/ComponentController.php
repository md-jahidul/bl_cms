<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Services\Assetlite\ComponentService;
use App\Services\Assetlite\AppServiceProductDetailsService;


class ComponentController extends Controller
{

    /**
     * [$componentService description]
     * @var [object]
     */
    private $componentService;

    /**
     * [$appServiceProductDetailsService]
     * @var [type]
     */
    private $appServiceProductDetailsService;

    /**
     * [__construct description]
     * @param ComponentService $componentService [description]
     */
    public function __construct(
        ComponentService $componentService,
        AppServiceProductDetailsService $appServiceProductDetailsService
    )
    {
        $this->componentService = $componentService;
        $this->appServiceProductDetailsService = $appServiceProductDetailsService;
    }


    /**
     * [conponentList description]
     * @param  [type] $tab_type   [description]
     * @param  [type] $product_id [description]
     * @return [type]             [description]
     */
    public function conponentList($tab_type, $section_id)
    {

        $component_list = $this->componentService->componentList($section_id, 'app_services');

        $section_data = $this->appServiceProductDetailsService->getSectionColumnInfoByID($section_id, ['multiple_component', 'product_id']);

        $section_has_multiple_component = isset($section_data->multiple_component) ? $section_data->multiple_component : null;


        $data['tab_type'] = $tab_type;
        $data['section_id'] = $section_id;
        $data['product_id'] = isset($section_data->product_id) ? $section_data->product_id : null;


        return view('admin.app-service.details.components.index', compact('data', 'component_list', 'section_has_multiple_component'));

    }

    /**
     * [conponentCreate description]
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function conponentCreate(Request $request)
    {

        $component_type = $request->input('component_type', '');
        $data['tab_type'] = $request->input('tab_type', '');
        $data['section_id'] = $request->input('section_id', '');

        return view('admin.app-service.details.components.create', compact('data', 'component_type'));

    }


    public function conponentStore(Request $request)
    {
        dd($request->all());
        $response = $this->componentService->storeComponentDetails($request->all());

        $section_id = $request->input('section_details_id');
        $tab_type = $request->input('tab_type');

        Session::flash('message', 'Component added successfuly');
        return redirect(url("app-service/component/$tab_type/$section_id"));

    }


    public function conponentEdit($type, $id)
    {

        $appServiceProduct = $this->componentService->findOne($id);

        $component_type = $appServiceProduct->component_type;
        $data['tab_type'] = $type;
        $data['section_id'] = $appServiceProduct->section_details_id;

        $options = json_decode($appServiceProduct->multiple_attributes, true);

        dd($options);

        // return view('admin.app-service.details.components.edit', compact('data', 'component_type'));
        return view('admin.app-service.details.components.edit', compact('appServiceProduct', 'data', 'component_type'));

    }

    /**
     * [conponentItemAttr description]
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function conponentItemAttr(Request $request)
    {

        $component_id = $request->input('component_id', null);
        $item_id = $request->input('item_id', null);

        if (!empty($component_id) && !empty($item_id)) {
            $appServiceComponent = $this->componentService->findOne($component_id);

            $multi_attr_value = $appServiceComponent->multiple_attributes;
            if (!empty($multi_attr_value)) {
                $appServiceComponent = $this->componentService->processMultiAttrValue($multi_attr_value, $item_id);

                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'Data found',
                    'data' => $appServiceComponent
                ], 200);

            } else {
                return response()->json([
                    'status' => 'FAILED',
                    'message' => 'Data not found',
                    'data' => []
                ], 404);
            }


        } else {
            return response()->json([
                'status' => 'FAILED',
                'message' => 'Data not found',
                'data' => []
            ], 404);
        }

    }


    /**
     * Multiple attribute sortable for component
     * @return [type] [description]
     */
    public function multiAttributeSortable(Request $request)
    {
        $this->componentService->attrTableSortable($request);

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Data sorted',
            'data' => []
        ], 200);

    }

    /**
     * [conponentItemAttrStore description]
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function conponentItemAttrStore(Request $request)
    {
        $response = $this->componentService->storeComponentMultiItemAttr($request->all());

        $product_id = $request->input('product_id');
        $tab_type = $request->input('tab_type');

        Session::flash('message', 'Component item updated successfuly');
        return redirect(url("app-service/details/$tab_type/$product_id"));
    }

    /**
     * [conponentItemAttrDestroy description]
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function conponentItemAttrDestroy(Request $request)
    {

        $response = $this->componentService->conponentMultiAttrItemDestroy($request->all());

        if ($response) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Data updated',
                'data' => []
            ], 200);
        } else {
            return response()->json([
                'status' => 'FAILED',
                'message' => 'Data update failed',
                'data' => []
            ], 404);
        }
    }


}  // class End
