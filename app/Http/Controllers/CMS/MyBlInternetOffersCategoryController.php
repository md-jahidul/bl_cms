<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MyBlInternetOffersCategoryService;
use Illuminate\Support\Facades\Validator;
use App\Models\MyBlInternetOffersCategory;
use App\Http\Requests\MyBlInternetOffersCategoryRequest;

class MyBlInternetOffersCategoryController extends Controller
{
    /**
     * @var MyBlInternetOffersCategoryService
     */
    private $myBlInternetOffersCategoryService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * MyBlInternetOffersCategory constructor.
     * @param MyBlInternetOffersCategoryService $myBlInternetOffersCategoryService
     */
    public function __construct(MyBlInternetOffersCategoryService $myBlInternetOffersCategoryService)
    {
        $this->myBlInternetOffersCategoryService = $myBlInternetOffersCategoryService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $offerCategory=$this->myBlInternetOffersCategoryService->findAll(null,null, [
            'column' => 'sort',
            'direction' => 'ASC'
        ])->where('platform', 'mybl');

        return view('admin.data-bundle.index',compact('offerCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $page = 'create';
        $product_types = Helper::productType();
        return view('admin.data-bundle.create', compact('page', 'product_types'));
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
                return redirect('mybl-internet-offer-category/create')
                            ->withErrors($validate)
                            ->withInput();
            }

        $response = $this->myBlInternetOffersCategoryService->storeInternetOffersCategory($request->all());

        if($response['status'] == 200){
            Session()->flash('message', $response['message']);
        }
        else {
            Session()->flash('error', $response['message']);
        }

        return redirect()->back();
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
        $product_types = Helper::productType();
        return view('admin.data-bundle.edit',compact('page','internet_offer', 'product_types'));
    }
/**
 * Undocumented function
 *
 * @param MyBlInternetOffersCategoryRequest $request
 * @param [type] $id
 * @return void
 */
    public function update(MyBlInternetOffersCategoryRequest $request, $id){

        $response = $this->myBlInternetOffersCategoryService->updateInternetOffersCategory($request->all(),$id);

        if($response['status'] == 200){
            Session()->flash('message', $response['message']);
        }
        else {
            Session()->flash('error', $response['message']);
        }
        return redirect('mybl-internet-offer-category');

    }
/**
 * Undocumented function
 *
 * @param [type] $id
 * @return void
 */
    public function destroy($id){
        return $this->myBlInternetOffersCategoryService->delFilter($id);

    }
}
