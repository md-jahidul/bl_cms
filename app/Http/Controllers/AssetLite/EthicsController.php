<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\EthicsService;
use Illuminate\Http\Request;
use Session;

class EthicsController extends Controller {

    private $service;

    /**
     * EthicsController constructor.
     * @param EthicsService $service
     */
    public function __construct(EthicsService $service) {
        $this->service = $service;
    }

    /**
     * Display page info and list of files
     *
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 22/06/2020
     */
    public function index() {
        $pageInfo = $this->service->getPageInfo();
        $files = $this->service->getFiles();

        return view('admin.ethics.index', compact('pageInfo', 'files'));
    }



    /**
     * Update category
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 20/03/2020
     */
    public function updatePageInfo(Request $request) {
        $response = $this->service->updatePageInfo($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Page info is updated!');
        } else {
            Session::flash('error', 'Page info updating process failed!');
        }

        return redirect('/ethics-compliance');
    }

    /**
     * Save ethics file
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 22/06/2020
     */
    public function saveFile(Request $request) {
        $response = $this->service->saveFile($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'File saved!');
        } else {
            Session::flash('error', 'File saving process failed!');
        }

        return redirect('/ethics-compliance');
    }




    /**
     * File Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 22/06/2020
     */
    public function sortFiles(Request $request) {
        $sortChange = $this->service->changeFileSort($request);
        return $sortChange;
    }

    /**
     * File status Change.
     *
     * @param  $fileId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 22/06/2020
     */
    public function chanbgeStatus($fileId) {
        $statusChange = $this->service->changeFileStatus($fileId);
        return $statusChange;
    }

    /**
     * Get single file's data
     *
     * @param  $fileId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 24/06/2020
     */
    public function getFileData($fileId) {
        $file = $this->service->getFileData($fileId);
        return $file;
    }



    /**
     * file delete.
     *
     * @param $fileId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 24/06/2020
     */
    public function fileDelete($fileId) {


        $response = $this->service->deleteEthicsFile($fileId);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'File is deleted!');
        } else {
            Session::flash('error', 'File deleting process failed!');
        }
        return redirect('/ethics-compliance');
    }

}
