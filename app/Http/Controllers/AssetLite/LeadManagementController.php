<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\Banglalink\LeadRequestService;
use App\Services\LeadProductPermissionService;
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
     * @var LeadProductPermissionService
     */
    private $productPermissionService;

    /**
     * LeadManagementController constructor.
     * @param LeadRequestService $leadRequestService
     * @param LeadProductPermissionService $productPermissionService
     * @param UserService $userService
     */
    public function __construct(
        LeadRequestService $leadRequestService,
        LeadProductPermissionService $productPermissionService,
        UserService $userService
    )
    {
        $this->leadRequestService = $leadRequestService;
        $this->productPermissionService = $productPermissionService;
        $this->userService = $userService;
    }

    /**
     * @return Factory|View
     */
    public function leadRequestedList()
    {
        $allRequest = $this->leadRequestService->leadRequestedData();
        $allRequest = $allRequest['data'];
        if (empty($allRequest)) {
            Session::flash('error', "No products found or you do not have permission!");
            $allRequest = [];
        }
//        dd($allRequest);
        return view('admin.lead-management.index', compact('allRequest'));
    }

    public function productPermissionForm()
    {
        $users = $this->productPermissionService->getCatAndProducts();
        return view('admin.lead-management.product-permission.permission-form', compact('users', 'leadSuperAdmin'));
    }

    public function leadProductPermission()
    {
        $users = $this->userService->getLeadUsers();
        $leadSuperAdmin = self::lead_super_Admin;
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
