<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\MyBlInternetOffersCategory;
use App\Http\Requests\MyBlInternetOffersCategoryRequest;
use App\Services\Assetlite\AlInternetOffersCategoryService;

class AlInternetOffersCategoryController extends Controller
{
    private $alInternetOffersCategoryService;


    public function __construct(AlInternetOffersCategoryService $alInternetOffersCategoryService)
    {
        $this->alInternetOffersCategoryService = $alInternetOffersCategoryService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $offerCategory=$this->alInternetOffersCategoryService->findAll(null,null, [
            'column' => 'sort',
            'direction' => 'ASC'
        ])->where('platform', 'al');

        return view('admin.al-data-bundle.index',compact('offerCategory'));
    }

 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page='create';
        return view('admin.al-data-bundle.create',compact('page'));
    }
/**
 * Undocumented function
 *
 * @param Request $request
 * @return void
 */
    public function saveSortFilter(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'sort' => 'required',
            ]
        );

        if ($validate->fails()) {
            Session()->flash('error', 'validation error');
                return redirect('al-internet-offer-category/create')
                            ->withErrors($validate)
                            ->withInput();
            }
        $response = $this->alInternetOffersCategoryService->storeInternetOffersCategory($request->all());
        if($response['status'] == 200){
            Session()->flash('message', $response['message']);
        }
        else {
            Session()->flash('error', $response['message']);
        }

        return redirect('al-internet-offer-category');
    }
/**
 * Undocumented function
 *
 * @param [type] $id
 * @return void
 */
    public function edit($id=null){
        $page='create';
        $internet_offer=MyBlInternetOffersCategory::find($id);
        return view('admin.al-data-bundle.edit',compact('page','internet_offer'));
    }
/**
 * Undocumented function
 *
 * @param MyBlInternetOffersCategoryRequest $request
 * @param [type] $id
 * @return void
 */
    public function update(MyBlInternetOffersCategoryRequest $request, $id){

        $response = $this->alInternetOffersCategoryService->updateInternetOffersCategory($request->all(),$id);

        if($response['status'] == 200){
            Session()->flash('message', $response['message']);
        }
        else {
            Session()->flash('error', $response['message']);
        }

        return redirect('al-internet-offer-category');

    }
/**
 * Undocumented function
 *
 * @param [type] $id
 * @return void
 */
    public function destroy($id){
        return $this->alInternetOffersCategoryService->delFilter($id);

    }
}
