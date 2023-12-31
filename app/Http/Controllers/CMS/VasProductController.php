<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\VasProductRequest;
use App\Services\VasProductService;
use Illuminate\Http\Request;


class VasProductController extends Controller
{
    protected  $vasProductService;
    public function __construct(VasProductService $vasProductService)
    {
        $this->vasProductService = $vasProductService;
    }

    public function index()
    {
        $vasProducts = $this->vasProductService->getVasProducts();
        return view('admin.vas-product.index', compact('vasProducts'));
    }


    public function create()
    {
        return view('admin.vas-product.create');
    }


    public function store(VasProductRequest $request)
    {
        if($this->vasProductService->storeVasProducts($request->all())) {
            session()->flash('message', 'VAS Product Created Successfully');
        } else {
            session()->flash('error', 'VAS Product Created Failed');
        }

        return redirect('vas-products');
    }


    public function edit($vasProductId)
    {
        $vasProduct = $this->vasProductService->findOne($vasProductId);
        return view('admin.vas-product.edit', compact('vasProduct'));
    }


    public function update(VasProductRequest $request, $vasProductId)
    {

        if($this->vasProductService->updateVasProduct($request->all(), $vasProductId)) {
            session()->flash('message', 'VAS Product Updated Successfully');
        } else {
            session()->flash('error', 'VAS Product Updated Failed');
        }

        return redirect('vas-products');
    }

    public function updatePosition(Request $request)
    {
        return $this->vasProductService->tableSortable($request);
    }


    public function destroy($vasProductId)
    {
        $vasProduct = $this->vasProductService->findOne($vasProductId);

        if ($vasProduct) {
            $this->vasProductService->deleteVasProduct($vasProductId);
            session()->flash('error', 'VAS Product Deleted Successfully');
        } else {
            session()->flash('error', 'VAS Product Deleted Failed');
        }

        return redirect()->back();
    }
}
