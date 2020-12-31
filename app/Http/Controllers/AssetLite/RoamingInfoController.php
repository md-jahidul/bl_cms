<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\RoamingInfoTipsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RoamingInfoService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoamingInfoController extends Controller {

    private $infoService;

    /**
     * RoamingInfoController constructor.
     * @param RoamingInfoService $infoService
     */
    public function __construct(RoamingInfoService $infoService) {
        $this->infoService = $infoService;
    }

    /**
     * Display Categories, and info/tips list
     *
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function index() {
        $info = $this->infoService->getInfoList();

        return view('admin.roaming.info_tips', compact('info'));
    }


    /**
     * Add Info & Tips Form
     *
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function createInfo() {


        return view('admin.roaming.create_info_tips');
    }

    /**
     * edit info and tips form
     *
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function editInfo($infoId) {
        $info = $this->infoService->getInfoById($infoId);
        return view('admin.roaming.edit_info', compact('info'));
    }

    /**
     * Save info & tips
     *
     * @param Request $request
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function saveInfo(RoamingInfoTipsRequest $request)
    {
        if ($request->info_id == "") {
            $response = $this->infoService->saveInfo($request);
        } else {
            $response = $this->infoService->updateInfo($request);
        }

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Offer is saved!');
        } else {
            Session::flash('error', 'Offer saving process failed!');
        }

        return redirect('roaming-info-tips');
    }

    /**
     * Delete info & tips
     *
     * @param $infoId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 27/03/2020
     */
    public function deleteInfo($infoId) {
        $response = $this->infoService->deleteInfo($infoId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Info/Tips is deleted!');
        } else {
            Session::flash('error', 'Info/Tips deleting process failed!');
        }

        return redirect('roaming-info-tips');
    }

    /**
     * edit components
     *
     * @param $infoId
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function editComponent($infoId) {
        $components = $this->infoService->getInfoComponents($infoId);
        return view('admin.roaming.info_components', compact('components', 'infoId'));
    }

    /**
     * Update components
     *
     * @param Request $request
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function updateComponent(Request $request) {
//        print_r($request->all());die();

        $response = $this->infoService->updateComponents($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Components are saved!');
        } else {
            Session::flash('error', 'Components saving process failed!');
        }

        return redirect('roaming/edit-info-component/' . $request->parent_id);
    }

    /**
     * Component Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 27/03/2020
     */
    public function componentSortChange(Request $request) {
        $sortChange = $this->infoService->changeComponentSort($request);
        return $sortChange;
    }

    /**
     * Component delete.
     *
     * @param $infoId, $comId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 27/03/2020
     */
    public function componentDelete($infoId, $comId) {

        $response = $this->infoService->componentDelete($comId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Component is deleted!');
        } else {
            Session::flash('error', 'Component delete process failed!');
        }

        return redirect('roaming/edit-info-component/' . $infoId);
    }

    /* ###################################### DONE  ################################################# */
}
