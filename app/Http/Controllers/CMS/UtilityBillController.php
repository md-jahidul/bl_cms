<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CommerceBillStatus;
use App\Services\CommerceBillStatusService;
use App\Services\UtilityBillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UtilityBillController extends Controller
{
    public $utilityBillService;
    public $commerceBillStatusService;

    public function __construct(
        UtilityBillService $utilityBillService,
        CommerceBillStatusService $commerceBillStatusService
    ) 
    {
        $this->utilityBillService = $utilityBillService;
        $this->commerceBillStatusService = $commerceBillStatusService;
    }

    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $billUtilities = $this->utilityBillService->findAll(null, null,  $orderBy);

        return view('admin.commerce.index', compact('billUtilities'));
    }


    public function create()
    {
        return view('admin.commerce.create');
    }


    public function store(Request $request)
    {
        if ($this->utilityBillService->save($request->all())) {
            Session::flash('message', 'Bill Utility store successful');
        }
        else{
            Session::flash('danger', 'Bill Utility Stored Failed');
        }

        return redirect('utility-bill');
    }

    public function edit($billCategoryId)
    {
        $billUtility = $this->utilityBillService->findOne($billCategoryId);

        return view('admin.commerce.edit', compact('billUtility'));
    }

    public function update(Request $request,  $billUtilityId)
    {
        if ($this->utilityBillService->update($billUtilityId, $request->all())) {
            Session::flash('message', 'Bill Utility Update successful');
        }
        else{
            Session::flash('danger', 'Bill Utility Update Failed');
        }

        return redirect('utility-bill');
    }

    public function destroy($billUtilityId)
    {
        $this->utilityBillService->delete($billUtilityId);

        return redirect('utility-bill');
    }

    public function categorySortable(Request $request)
    {
        return $this->utilityBillService->tableSort($request);
    }

    public function showCommerceBill()
    {
        $billStatus = $this->commerceBillStatusService->getPaginatedBills();

        return view('admin.commerce.bills', compact('billStatus'));
    }
}
