<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Jobs\LeadDataSend;
use App\Services\Banglalink\LeadRequestService;
use App\Services\LeadProductPermissionService;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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

    public function index()
    {
        return view('admin.lead-management.index');
    }

    /**
     * @param Request $request
     * @return array[]|Builder[]|Model[]
     */
    public function leadRequestedList(Request $request)
    {
        return $this->leadRequestService->leadRequestedData($request);
    }

    public function excelExport(Request $request)
    {
        $request->validate([
            'lead_category' => 'required',
        ]);
        $response = $this->leadRequestService->excelGenerator($request);
        if ($response) {
            Session::flash('error', $response->getContent());
            return redirect(route('lead-list'));
        }
    }

    public function productPermissionForm()
    {
        $categories = $this->productPermissionService->getCatAndProducts();
        return view('admin.lead-management.product-permission.permission-form', compact('categories'));
    }

    public function productPermissionSave(Request $request)
    {
        $response = $this->productPermissionService->userWisePermissionSave();
        dd($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('lead-list'));
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

//    public function sendMailForm()
//    {
//        return view('admin.lead-management.send_mail_form');
//    }

//    public function sendMail(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|email',
//            'message' => 'required'
//        ]);
//
//        LeadDataSend::dispatch($request->all())
//            ->onQueue('lead_data_send');
//
////        $response = $this->leadRequestService->sendMail($request->all());
//        Session::flash('message', 'Mail send successfully');
//        return redirect(route('lead-list'));
//    }

    public function downloadFile(Request $request)
    {
        return response()->download("uploads/$request->file_path");
    }

    public function downloadPDF($leadId)
    {
        return $this->leadRequestService->downloadPDF($leadId);
    }
}
