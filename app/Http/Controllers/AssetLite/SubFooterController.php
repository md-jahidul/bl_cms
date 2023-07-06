<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StoreFooterMenuRequest;
use App\Models\FooterMenu;
use App\Models\Menu;
use App\Services\DynamicPageService;
use App\Services\DynamicRouteService;
use App\Services\FooterMenuService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Assetlite\SubFooterService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SubFooterController extends Controller
{
        /**
     * @var SubFooterService
     */
    private $subFooterService;

    /**
     * LoyaltyTierController constructor.
     * @param SubFooterService $SubFooterService
     */
    public function __construct(
        SubFooterService $subFooterService
    ) {
        $this->subFooterService = $subFooterService;
    }

    /**
     * Display a listing of the App Service Category.
     *
     * @return Factory|View
     */
    public function index()
    {
        $subFooters = $this->subFooterService->findAll('', '', [
                'column' => 'id',
                'direction' => 'ASC'
            ]);
        return view('admin.sub-footers.index', compact('subFooters'));
    }


    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $subFooter = $this->subFooterService->findOne($id);
        $other_attributes = $subFooter->other_attributes;
        return view('admin.sub-footers.edit', compact('subFooter','other_attributes'));
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
        $this->subFooterService->updateSubFooter($request->all(), $id);
        Session::flash('message', 'Sub Footer Update successfully!');
        return redirect('sub-footer');
    }

}
