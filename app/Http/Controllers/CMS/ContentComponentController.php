<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use App\Services\ContentComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContentComponentController extends Controller
{
    private $componentService;

    public function __construct(
        ContentComponentService $componentService
    ) {
        $this->componentService = $componentService;
    }

    public function index()
    {
        $components = $this->componentService->findAllComponents();
        return view('admin.content-components.index', compact('components'));
    }

    public function store(Request $request)
    {
        $response = $this->componentService->storeComponent($request->all());
        Session::flash('success', $response->getContent());
        return redirect()->route('content-components');
    }

    public function componentStatusUpdate($id)
    {
        $response = $this->componentService->changeStatus($id);
        Session::flash('success', $response->getContent());
        return redirect()->route('content-components');
    }

    public function componentSort(Request $request)
    {
        return $this->componentService->tableSort($request);
    }

    public function edit($id)
    {
        return $this->componentService->findOne($id);
    }

    public function update(Request $request)
    {
        $response = $this->componentService->updateComponent($request->all());
        Session::flash('message', $response->getContent());
        return redirect()->route('content-components');
    }

    public function destroy($id)
    {
        $this->componentService->deleteComponent($id);
        return url(route('content-components'));
    }
}
