<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\TravelAgency;
use App\Services\CommerceBillStatusService;
use App\Services\TravelAgencyService;
use App\Services\UtilityBillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TravelAgencyController extends Controller
{
    public $travelAgencyService;

    public function __construct(
        TravelAgencyService $travelAgencyService
    ) {
        $this->travelAgencyService = $travelAgencyService;
    }

    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $travelAgencies = $this->travelAgencyService->findAll(null, null,  $orderBy);

        return view('admin.commerce.travel.index', compact('travelAgencies'));
    }


    public function create()
    {
        return view('admin.commerce.travel.create');
    }


    public function store(Request $request)
    {
        if ($this->travelAgencyService->save($request->all())) {
            Session::flash('message', 'Travel store successful');
        }
        else{
            Session::flash('danger', 'Travel Stored Failed');
        }

        return redirect('travel');
    }

    public function edit($id)
    {
        $travelAgency = $this->travelAgencyService->findOne($id);
//        dd($travelAgency);
        return view('admin.commerce.travel.edit', compact('travelAgency'));
    }

    public function update(Request $request,  $id)
    {
        if ($this->travelAgencyService->update($id, $request->all())) {
            Session::flash('message', 'Travel Update successful');
        }
        else{
            Session::flash('danger', 'Travel Update Failed');
        }

        return redirect('travel');
    }

    public function destroy($id)
    {
        $this->travelAgencyService->delete($id);

        return redirect('travel');
    }

    public function categorySortable(Request $request)
    {
        return $this->travelAgencyService->tableSort($request);
    }
}
