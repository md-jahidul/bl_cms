<?php

namespace App\Http\Controllers\AssetLite    ;

use App\Http\Controllers\Controller;
use App\Services\Banglalink\LeadRequestService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LeadManagementController extends Controller
{
    /**
     * @var $leadRequestService
     */
    protected $leadRequestService;


    /**
     * LeadManagementController constructor.
     * @param LeadRequestService $leadRequestService
     */
    public function __construct(LeadRequestService $leadRequestService)
    {
        $this->leadRequestService = $leadRequestService;
    }

    /**
     * @return Factory|View
     */
    public function leadRequestedList()
    {
        $allRequest = $this->leadRequestService->leadRequestedData();
        return view('admin.lead-management.index', compact('allRequest'));
    }

    public function viewDetails($id)
    {
        $requestInfo = $this->leadRequestService->findOne($id);
        return view('admin.lead-management.view_details', compact('requestInfo'));
    }

    public function changeStatus(Request $request, $id)
    {
        $response = $this->leadRequestService->updateStatus($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('lead-list'));
    }

    public function sendMailForm()
    {
        return view('admin.lead-management.send_mail_form');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $response = $this->leadRequestService->sendMail($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('lead-list'));
    }

}
