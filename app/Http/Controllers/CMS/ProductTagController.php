<?php

namespace App\Http\Controllers\CMS;

use App\Services\ProductTagService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTagRequest;

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
        $tags = $this->productTagService->findAll(null, null, ['column' => 'priority', 'direction' => 'asc']);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $tag = $this->productTagService->findOne($id);
        return view('admin.product.tag.edit', compact('tag'));
    }

    public function update(ProductTagRequest $request, $id)
    {
        $tag = $this->productTagService->findOne($id);
        if ($tag) {
            $message = "Product Tag Updated Successful";
            $type = 'success';
            $tag->update($request->all());

        } else {
            $message = "Error! Product Tag Was Not Updated";
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
