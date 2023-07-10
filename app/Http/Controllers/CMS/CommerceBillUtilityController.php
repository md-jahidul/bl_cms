<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\CommerceBillCategoryService;
use App\Services\CommerceBillUtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommerceBillUtilityController extends Controller
{
    private $commerceBillUtilityService, $commerceBillCategoryService;

    public function __construct(CommerceBillUtilityService  $commerceBillUtilityService, CommerceBillCategoryService $commerceBillCategoryService)
    {
        $this->commerceBillUtilityService = $commerceBillUtilityService;
        $this->commerceBillCategoryService = $commerceBillCategoryService;
    }

    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $billUtilities = $this->commerceBillUtilityService->findAll(null, null,  $orderBy);
        return view('admin.commerce.bill-utility.index', compact('billUtilities'));
    }


    public function create()
    {
        $categories = $this->commerceBillCategoryService->findAll();
        return view('admin.commerce.bill-utility.create', compact('categories'));
    }


    public function store(Request $request)
    {
        if ($this->commerceBillUtilityService->save($request->all())) {
            Session::flash('message', 'Bill Utility store successful');
        }
        else{
            Session::flash('danger', 'Bill Utility Stored Failed');
        }

        return redirect('commerce-bill-utility');
    }

    public function edit($billCategoryId)
    {
        $billUtility = $this->commerceBillUtilityService->findOne($billCategoryId);
        $categories = $this->commerceBillCategoryService->findAll();
        return view('admin.commerce.bill-utility.edit', compact('billUtility', 'categories'));
    }

    public function update(Request $request,  $billUtilityId)
    {
        if ($this->commerceBillUtilityService->update($billUtilityId, $request->all())) {
            Session::flash('message', 'Bill Utility Update successful');
        }
        else{
            Session::flash('danger', 'Bill Utility Update Failed');
        }

        return redirect('commerce-bill-utility');
    }

    public function destroy($billUtilityId)
    {
        $this->commerceBillUtilityService->delete($billUtilityId);
        return redirect('commerce-bill-utility');
    }

    public function categorySortable(Request $request)
    {
        return $this->commerceBillUtilityService->tableSort($request);
    }
}
