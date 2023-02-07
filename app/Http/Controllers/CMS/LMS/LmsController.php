<?php

namespace App\Http\Controllers\CMS\LMS;

use App\Http\Controllers\Controller;
use App\Models\NewCampaignModality\MyBlCampaign;
use App\Repositories\LmsHomeComponentRepository;
use App\Services\LmsHomeComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LmsController extends Controller
{
    public $lmsHomeComponentService;
    public function __construct(
        LmsHomeComponentService $lmsHomeComponentService
    ) {
        $this->lmsHomeComponentService = $lmsHomeComponentService;
    }

    public function index()
    {
        $components = $this->lmsHomeComponentService->findAllComponents();

        return view('admin.lms-components.index', compact('components'));
    }

    public function store(Request $request)
    {
        $response = $this->lmsHomeComponentService->storeComponent($request->all());
        Session::flash('success', $response->getContent());
        return redirect()->route('lms-components');
    }

    public function componentStatusUpdate($id)
    {
        $response = $this->lmsHomeComponentService->changeStatus($id);
        Session::flash('success', $response->getContent());
        return redirect()->route('lms-components');
    }

    public function componentSort(Request $request)
    {
        return $this->lmsHomeComponentService->tableSort($request);
    }

    public function edit($id)
    {
        return $this->lmsHomeComponentService->findOne($id);
    }

    public function update(Request $request)
    {
        $response = $this->lmsHomeComponentService->updateComponent($request->all());
        Session::flash('message', $response->getContent());
        return redirect()->route('lms-components');
    }

    public function destroy($id)
    {
        $this->lmsHomeComponentService->deleteComponent($id);
        return url(route('lms-components'));
    }
}
