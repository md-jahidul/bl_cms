<?php

namespace App\Http\Controllers\CMS;

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
        ]);
        return view('admin.data-bundle.index',compact('offerCategory'));
    }

 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page='create';
        return view('admin.data-bundle.create',compact('page'));
    }

    public function saveSortFilter(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:my_bl_internet_offers_categories',
                'slug' => 'required|unique:my_bl_internet_offers_categories',
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
            Session()->flash('message', $response->content());
        return redirect()->back();
    }

    public function edit($id=null){
        $page='create';
        $internet_offer=MyBlInternetOffersCategory::find($id);
        return view('admin.data-bundle.edit',compact('page','internet_offer'));
    }

    public function update(MyBlInternetOffersCategoryRequest $request, $id){
        $response = $this->myBlInternetOffersCategoryService->updateInternetOffersCategory($request->all(),$id);
        Session()->flash('message', $response->content());
        return redirect('mybl-internet-offer-category');

    }

    public function destroy($id){
        return $this->myBlInternetOffersCategoryService->delFilter($id);

    }
}
