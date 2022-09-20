<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\CommerceBillCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class CommerceBillCategoryController extends Controller
{
    private $commerceBillCategoryService;

    public function __construct(CommerceBillCategoryService $commerceBillCategoryService)
    {
        $this->commerceBillCategoryService = $commerceBillCategoryService;
    }

    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $billCategories = $this->commerceBillCategoryService->findAll(null, null,  $orderBy);
        return view('admin.commerce.bill-category.index', compact('billCategories'));
    }


    public function create()
    {
        return view('admin.commerce.bill-category.create');
    }


    public function store(Request $request)
    {
        if ($this->commerceBillCategoryService->save($request->all())) {
            Session::flash('message', 'Bill Category store successful');
        }
        else{
            Session::flash('danger', 'Bill Category Stored Failed');
        }

        return redirect('commerce-bill-category');
    }

    public function edit($billCategoryId)
    {
        $billCategory = $this->commerceBillCategoryService->findOne($billCategoryId);

        return view('admin.commerce.bill-category.edit', compact('billCategory'));
    }

    public function update(Request $request,  $billCategoryId)
    {
        if ($this->commerceBillCategoryService->update($billCategoryId, $request->all())) {
            Session::flash('message', 'Bill Category Update successful');
        }
        else{
            Session::flash('danger', 'Bill Category Update Failed');
        }

        return redirect('commerce-bill-category');
    }

    public function destroy($billCategoryId)
    {
        $this->commerceBillCategoryService->delete($billCategoryId);
        return redirect('commerce-bill-category');
    }

    public function categorySortable(Request $request)
    {
        return $this->commerceBillCategoryService->tableSort($request);
    }

}
