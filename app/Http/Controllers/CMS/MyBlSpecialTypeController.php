<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyBlProductSpecialTypeRequest;
use App\Services\MyBlSpecialTypeService;
use Illuminate\Http\Request;


class MyBlSpecialTypeController extends Controller
{
    protected  $myBlSpecialTypeService;
    public function __construct(MyBlSpecialTypeService $myBlSpecialTypeService)
    {
        $this->myBlSpecialTypeService = $myBlSpecialTypeService;

    }

    public function index()
    {
        $productSpecialTypes = $this->myBlSpecialTypeService->getProductSpecialTypes();
        return view('admin.product-special-type.index', compact('productSpecialTypes'));
    }


    public function create()
    {
        return view('admin.product-special-type.create');
    }


    public function store(MyBlProductSpecialTypeRequest $request)
    {
        if($this->myBlSpecialTypeService->storeProductSpecialType($request->all())) {
            session()->flash('message', 'Special Types Created Successfully');
        } else {
            session()->flash('error', 'Special Types Created Failed');
        }

        return redirect('product-special-types');
    }


    public function edit($specialTypeId)
    {
        $productSpecialType = $this->myBlSpecialTypeService->findOne($specialTypeId);

        return view('admin.product-special-type.edit', compact('productSpecialType'));
    }


    public function update(MyBlProductSpecialTypeRequest $request, $productSPecialType)
    {

        if($this->myBlSpecialTypeService->updateProductSpecialType($request->all(), $productSPecialType)) {
            session()->flash('message', 'Special Types Updated Successfully');
        } else {
            session()->flash('error', 'Special Types Updated Failed');
        }

        return redirect('product-special-types');

    }

    public function updatePosition(Request $request)
    {
        return $this->myBlSpecialTypeService->tableSortable($request);
    }


    public function destroy($productSPecialType)
    {
        $productSpecialType = $this->myBlSpecialTypeService->findOne($productSPecialType);

        if ($productSpecialType) {
            $this->myBlSpecialTypeService->deleteProductSpecialType($productSPecialType);
            
            session()->flash('error', 'Product Special Type Deleted Successfully');
        } else {
            session()->flash('error', 'Product Special Type Deleted Failed');
        }

        return redirect()->back();
    }
}
