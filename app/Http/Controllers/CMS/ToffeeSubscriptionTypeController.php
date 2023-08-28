<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\ToffeeSubscriptionTypeService;
use Illuminate\Http\Request;


class ToffeeSubscriptionTypeController extends Controller
{
    protected  $toffeeSubscriptionTypeService;
    public function __construct(ToffeeSubscriptionTypeService $toffeeSubscriptionTypeService)
    {
        $this->toffeeSubscriptionTypeService = $toffeeSubscriptionTypeService;

    }

    public function index()
    {
        $toffeeSubscriptionTypes = $this->toffeeSubscriptionTypeService->getToffeeSubscriptionTypes();
        return view('admin.toffee-subscription-type.index', compact('toffeeSubscriptionTypes'));
    }


    public function create()
    {
        return view('admin.toffee-subscription-type.create');
    }


    public function store(Request $request)
    {
        if($this->toffeeSubscriptionTypeService->storeToffeeSubscriptionType($request->all())) {
            session()->flash('message', 'Subscription Types Created Successfully');
        } else {
            session()->flash('error', 'Subscription Types Created Failed');
        }

        return redirect('toffee-subscription-types');
    }


    public function edit($subscriptionTypeId)
    {
        $toffeeSubscriptionType = $this->toffeeSubscriptionTypeService->findOne($subscriptionTypeId);

        return view('admin.toffee-subscription-type.edit', compact('toffeeSubscriptionType'));
    }


    public function update(Request $request, $toffeeSubscriptionType)
    {

        if($this->toffeeSubscriptionTypeService->updateToffeeSubscriptionType($request->all(), $toffeeSubscriptionType)) {
            session()->flash('message', 'Subscription Types Updated Successfully');
        } else {
            session()->flash('error', 'Subscription Types Updated Failed');
        }

        return redirect('toffee-subscription-types');

    }


    public function destroy($toffeeSubscriptionType)
    {
        $toffeeSubscriptionType = $this->toffeeSubscriptionTypeService->findOne($toffeeSubscriptionType);

        if ($toffeeSubscriptionType) {
            $this->toffeeSubscriptionTypeService->deleteToffeeSubscriptionType($toffeeSubscriptionType->id);
            
            session()->flash('error', 'Toffee Subscription Type Deleted Successfully');
        } else {
            session()->flash('error', 'Toffee Subscription Type Deleted Failed');
        }

        return redirect()->back();
    }
}
