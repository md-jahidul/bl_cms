<?php

namespace App\Http\Controllers\CMS\LMS;

use App\Http\Controllers\Controller;
use App\Models\NewCampaignModality\MyBlCampaign;
use App\Services\LmsShortcutComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShortcutController extends Controller
{
    public $lmsShortcutComponentService;
    public function __construct(
        LmsShortcutComponentService $lmsShortcutComponentService
    ) {
        $this->lmsShortcutComponentService = $lmsShortcutComponentService;
    }

    public function index()
    {
        $components = $this->lmsShortcutComponentService->findAllComponents();

        return view('admin.shortcut-components.index', compact('components'));
    }

    public function create()
    {
        return view('admin.shortcut-components.create');
    }

    public function store(Request $request)
    {
        $response = $this->lmsShortcutComponentService->storeComponent($request->all());
        Session::flash('success', $response->getContent());
        return redirect()->route('shortcut-components');
    }

    public function componentStatusUpdate($id)
    {
        $response = $this->lmsShortcutComponentService->changeStatus($id);
        Session::flash('success', $response->getContent());
        return redirect()->route('shortcut-components');
    }

    public function componentSort(Request $request)
    {
        return $this->lmsShortcutComponentService->tableSort($request);
    }

    public function edit($id)
    {
       $component = $this->lmsShortcutComponentService->findOne($id);

        return view('admin.shortcut-components.create', compact('component'));
    }

    public function update(Request $request, $id)
    {

        $response = $this->lmsShortcutComponentService->updateComponent($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect()->route('shortcut-components');
    }

    public function destroy($id)
    {
        $this->lmsShortcutComponentService->deleteComponent($id);
        return url(route('shortcut-components'));
    }
}
