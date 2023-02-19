<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\ComponentHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessPackageRequest;
use App\Services\Assetlite\ComponentService;
use App\Services\BusinessPackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;


class BusinessPackageDetailsController extends Controller {

    public const PAGE_TYPE = "business_package_details";

    private $packageService;
    protected $componentService;

    /**
     * BusinessPackageController constructor.
     * @param BusinessPackageService $packageService
     */
    public function __construct(BusinessPackageService $packageService, ComponentService $componentService) {
        $this->packageService = $packageService;
        $this->componentService = $componentService;
    }

    /**
     * List of business packages details page component.
     * 
     * @param No
     * @return Factory|View
     * @shuvo || 19/02/2023
     */
    public function index($id) {
        $packages = $this->packageService->getPackages();
        $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
        $components = $this->componentService->findBy(['page_type' => self::PAGE_TYPE, 'section_details_id' => $id], '', $orderBy);
        
        return view('admin.business.package_details_list', compact('packages','components'));
    }

    /**
     * Component
     */
    
    public function componentCreate()
    {
        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
        $storeAction = 'business-package-details-component.store';
        $listAction = 'business-package-details-component.list';
        $pageType = self::PAGE_TYPE;
        return view('admin.components.create', compact('componentList', 'storeAction','listAction', 'pageType'));
    }
 
    public function componentStore(Request $request)
    {
        // return $request->all();
        $section_details_id = $request->sections['id'];;
        $response = $this->componentService->componentStore($request->all(), $section_details_id , self::PAGE_TYPE);
        Session::flash('message', $response->getContent());
        // return redirect('/business-package');
        return redirect('business-package-details-component/'.$section_details_id.'/list');
    }
 
    public function componentEdit(Request $request, $id)
    {
        $component = $this->componentService->findOne($id);
        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
        $updateAction = 'business-package-details-component.update';
        $listAction = 'business-package-details-component.list';
        return view('admin.components.edit', compact('component', 'componentList', 'updateAction', 'listAction'));
    }
 
    public function componentUpdate(Request $request, $id)
    {
        // return $request->all();
        $request['page_type'] = self::PAGE_TYPE;
        $section_details_id = $request->sections['id'];; 
        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        // return redirect('/business-package');
        return redirect('business-package-details-component/'.$section_details_id.'/list');

    }
 
 
    public function componentSortable(Request $request): Response
    {
    return $this->componentService->tableSortable($request->all());
    }
 
    public function componentDestroy($id)
    {
    $this->componentService->deleteComponent($id);
    return url()->previous();
    }
   
    
    


}
