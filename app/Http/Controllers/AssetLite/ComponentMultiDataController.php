<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AlFaqCategoryService;
use App\Services\AlFaqService;
use App\Services\ComponentMultiDataService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ComponentMultiDataController extends Controller
{
    /**
     * @var ComponentMultiDataService
     */
    private $componentMultiDataService;

    /**
     * ComponentMultiDataController constructor.
     * @param ComponentMultiDataService $componentMultiDataService
     */
    public function __construct(
        ComponentMultiDataService $componentMultiDataService
    ) {
        $this->componentMultiDataService = $componentMultiDataService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $imgName
     * @return Application|Factory|View
     */
    public function findSingleData($imgName)
    {
        return $this->componentMultiDataService->findComMultiDataOne($imgName);
    }

}
