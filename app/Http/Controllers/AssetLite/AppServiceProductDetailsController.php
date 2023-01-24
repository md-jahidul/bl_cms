<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\AppServiceDetailsFixedSectionRequest;
use App\Models\AppServiceProduct;
use App\Services\Assetlite\AppServiceProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Services\Assetlite\AppServiceProductDetailsService;

class AppServiceProductDetailsController extends Controller
{
    /**
     * @var $appServiceCategoryRepository
     */
    private $appServiceProductDetailsService;
    /**
     * @var $appServiceTabRepository
     */
    private $appServiceProduct;
    /**
     * @var $appServiceProductService
     */
    protected $info = [];

    protected $componentTypes = [
        'title_text_editor' => 'Title with text editor',
        'accordion_section' => 'Accordion',
        'table_component' => 'Table Component',
        'text_with_image_right' => 'Text with image right',
        'text_with_image_bottom' => 'Text with image bottom',
        'slider_text_with_image_right' => 'Slider text with image right',
        'video_with_text_right' => 'Video with text right',
        'multiple_image_banner' => 'Multiple image banner',
        'pricing_sections' => 'Pricing Multiple table',
        'static_easy_payment_card' => 'Static Component - Easy payment card',
        'image_with_content' => 'Image With Content',
        'multiple_tab_image' => 'Multiple Tab With Image'
    ];

    /**
     *
     * @param AppServiceProductDetailsService $appServiceProductDetailsService
     * @param AppServiceProduct $appServiceProduct
     */

    public function __construct(
        AppServiceProductDetailsService $appServiceProductDetailsService,
        AppServiceProductService $appServiceProduct
    ) {
        $this->appServiceProductDetailsService = $appServiceProductDetailsService;
        $this->appServiceProduct = $appServiceProduct;
    }

    /**
     * @param $tab_type
     * @param $product_id
     * @return Application|Factory|View
     */
    public function productDetails($tab_type, $product_id)
    {
        $this->info['tab_type'] = $tab_type;
        $this->info['product_id'] = $product_id;
        $this->info["section_list"] = $this->appServiceProductDetailsService->sectionList($product_id);
        $this->info["products"] = $this->appServiceProduct->appServiceRelatedProduct($tab_type, $product_id);
        $this->info["productDetail"] = $this->appServiceProduct->detailsProduct($product_id);
        $this->info["fixedSectionData"] = $this->info["section_list"]['fixed_section'];
        return view('admin.app-service.details.section.index', $this->info);
    }

    public function create($tab_type, $product_id)
    {
        return view('admin.app-service.details.components.create', compact('tab_type', 'product_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request, $tab_type, $product_id)
    {
        $data = $request->all();
        // Create new sections
        if ($request->has('save')) {
            $response = $this->appServiceProductDetailsService->storeAppServiceProductDetails($request->all(), $tab_type, $product_id);
            Session::flash('message', $response->getContent());
            return redirect(url("app-service/details/$tab_type/$product_id"));
        } elseif ($request->has('update')) {
            # Update section data
            $section_data = $data['sections'];
            if (isset($section_data['id']) && !empty($section_data['id'])) {
                $this->appServiceProductDetailsService->updateAppServiceDetailsSection($section_data, $section_data['id']);
                # Update component data
                $component_data = $data['component'];
                if (isset($component_data) && count($component_data) > 0) {
                    foreach ($component_data as $component_value) {
                        $this->appServiceProductDetailsService->updateAppServiceDetailsComponent($component_value, $component_value['id'], $request->all());
                    }
                }
            }

            Session::flash('message', 'Section component updated successfully');
            return redirect(url("app-service/details/$tab_type/$product_id"));

        } elseif ($request->has('compnent_muti_attr_update')) {
            # Update component data
            $component_data = $data['component'];
            if (isset($component_data) && count($component_data) > 0) {
                foreach ($component_data as $key => $component_value) {
                    $this->appServiceProductDetailsService->updateAppServiceDetailsComponent($component_value, $component_value['id'], $key);
                }
            }
        }
        Session::flash('message', 'Section component updated succesfuly');
        return redirect(url("app-service/details/$tab_type/$product_id"));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $tab_type
     * @param $product_id
     * @return RedirectResponse|Redirector
     */
    public function fixedSectionUpdate(Request $request, $tab_type, $product_id)
    {
        $response = $this->appServiceProductDetailsService->fixedSectionUpdate($request->all(), $tab_type, $product_id);
        Session::flash('message', $response->getContent());
        return redirect(url("app-service/details/$tab_type/$product_id"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($tab_type, $product_id, $section_id)
    {

        // $section = $this->appServiceProductDetailsService->getSectionComponentByID($section_id);

        $section = $this->appServiceProductDetailsService->getJsonSectionComponentList($section_id);
        //if (
//            $section['sections']->section_type == 'slider_text_with_image_right' ||
//            $section['sections']->section_type == 'multiple_image_banner' ||
         //   $section['sections']->section_type == 'pricing_sections'
        // ) {
        //     if (!empty($section) && count($section) > 0) {
        //         return response()->json([
        //             'status' => 'SUCCESS',
        //             'message' => 'Data found',
        //             'data' => $section
        //         ], 200);
        //     } else {
        //         return response()->json([
        //             'status' => 'FAILED',
        //             'message' => 'Data not found',
        //             'data' => []
        //         ], 404);
        //     }
        // }

        $componentTypes = $this->componentTypes;
        $component = $section['component'][0];
        return view('admin.app-service.details.components.edit', compact(
            'tab_type',
            'product_id',
            'section',
            'component',
            'componentTypes'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $tab_type, $product_id, $id)
    {
        $response = $this->appServiceProductDetailsService->updateAppServiceDetailsSection($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('app_service.details.list', [$tab_type, $product_id]));
    }

    public function tabWiseCategory($tabId)
    {
        return $this->appServiceCategoryRepository
            ->findByProperties(['app_service_tab_id' => $tabId], ['id', 'title_en', 'alias']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($tab_type, $product_id, $id)
    {
//        dd($product_id);

        $response = $this->appServiceProductDetailsService->sectionDelete($id);
        // Session::flash('message', $response->getContent());
        if ($response) {
            session()->flash('error', "Deleted successfully");
            return url(route('app_service.details.list', [$tab_type, $product_id]));
        }

        session()->flash('message', "Failed! Please try again");
    }


    public function sectionsSortable(Request $request)
    {
        $this->appServiceProductDetailsService->tableSortable($request);
    }
}
