<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\Helper;
use App\Services\DeeplinkRedirectionService;
use App\Services\DynamicUrlRedirectionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeeplinkRedirectionController extends Controller
{
    /**
     * @var DeeplinkRedirectionService
     */
    private $deeplinkRedirectionService;

    public function __construct(DeeplinkRedirectionService $deeplinkRedirectionService)
    {
        $this->deeplinkRedirectionService = $deeplinkRedirectionService;
    }

    public function index()
    {
        $redirections = $this->deeplinkRedirectionService->findAll();
        return view('admin.deeplink-redirection.index', compact('redirections'));
    }

    public function create()
    {
        return view('admin.deeplink-redirection.create');
    }

    public function store(Request $request)
    {
        if ($this->deeplinkRedirectionService->storeData($request->all())) {
            return redirect()->back()->with('success', 'URL Redirection Stored Successfully');
        }
        return redirect()->back()->with('error', 'Error While Storing. Please Retry');
    }

    public function edit($id)
    {
        $redirection = $this->deeplinkRedirectionService->findOne($id);
        $redirectionForList = Helper::urlRedirectionForList();
        if ($redirection) {
            return view('admin.deeplink-redirection.edit', compact('redirection', 'redirectionForList'));
        }
        return redirect()->back()->with('error', 'Wrong url! Can not find the dynamic url redirection.');
    }

    public function update(Request $request, $id)
    {
        if ($this->deeplinkRedirectionService->updateData($request->all(), $id)) {
            return redirect()->back()->with('success', 'URL Redirection Updated Successfully');
        }
        return redirect()->back()->with('error', 'Error While Updating. Please Retry');
    }

    public function toggleStatus($id, $status)
    {
        if ($this->deeplinkRedirectionService->updateData(['status' => $status], $id)) {
            return redirect()->back()->with('success', 'URL Redirection Status Updated Successfully');
        }
        return redirect()->back()->with('error', 'Error While Updating Status. Please Retry');
    }
}
