<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\MyBlDigitalService;
use App\Repositories\MyBlDigitalServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MyBlDigitalServiceController extends Controller
{
    public  $myblDigitalserviceRepository;
    public function __construct(MyBlDigitalServiceRepository $myBlDigitalServiceRepository)
    {
        $this->myblDigitalserviceRepository = $myBlDigitalServiceRepository;
    }
    public function index()
    {
        $digitalServices = $this->myblDigitalserviceRepository->findAll();
        return view('admin.mybl-digital-services.index', compact('digitalServices'));
    }

    public function create()
    {
        return view('admin.mybl-digital-services.create');
    }

    public function store(Request $request)
    {
        $flag = $this->myblDigitalserviceRepository->save($request->all());
        if ($flag) {
            Session::flash('message', 'Service Create successful');
        }
        else{
            Session::flash('danger', 'Service Create Failed');
        }

        return redirect('digital-service');
    }

    public function show(MyBlDigitalService $myBlDigitalService)
    {
        //
    }

    public function edit($id)
    {
        $service = $this->myblDigitalserviceRepository->findOne($id);

        return view('admin.mybl-digital-services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = $this->myblDigitalserviceRepository->findOne($id);
        if ($service->update($request->all())) {
            Session::flash('message', 'Service Update successful');
        }
        else{
            Session::flash('danger', 'Service Update Failed');
        }

        return redirect('digital-service');
    }

    public function destroy($id)
    {
        return $this->myblDigitalserviceRepository->destroy($id);
    }
}
