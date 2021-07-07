<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\Helper;
use App\Services\DynamicUrlRedirectionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DynamicUrlRedirectionController extends Controller
{
    /**
     * @var DynamicUrlRedirectionService
     */
    private $dynamicUrlRedirectionService;

    /**
     * DynamicUrlRedirectionController constructor.
     * @param DynamicUrlRedirectionService $dynamicUrlRedirectionService
     */
    public function __construct(DynamicUrlRedirectionService $dynamicUrlRedirectionService)
    {
        $this->dynamicUrlRedirectionService = $dynamicUrlRedirectionService;
    }

    public function index()
    {
        $redirections = $this->dynamicUrlRedirectionService->findAll();
        return view('admin.dynamic-url-redirection.index', compact('redirections'));
    }

    public function create()
    {
        $redirectionForList = Helper::urlRedirectionForList();
        return view('admin.dynamic-url-redirection.create', compact('redirectionForList'));
    }

    public function store(Request $request)
    {
        if ($this->dynamicUrlRedirectionService->storeData($request->all())) {
            return redirect()->back()->with('success', 'URL Redirection Stored Successfully');
        }
        return redirect()->back()->with('error', 'Error While Storing. Please Retry');
    }

    public function edit($id)
    {
        $redirection = $this->dynamicUrlRedirectionService->findOne($id);
        $redirectionForList = Helper::urlRedirectionForList();
        if ($redirection) {
            return view('admin.dynamic-url-redirection.edit', compact('redirection', 'redirectionForList'));
        }
        return redirect()->back()->with('error', 'Wrong url! Can not find the dynamic url redirection.');
    }

    public function update(Request $request, $id)
    {
        if ($this->dynamicUrlRedirectionService->updateData($request->all(), $id)) {
            return redirect()->back()->with('success', 'URL Redirection Updated Successfully');
        }
        return redirect()->back()->with('error', 'Error While Updating. Please Retry');
    }

    public function toggleStatus($id, $status)
    {
        if ($this->dynamicUrlRedirectionService->updateData(['status' => $status], $id)) {
            return redirect()->back()->with('success', 'URL Redirection Status Updated Successfully');
        }
        return redirect()->back()->with('error', 'Error While Updating Status. Please Retry');
    }
}
