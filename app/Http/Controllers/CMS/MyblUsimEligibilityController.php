<?php

namespace App\Http\Controllers\CMS;

use App\Models\AgentList;
use App\Models\AgentDeeplinkDetail;
use App\Services\MyblUsimEligibilityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use App\Http\Requests\AgentDeeplinkRequest;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Redirect;
use App\Services\AgentService;
use Mail;

class MyblUsimEligibilityController extends Controller
{
    /**
     * @var MyblUsimEligibilityService
     */
    private $usimEligibilityService;

    /**
     * MyblUsimEligibilityController constructor.
     * @param MyblUsimEligibilityService $usimEligibilityService
     */
    public function __construct(MyblUsimEligibilityService $usimEligibilityService)
    {
        $this->usimEligibilityService = $usimEligibilityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $usimContents = $this->usimEligibilityService->getContent();
        return view('admin.mybl-usim-eligibility.show', compact('usimContents'));
    }

    /**
     * Update the specified resource in storage.
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = $this->usimEligibilityService->upateUsimEligibilityData($request->all(), $id);
        Session()->flash('message', $response->content());
        return redirect(route('usim-eligibility.index'));
    }
}
