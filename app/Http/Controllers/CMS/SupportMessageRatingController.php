<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\SupportMessageService;
use Illuminate\Http\Request;
use App\Services\FaqCategoryService;

class SupportMessageRatingController extends Controller
{
    /**
     * @var SupportMessageService
     */
    protected $supportMessageService;

    /**
     * StoreController constructor.
     * @param SupportMessageService $storeService
     */

    public function __construct(SupportMessageService $supportMessageService)
    {
        $this->supportMessageService = $supportMessageService;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Ahsan Habib <ahabib@bs-23.net>
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
                $builder =  $this->supportMessageService->getAll()->latest();
                return $this->supportMessageService->prepareDataForDatatable($builder, $request);
            }
        return view('admin.support-massage.index');

    }


}
