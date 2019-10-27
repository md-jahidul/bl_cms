<?php

namespace App\Http\Controllers\CMS;

use App\Models\FaqCategory;
use App\Services\FaqCategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqCategoryController extends Controller
{
    /**
     * @var FaqCategoryService
     */
    protected $service;

    public function __construct(FaqCategoryService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $builder = $this->service->getAll()->app()->latest();
            return $this->service->prepareDataForDatatable($builder, $request);
        }

        return view('admin.faq.category.index');
    }

    public function update(Request $request)
    {
        return $this->service->update($request);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:faq_categories,title|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => ' FAILED',
                'message' => 'This title is taken'
            ], 200);
        }
        return $this->service->store($request, 'app');
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required|exists:faq_categories,slug'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => ' FAILED',
                'message' => 'Invalid Category Slug'
            ], 200);
        }
        return $this->service->destroy($request, 'app');
    }


}
