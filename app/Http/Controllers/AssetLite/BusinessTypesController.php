<?php

namespace App\Http\Controllers\AssetLite;

use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Assetlite\BusinessTypeService;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BusinessTypesController extends Controller
{
    /**
     * @var BusinessTypesService
     */
    private $businessTypesService;

    /**
     * LoyaltyTierController constructor.
     * @param BusinessTypesService $BusinessTypesService
     */
    public function __construct(
        BusinessTypeService $businessTypesService
    ) {
        $this->businessTypesService = $businessTypesService;
    }

    /**
     * Display a listing of the App Service Category.
     *
     * @return Factory|View
     */
    public function index()
    {
        $businessTypes = $this->businessTypesService->findAll('', '', [
                'column' => 'id',
                'direction' => 'ASC'
            ]);
        return view('admin.business-types.index', compact('businessTypes'));
    }

    /**
     * Show the form for creating a new App Service Category.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.business-types.create');
    }

    /**
     * Store a newly created App Service Category in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $this->businessTypesService->storeBusinessType($request->all());
        Session::flash('message', 'Business Types Add successfully!');
        return redirect('business-types');
    }


    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $businessTypes = $this->businessTypesService->findOne($id);
        return view('admin.business-types.edit', compact('businessTypes'));
    }

    /**
     * Update a App Service category items
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $this->businessTypesService->updateBusinessType($request->all(), $id);
        Session::flash('message', 'Business Types Update successfully!');
        return redirect('business-types');
    }

    /**
     * @param $data
     * @return Response
     */
    public function typeSort(Request $request)
    {
       return $this->businessTypesService->tableSortable($request->position);
    }

    /**
     * Delete a App Service category items
     *
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->businessTypesService->deleteBusinessType($id);
        return url('business-types');
    }
}
