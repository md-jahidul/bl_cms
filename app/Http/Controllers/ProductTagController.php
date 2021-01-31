<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTagRequest;
use App\Services\ProductTagService;

class ProductTagController extends Controller
{
    /**
     * @var ProductTagService
     */
    private $productTagService;

    /**
     * ProductTagController constructor.
     * @param ProductTagService $productTagService
     */
    public function __construct(ProductTagService $productTagService)
    {
        $this->productTagService = $productTagService;
    }

    public function index()
    {
        $tags = $this->productTagService->findAll();
        return view('admin.product.tag.index', compact('tags'));
    }

    /**
     * @param ProductTagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductTagRequest $request)
    {
        if ($this->productTagService->save($request->all())) {
            $message = "Product Tag Stored Successful";
            $type = 'success';
        } else {
            $message = "Error! Product Tag Was Not Stored";
            $type = 'error';
        }

        return redirect()->back()->with($type, $message);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        if ($this->productTagService->delete($id)) {
            $message = "Product Tag Successfully Deleted";
            $type = 'success';
        } else {
            $message = "Error! Product Tag Not Deleted";
            $type = 'error';
        }

        return redirect()->back()->with($type, $message);
    }

}
