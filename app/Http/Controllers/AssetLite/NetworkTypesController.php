<?php

namespace App\Http\Controllers\AssetLite;

use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Assetlite\NetworkTypeService;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class NetworkTypesController extends Controller
{
    /**
     * @var NetworkTypeService
     */
    private $networkTypeService;

    /**
     * LoyaltyTierController constructor.
     * @param NetworkTypeService $networkTypeService
     */
    public function __construct(
        NetworkTypeService $networkTypeService
    ) {
        $this->networkTypeService = $networkTypeService;
    }

    /**
     * Display a listing of the App Service Category.
     *
     * @return Factory|View
     */
    public function index()
    {
        $networkTypes = $this->networkTypeService->findAll('', '', [
                'column' => 'id',
                'direction' => 'ASC'
            ]);
        return view('admin.network-types.index', compact('networkTypes'));
    }

    /**
     * Show the form for creating a new App Service Category.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.network-types.create');
    }

    /**
     * Store a newly created App Service Category in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $this->networkTypeService->storeNetworkType($request->all());
        Session::flash('message', 'Network Types Add successfully!');
        return redirect('network-types');
    }


    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $networkTypes = $this->networkTypeService->findOne($id);
        return view('admin.network-types.edit', compact('networkTypes'));
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
        $this->networkTypeService->updateNetworkType($request->all(), $id);
        Session::flash('message', 'Network Types Update successfully!');
        return redirect('network-types');
    }

    /**
     * @param $data
     * @return Response
     */
    public function typeSort(Request $request)
    {
       return $this->networkTypeService->tableSortable($request->position);
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
        $this->networkTypeService->deleteNetworkType($id);
        return url('network-types');
    }
}
