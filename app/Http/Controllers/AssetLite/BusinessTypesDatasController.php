<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Assetlite\BusinessTypeDatasService;
use App\Services\Assetlite\BusinessTypeService;
use Illuminate\Support\Facades\Session;
class BusinessTypesDatasController extends Controller
{
    /**
     * @var BusinessTypesService
     */
    private $businessTypesService;

    /**
     * @var BusinessTypesService
     */
    private $businessTypesDatasService;

    /**
     * LoyaltyTierController constructor.
     * @param BusinessTypesService $BusinessTypesService
     */
    public function __construct(
        BusinessTypeDatasService $businessTypesDatasService,
        BusinessTypeService $businessTypesService
    ) {
        $this->businessTypesService = $businessTypesService;
        $this->businessTypesDatasService = $businessTypesDatasService;
    }

    /**
     * Display a listing of the App Service Category.
     *
     * @return Factory|View
     */
    public function index($id)
    {
        $businessTypes = $this->businessTypesService->findOrFail($id);
        $businessTypesDatas = $this->businessTypesDatasService->findBy(['business_type_id'=>$id], 'businessType', [
                'column' => 'id',
                'direction' => 'ASC'
        ]);
        return view('admin.business-types-datas.index', compact('businessTypesDatas','id','businessTypes'));
    }

    /**
     * Show the form for creating a new App Service Category.
     *
     * @return Factory|View
     */
    public function create($id)
    {
        return view('admin.business-types-datas.create',compact('id'));
    }

    /**
     * Store a newly created App Service Category in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request,$id)
    {
        $this->businessTypesDatasService->storeBusinessTypeDatas($request->all(),$id);
        Session::flash('message', 'Business Types Data Add successfully!');
        return redirect('business-types-items/'.$id);
    }


    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($business_type_id,$id)
    {
        $businessTypesDatas = $this->businessTypesDatasService->findOrFail($id);
        $other_attributes = $businessTypesDatas->other_attributes;
        return view('admin.business-types-datas.edit', compact('businessTypesDatas','other_attributes','business_type_id'));
    }

    /**
     * Update a App Service category items
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $business_type_id,$id)
    {
        $this->businessTypesDatasService->updateBusinessTypeDatas($request->all(), $id);
        Session::flash('message', 'Business Types Item Update successfully!');
        return redirect('business-types-items/'.$business_type_id);
    }

    /**
     * @param $data
     * @return Response
     */
    public function typeSort(Request $request)
    {
       return $this->businessTypesDatasService->tableSortable($request->position);
    }

    /**
     * Delete a App Service category items
     *
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($business_type_id,$id)
    {
        $this->businessTypesDatasService->deleteBusinessTypeDatas($id);
        return url('business-types-items/'.$business_type_id);
    }
}
