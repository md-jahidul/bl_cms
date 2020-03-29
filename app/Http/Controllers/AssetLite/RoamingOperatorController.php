<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\RoamingOperatorService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RoamingOperatorController extends Controller
{

    /**
     * @var RoamingOperatorService
     */
    private $roamingOperatorService;

    /**
     * BusinessInternetController constructor.
     * @param RoamingOperatorService $roamingOperatorService
     */
    public function __construct(RoamingOperatorService $roamingOperatorService)
    {
        $this->roamingOperatorService = $roamingOperatorService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.roaming.operator_list');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadOperatorExcel(Request $request)
    {
        return $this->roamingOperatorService->saveExcel($request);
    }


    /**
     * @return Factory|View
     */
    public function operatorCreate()
    {
        return view('admin.roaming.operator_create');
    }



    /**
     * @param $operatorId
     * @return Factory|View
     */
    public function operatorEdit($operatorId)
    {
        $operator = $this->roamingOperatorService->findOne($operatorId);
        return view('admin.roaming.operator_edit', compact('operator'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function saveOperator(Request $request)
    {
        $response = $this->roamingOperatorService->updateOperator($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Operator is saved!');
        } else {
            Session::flash('error', 'Operator saving process failed!');
        }
        return redirect('/roaming/operators');
    }


    public function roamingOperatorList(Request $request)
    {
        return $this->roamingOperatorService->getRoamingOperators($request);
    }

    public function operatorStatusChange($id)
    {
        return $this->roamingOperatorService->statusChange($id);
    }

    public function allOperatorDelete()
    {
        return $this->roamingOperatorService->deleteOperatorAll();
    }

    public function deleteOperator($operatorId = 0)
    {
        return $this->roamingOperatorService->deleteOperator($operatorId);
    }

}
