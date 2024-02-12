<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\GenericRail;
use App\Services\GenericRailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GenericRailController extends Controller
{
    public $genericRailService;

    public function __construct(GenericRailService $genericRailService)
    {
        $this->genericRailService = $genericRailService;
    }

    public function index()
    {
        $rails = $this->genericRailService->findAll();
        return view('admin.generic-rail.index', compact('rails'));
    }


    public function create()
    {
        return view('admin.generic-rail.create');
    }

    public function store(Request $request)
    {
        if ($this->genericRailService->save($request->all())) {
            Session::flash('success', 'Slider Created Successfully');
        } else {
            Session::flash('error', 'Slider Created Failed');
        }

        return redirect('generic-rail');
    }

    public function show(GenericRail $genericRail)
    {
        //
    }

    public function edit($genericRailId)
    {
        $rail = $this->genericRailService->findOne($genericRailId);
        $android_version_code = implode('-', [$rail['android_version_code_min'], $rail['android_version_code_max']]);
        $ios_version_code = implode('-', [$rail['ios_version_code_min'], $rail['ios_version_code_max']]);
        $rail->android_version_code = $android_version_code;
        $rail->ios_version_code = $ios_version_code;

        return view('admin.generic-rail.edit', compact('rail'));

    }

    public function update(Request $request, $genericRailId)
    {
        if ($this->genericRailService->update($genericRailId, $request->all())) {
            Session::flash('success', 'Slider Update Successfully');
        } else {
            Session::flash('error', 'Slider Update Failed');
        }

        return redirect('generic-rail');
    }

    public function destroy($genericRailId)
    {
        $this->genericRailService->delete($genericRailId);

        return url('generic-rail');
    }
}
