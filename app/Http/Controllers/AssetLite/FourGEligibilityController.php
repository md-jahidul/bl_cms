<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\FourGEligibilityMsgService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class FourGEligibilityController extends Controller
{
    /**
     * @var FourGEligibilityMsgService
     */
    protected $fourGEligibilityMsgService;

    /**
     * TagController constructor.
     * @param FourGEligibilityMsgService $fourGEligibilityMsgService
     */
    public function __construct(FourGEligibilityMsgService $fourGEligibilityMsgService)
    {
        $this->fourGEligibilityMsgService = $fourGEligibilityMsgService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $msgs = $this->fourGEligibilityMsgService->findAll();
        return view('admin.banglalink-4g.eligibility-msg.index', compact('msgs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $msg = $this->fourGEligibilityMsgService->findOne($id);
        $other_attributes = $msg->other_attributes;
        return view('admin.banglalink-4g.eligibility-msg.edit', compact('msg', 'other_attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->fourGEligibilityMsgService->updateEligibilityMsg($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/bl-4g-eligibility-msg');
    }

}
