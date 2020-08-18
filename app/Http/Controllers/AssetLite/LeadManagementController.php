<?php

namespace App\Http\Controllers\AssetLite    ;

use App\Http\Controllers\Controller;
use App\Services\Banglalink\LeadRequestService;
use App\Services\UserService;
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
     * @var UserService
     */
    private $userService;

    const lead_super_Admin = 9;

    /**
     * LeadManagementController constructor.
     * @param LeadRequestService $leadRequestService
     * @param UserService $userService
     */
    public function __construct(
        LeadRequestService $leadRequestService,
        UserService $userService
    ) {
        $this->leadRequestService = $leadRequestService;
        $this->userService = $userService;
    }

    /**
     * @return Factory|View
     */
    public function leadRequestedList()
    {
        $allRequest = $this->leadRequestService->leadRequestedData();
        return $allRequest;
        return view('admin.lead-management.index', compact('allRequest'));
    }

    public function leadProductPermission()
    {
        $users = $this->userService->getLeadUsers();
        $leadSuperAdmin = self::lead_super_Admin;
//        dd($leadSuperAdmin);
        return view('admin.lead-management.product-permission.user-list', compact('users', 'leadSuperAdmin'));
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
