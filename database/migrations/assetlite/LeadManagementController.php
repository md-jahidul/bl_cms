<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Jobs\LeadDataSend;
use App\Models\LeadCategory;
use App\Services\Assetlite\LeadRequestService;
use App\Services\LeadProductPermissionService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
     * @var LeadCategory
     */
    private $leadCategory;

    protected const ASSETLITE_SUPER_ADMIN = 5;
    protected const LEAD_SUPER_ADMIN = 9;

    /**
     * LeadManagementController constructor.
     * @param LeadCategory $leadCategory
     * @param LeadRequestService $leadRequestService
     * @param LeadProductPermissionService $productPermissionService
     * @param UserService $userService
     */
    public function __construct(
        LeadCategory $leadCategory,
        LeadRequestService $leadRequestService,
        LeadProductPermissionService $productPermissionService,
        UserService $userService
    )
    {
        $this->leadCategory = $leadCategory;
        $this->leadRequestService = $leadRequestService;
        $this->productPermissionService = $productPermissionService;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return array[]|Application|Factory|Builder[]|Model[]|View
     */
    public function index(Request $request)
    {
        $leadCategories = $this->leadCategory->all();
        $permissions = DB::table('lead_product_permissions')->where('user_id', Auth::id())
            ->get();
        if ($request->all()) {
            return $this->leadRequestService->leadRequestedData($request);
        }
        if (!(Auth::id() == self::ASSETLITE_SUPER_ADMIN) || !(Auth::id() != self::LEAD_SUPER_ADMIN)) {
            $catIdPush = [];
            foreach ($permissions as $data) {
                $catIdPush[] = $data->lead_category_id;
            }
            $leadCategories = $this->leadCategory->whereIn('id', $catIdPush)->get();
        }
        return view('admin.lead-management.index', compact('leadCategories'));
    }

//    /**
//     * @param Request $request
//     * @return array[]|Builder[]|Model[]
//     */
//    public function leadRequestedList(Request $request)
//    {
//        return $this->leadRequestService->leadRequestedData($request);
//    }

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
        $users = $this->userService->getLeadUsers();
        $categories = $this->productPermissionService->getCatAndProducts();
        return view('admin.lead-management.product-permission.permission-form', compact('categories', 'users'));
    }

    public function productPermissionSave(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);
        $response = $this->productPermissionService->userWisePermissionSave($request->all());
        Session::flash('message', $response->getContent());
        return redirect('lead-product-permission');
    }

    public function permittedUsersList()
    {
        $permittedUsers = $this->productPermissionService->getPermittedUsers();
        $leadSuperAdmin = self::lead_super_Admin;
        return view('admin.lead-management.product-permission.permitted-user-list', compact('permittedUsers', 'leadSuperAdmin'));
    }

    public function productPermissionEditForm($userId)
    {
        $permissionInfo = $this->productPermissionService->userPermissionEditInfo($userId);
        $users = $this->userService->getLeadUsers();
        $categories = $this->productPermissionService->getCatAndProducts();
        return view('admin.lead-management.product-permission.permission-edit', compact('categories', 'users', 'userId', 'permissionInfo'));
    }

    public function productPermissionUpdate(Request $request, $userId)
    {
        $response = $this->productPermissionService->userWisePermissionSave($request->all(), $userId);
        Session::flash('message', $response->getContent());
        return redirect('lead-product-permission');
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

    public function permissionDelete($id)
    {
        $this->productPermissionService->userPermissionDelete($id);
        return url("lead-product-permission");
    }
}
